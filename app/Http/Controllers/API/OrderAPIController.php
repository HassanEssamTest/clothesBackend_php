<?php
/**
 * File name: OrderAPIController.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Http\Controllers\API;


use App\Criteria\Orders\OrdersOfStatusesCriteria;
use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Events\OrderChangedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\AssignedOrder;
use App\Notifications\NewOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\CartRepository;
use App\Repositories\ClothesOrderRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;
use Stripe\Token;
use App\Models\ClothesQuantity;
use GuzzleHttp\Client;
use App\Events\OrderConfirmationEvent;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */
class OrderAPIController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;
    /** @var  ClothesOrderRepository */
    private $clothesOrderRepository;
    /** @var  CartRepository */
    private $cartRepository;
    /** @var  UserRepository */
    private $userRepository;
    /** @var  PaymentRepository */
    private $paymentRepository;
    /** @var  NotificationRepository */
    private $notificationRepository;

    /**
     * OrderAPIController constructor.
     * @param OrderRepository $orderRepo
     * @param ClothesOrderRepository $clothesOrderRepository
     * @param CartRepository $cartRepo
     * @param PaymentRepository $paymentRepo
     * @param NotificationRepository $notificationRepo
     * @param UserRepository $userRepository
     */
    public function __construct(OrderRepository $orderRepo, ClothesOrderRepository $clothesOrderRepository, CartRepository $cartRepo, PaymentRepository $paymentRepo, NotificationRepository $notificationRepo, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepo;
        $this->clothesOrderRepository = $clothesOrderRepository;
        $this->cartRepository = $cartRepo;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepo;
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->orderRepository->pushCriteria(new RequestCriteria($request));
            $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfStatusesCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $orders = $this->orderRepository;
        if($request->pagination){
            $orders = $orders->paginate(10);
        }
        else{
            $orders = $orders->get();
        }

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var Order $order */
        if (!empty($this->orderRepository)) {
            try {
                $this->orderRepository->pushCriteria(new RequestCriteria($request));
                $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $order = $this->orderRepository->findWithoutFail($id);
        }

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        return $this->sendResponse($order->toArray(), 'Order retrieved successfully');


    }

    /**
     * Store a newly created Order in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $payment = $request->only('payment');
        if (isset($payment['payment']) && $payment['payment']['method']) {
            if ($payment['payment']['method'] == "Credit Card (Paymob Gateway)") {
                return $this->paymobPayment($request);
            } else {
                return $this->cashPayment($request);

            }
        }
    }

    private function paymobPayment(Request $request) {
        
        $token = $this->getToken();
        $order = $this->createOrder($token, $request);
        $paymentToken = $this->getPaymentToken($order, $token);
        return response()->json([
            'payment_url' => "https://portal.weaccept.co/api/acceptance/iframes/".env('PAYMOB_IFRAME_ID').'?payment_token='.$paymentToken
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    private function cashPayment(Request $request)
    {
        $input = $request->all();
        $amount = 0;
        try {
            $order = $this->orderRepository->create(
                $request->only('user_id', 'order_status_id', 'tax', 'delivery_address_id', 'delivery_fee', 'hint')
            );
            foreach ($input['clothes'] as $clothesOrder) {
                $clothesOrder['order_id'] = $order->id;
                $amount += $clothesOrder['price'] * $clothesOrder['quantity'];
                $this->clothesOrderRepository->create($clothesOrder);
                $clothesQuantity = ClothesQuantity::where('clothes_id', $clothesOrder['clothes_id'])
                               ->where('size_id', $clothesOrder['size_id'])
                               ->where('colour_id', $clothesOrder['color_id'])->first();
                $clothesQuantity->quantity -= 1;
                $clothesQuantity->save();

            }
            $amount += $order->delivery_fee;
            $amountWithTax = $amount - ($amount * $order->tax / 100);
            $payment = $this->paymentRepository->create([
                "user_id" => $input['user_id'],
                "description" => trans("lang.payment_order_waiting"),
                "price" => $amountWithTax,
                "status" => 'Waiting for Client',
                "method" => $input['payment']['method'],
            ]);

            $this->orderRepository->update(['payment_id' => $payment->id], $order->id);

            $this->cartRepository->deleteWhere(['user_id' => $order->user_id]);

            Notification::send($order->clothesOrders[0]->clothes->shop->users, new NewOrder($order));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($order->toArray(), __('lang.saved_successfully', ['operator' => __('lang.order')]));
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            return $this->sendError('Order not found');
        }
        $input = $request->all();

        $oldStatus = $oldOrder->payment->status;

        try {
            $order = $this->orderRepository->update($input, $id);
            if (isset($input['order_status_id']) && $input['order_status_id'] == 5 && !empty($order)) {
                $this->paymentRepository->update(['status' => 'Paid'], $order['payment_id']);
            }
            event(new OrderChangedEvent($oldStatus, $order));    
            
            if (setting('enable_notifications', false)) {
                if (isset($input['order_status_id']) && $input['order_status_id'] != $oldOrder->order_status_id) {
                    Notification::send([$order->user], new StatusChangedOrder($order));
                }

                if (isset($input['driver_id']) && ($input['driver_id'] != $oldOrder['driver_id'])) {
                    $driver = $this->userRepository->findWithoutFail($input['driver_id']);
                    if (!empty($driver)) {
                        Notification::send([$driver], new AssignedOrder($order));
                    }
                }
            }

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($order->toArray(), __('lang.saved_successfully', ['operator' => __('lang.order')]));
    }

    public function getToken() {
        $client = new Client();
        
        $response = $client->request('POST', 'https://accept.paymob.com/api/auth/tokens', 
            [
                'json' => [
                    'api_key' => env('PAYMOB_API_KEY')
                ]
            ]);
        return json_decode($response->getBody())->token;
    }
  
    public function createOrder($token, $request) {
        $client = new Client();
        $items = [];

        $input = $request->all();
        $request['active'] = 0;
        $amount = 0;
        try {
            $order = $this->orderRepository->create(
                $request->only('user_id', 'order_status_id', 'tax', 'delivery_address_id', 'delivery_fee', 'hint', 'active')
            );
            foreach ($input['clothes'] as $clothesOrder) {
                $clothesOrder['order_id'] = $order->id;
                $amount += $clothesOrder['price'] * $clothesOrder['quantity'];
                $this->clothesOrderRepository->create($clothesOrder);
                $clothesQuantity = ClothesQuantity::where('clothes_id', $clothesOrder['clothes_id'])
                               ->where('size_id', $clothesOrder['size_id'])
                               ->where('colour_id', $clothesOrder['color_id'])->first();
                $clothesQuantity->quantity -= 1;
                $clothesQuantity->save();

            }
            $amount += $order->delivery_fee;
            $amountWithTax = $amount - ($amount * $order->tax / 100);
            $payment = $this->paymentRepository->create([
                "user_id" => $input['user_id'],
                "description" => trans("lang.payment_order_waiting"),
                "price" => $amountWithTax,
                "status" => 'Waiting for Client',
                "method" => $input['payment']['method'],
            ]);

            $this->orderRepository->update(['payment_id' => $payment->id], $order->id);

            $this->cartRepository->deleteWhere(['user_id' => $order->user_id]);

            Notification::send($order->clothesOrders[0]->clothes->shop->users, new NewOrder($order));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        $data = [
            "auth_token" =>   $token,
            "delivery_needed" =>"false",
            "amount_cents"=> $amountWithTax * 100,
            "currency"=> "EGP",
            "items"=> $items,
  
        ];

        $response = $client->request('POST', 'https://accept.paymob.com/api/ecommerce/orders', [
            'json' => $data ]);
        $response = json_decode($response->getBody());
        $order->payment_order_id = $response->id;
        $order->save();
        return $response;
    }
  
    public function getPaymentToken($order, $token)
    {
        $client = new Client();
        $billingData = [
            "apartment" => "803",
            "email" => "claudette09@exa.com",
            "floor" => "42",
            "first_name" => "Clifford",
            "street" => "Ethan Land",
            "building" => "8028",
            "phone_number" => "+86(8)9135210487",
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => "Nicolas",
            "state" => "Utah"
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => $order->amount_cents,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = $client->request('POST', 'https://accept.paymob.com/api/acceptance/payment_keys', [
            'json' => $data ]);
        return json_decode($response->getBody())->token;
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        $encoded_data = json_encode($data);
        $order = Order::where('payment_order_id', $data['obj']['order']['id'])->first();
        $order->payment_data = $encoded_data;
        if ($data['obj']['success'])
            $order->active = 1;
        $order->save();
    }

}
