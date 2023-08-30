<?php

namespace App\Http\Controllers;

use App\DataTables\TopCategoryDataTable;
use App\Repositories\TopCategoryRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\CategoryRepository;
use App\Repositories\ClothesCategoryRepository;

class TopCategoryController extends Controller
{
    /** @var  TopCategoryRepository */
    private $topCategoryRepository;

    /** @var  CategoryRepository */
    private $categoryRepository;

    /** @var  ClothesCategoryRepository */
    private $clothesCategoryRepository;

    public function __construct(TopCategoryRepository $topCategoryRepo, CategoryRepository $categoryRepo,
                                ClothesCategoryRepository $clothesCategoryRepo)
    {
        parent::__construct();
        $this->topCategoryRepository = $topCategoryRepo;
        $this->categoryRepository = $categoryRepo;
        $this->clothesCategoryRepository = $clothesCategoryRepo;
    }

    /**
     * Display a listing of the TopCategory.
     *
     * @param TopCategoryDataTable $topCategoryDataTable
     * @return Response
     */
    public function index(TopCategoryDataTable $topCategoryDataTable)
    {
        return $topCategoryDataTable->render('top_categories.index');
    }

    /**
     * Show the form for creating a new TopCategory.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->categoryRepository->pluck('name', 'id');
        $clothesCategory = $this->clothesCategoryRepository->pluck('name', 'id');
        return view('top_categories.create')
                ->with("category", $category)
                ->with("clothesCategory", $clothesCategory);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $topCategory = $this->topCategoryRepository->create($input);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.topCategories')]));

        return redirect(route('topCategories.index'));
    }

    /**
     * Display the specified TopCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $topCategory = $this->topCategoryRepository->findWithoutFail($id);

        if (empty($topCategory)) {
            Flash::error('TopCategory not found');

            return redirect(route('topCategories.index'));
        }

        return view('top_categories.show')->with('topCategory', $topCategory);
    }

    /**
     * Show the form for editing the specified TopCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $topCategory = $this->topCategoryRepository->findWithoutFail($id);

        $category = $this->categoryRepository->pluck('name', 'id');
        $clothesCategory = $this->clothesCategoryRepository->pluck('name', 'id');
        if (empty($topCategory)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.topCategories')]));

            return redirect(route('topCategories.index'));
        }
        return view('top_categories.edit')
                ->with('topCategory', $topCategory)
                ->with("category", $category)
                ->with("clothesCategory", $clothesCategory);
    }

    public function update($id, Request $request)
    {
        $topCategory = $this->topCategoryRepository->findWithoutFail($id);

        if (empty($topCategory)) {
            Flash::error('Top Category not found');
            return redirect(route('topCategories.index'));
        }
        $input = $request->all();
        try {
            $topCategory = $this->topCategoryRepository->update($input, $id);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.topCategories')]));

        return redirect(route('topCategories.index'));
    }

    /**
     * Remove the specified TopCategory from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $topCategory = $this->topCategoryRepository->findWithoutFail($id);

        if (empty($topCategory)) {
            Flash::error('TopCategory not found');

            return redirect(route('topCategories.index'));
        }

        $this->topCategoryRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.topCategories')]));

        return redirect(route('topCategories.index'));
    }

}
