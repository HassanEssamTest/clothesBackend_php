<?php
/**
 * File name: OrderDataTable.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Order;
use App\Models\ClothesOrder;
use App\Models\Clothes;
use App\Models\Shop;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('id', function ($order) {
                return "#".$order->id;
            })
            ->editColumn('updated_at', function ($order) {
                return getDateColumn($order, 'updated_at');
            })
            ->editColumn('tax', function ($order) {
                $subtotal = 0;
                foreach ($order->clothesOrders as $clothesOrder) {
                    foreach ($clothesOrder->extras as $extra) {
                        $clothesOrder->price += $extra->price;
                    }
                    $subtotal += $clothesOrder->price * $clothesOrder->quantity;
                }
                $total = $subtotal + $order->delivery_fee;
                $taxAmount = $total * $order->tax / 100;
                return $taxAmount;
            })
            ->editColumn('cost', function ($order) {
                $subtotal = 0;
                foreach ($order->clothesOrders as $clothesOrder) {
                    foreach ($clothesOrder->extras as $extra) {
                        $clothesOrder->price += $extra->price;
                    }
                    $subtotal += $clothesOrder->price * $clothesOrder->quantity;
                }
                return $subtotal + $order->delivery_fee;
            })
            ->addColumn('merchant', function ($order) {
                foreach ($order->clothesOrders as $clothesOrder) {
                    $clothes = Clothes::find($clothesOrder->clothes_id);
                    if(isset($clothes->shop->name))
                        return $clothes->shop->name;
                }
                return ;
            })
            ->editColumn('address', function ($order) {
                foreach ($order->clothesOrders as $clothesOrder) {
                    $clothes = Clothes::find($clothesOrder->clothes_id);
                    if(isset($clothes->shop->address))
                        return $clothes->shop->address;
                }
                return ;
            })
            ->editColumn('payment.status', function ($order) {
                return getPayment($order->payment,'status');
            })
            ->editColumn('active', function ($clothes) {
                return getBooleanColumn($clothes, 'active');
            })
            ->addColumn('action', 'orders.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'id',
                'title' => trans('lang.order_id'),

            ],
            [
                'data' => 'user.name',
                'name' => 'user.name',
                'title' => trans('lang.order_user_id'),

            ],
            [
                'data' => 'order_status.status',
                'name' => 'orderStatus.status',
                'title' => trans('lang.order_order_status_id'),

            ],
            [
                'data' => 'tax',
                'title' => trans('lang.order_tax'),
                'searchable' => false,

            ],
            [
                'data' => 'cost',
                'title' => trans('lang.order_cost'),
                'searchable' => false,

            ],
            [
                'data' => 'merchant',
                'title' => trans('lang.order_merchant'),
                'searchable' => false,

            ],
            [
                'data' => 'address',
                'title' => trans('lang.order_merchant_address'),
                'searchable' => false,

            ],
            [
                'data' => 'payment.status',
                'name' => 'payment.status',
                'title' => trans('lang.payment_status'),

            ],
            [
                'data' => 'payment.method',
                'name' => 'payment.method',
                'title' => trans('lang.payment_method'),

            ],
            [
                'data' => 'active',
                'title' => trans('lang.order_active'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.order_updated_at'),
                'searchable' => false,
                'orderable' => true,

            ]
        ];

        $hasCustomField = in_array(Order::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Order::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.order_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("user")->with("orderStatus")->with('payment');
        } else if (auth()->user()->hasRole('manager')) {
            return $model->newQuery()->with("user")->with("orderStatus")->with('payment')
                ->join("clothes_orders", "orders.id", "=", "clothes_orders.order_id")
                ->join("clothes", "clothes.id", "=", "clothes_orders.clothes_id")
                ->join("user_shops", "user_shops.shop_id", "=", "clothes.shop_id")
                ->where('user_shops.user_id', auth()->id())
                ->groupBy('orders.id')
                ->select('orders.*');
        } else if (auth()->user()->hasRole('client')) {
            return $model->newQuery()->with("user")->with("orderStatus")->with('payment')
                ->where('orders.user_id', auth()->id())
                ->groupBy('orders.id')
                ->select('orders.*');
        } else if (auth()->user()->hasRole('driver')) {
            return $model->newQuery()->with("user")->with("orderStatus")->with('payment')
                ->where('orders.driver_id', auth()->id())
                ->groupBy('orders.id')
                ->select('orders.*');
        } else {
            return $model->newQuery()->with("user")->with("orderStatus")->with('payment');
        }

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true),
                    'order' => [ [0, 'desc'] ],
                ],
                config('datatables-buttons.parameters')
            ));
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ordersdatatable_' . time();
    }
}