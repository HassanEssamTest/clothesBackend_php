<?php

namespace App\Http\Controllers;

use App\DataTables\PricingDataTable;
use App\Repositories\PricingRepository;
use App\Repositories\UploadRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use App\Repositories\CoinRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\Governorate;
use App\Models\City;

class PricingController extends Controller
{
    /** @var  PricingRepository */
    private $pricingRepository;

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CoinRepository
     */
    private $coinRepository;

    public function __construct(PricingRepository $pricingRepo, UploadRepository $uploadRepo,
                                ShopRepository $shopRepo, UserRepository $userRepo, CoinRepository $coinRepo)
    {
        parent::__construct();
        $this->pricingRepository = $pricingRepo;
        $this->uploadRepository = $uploadRepo;
        $this->shopRepository = $shopRepo;
        $this->userRepository = $userRepo;
        $this->coinRepository = $coinRepo;
    }

    /**
     * Display a listing of the Pricing.
     *
     * @param PricingDataTable $pricingDataTable
     * @return Response
     */
    public function index(PricingDataTable $pricingDataTable)
    {
        return $pricingDataTable->render('pricings.index');
    }

    /**
     * Show the form for creating a new Pricing.
     *
     * @return Response
     */
    public function create()
    {
        if (request()->ajax())
        {
            $id = request()->id;
            $type = request()->type;
            
            if ($type=='from_governorate_id')
            {
                $from_city = City::where('governorate_id', $id)->orderBy('name')->get()->pluck('name','id');
                $selectedFromCities =[];
                return view('pricings.cities', compact('type','id','from_city','selectedFromCities'))->render();
            }
            else if ($type=='to_governorate_id')
            {
                $to_city = City::where('governorate_id', $id)->orderBy('name')->get()->pluck('name','id');
                $selectedToCities =[];
                return view('pricings.cities', compact('type','id','to_city','selectedToCities'))->render();
            }
        }
        $governorates = Governorate::orderBy('name')->get()->pluck('name','id');
        return view('pricings.create')
            ->with("governorates", $governorates);
    }

    /**
     * Store a newly created Pricing in storage.
     *
     * @param CreatePricingRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $pricing = $this->pricingRepository->create($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.pricing')]));

        return redirect(route('pricings.index'));
    }

    /**
     * Display the specified Pricing.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pricing = $this->pricingRepository->findWithoutFail($id);

        if (empty($pricing)) {
            Flash::error('Pricing not found');

            return redirect(route('pricings.index'));
        }

        return view('pricings.show')->with('pricing', $pricing);
    }

    /**
     * Show the form for editing the specified Pricing.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pricing = $this->pricingRepository->findWithoutFail($id);

        if (empty($pricing)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.pricing')]));

            return redirect(route('pricings.index'));
        }
        if (request()->ajax())
        {
            $id = request()->id;
            $type = request()->type;
            
            if ($type=='from_governorate_id')
            {
                $from_city = City::where('governorate_id', $id)->orderBy('name')->get()->pluck('name','id');
                $selectedFromCities =[];
                return view('pricings.cities', compact('type','id','from_city','selectedFromCities'))->render();
            }
            else if ($type=='to_governorate_id')
            {
                $to_city = City::where('governorate_id', $id)->orderBy('name')->get()->pluck('name','id');
                $selectedToCities =[];
                return view('pricings.cities', compact('type','id','to_city','selectedToCities'))->render();
            }
        }
        $governorates = Governorate::orderBy('name')->get()->pluck('name','id');

        return view('pricings.edit')->with('pricing', $pricing)
            ->with("governorates", $governorates);
    }

    /**
     * Update the specified Pricing in storage.
     *
     * @param int $id
     * @param UpdatePricingRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        \DB::beginTransaction();
        $pricing = $this->pricingRepository->findWithoutFail($id);

        if (empty($pricing)) {
            Flash::error('Pricing not found');
            return redirect(route('pricings.index'));
        }
        $input = $request->all();
        try {
            $pricing = $this->pricingRepository->update($input, $id);
            \DB::commit();
        } catch (ValidatorException $e) {
            \DB::rollBack();
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.pricing')]));

        return redirect(route('pricings.index'));
    }

    /**
     * Remove the specified Pricing from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pricing = $this->pricingRepository->findWithoutFail($id);

        if (empty($pricing)) {
            Flash::error('Pricing not found');

            return redirect(route('pricings.index'));
        }

        $this->pricingRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.pricing')]));

        return redirect(route('pricings.index'));
    }
}
