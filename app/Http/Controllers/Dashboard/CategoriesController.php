<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    private $categoriesRepository;
    private $activeId = 'categories';

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        app('document')->setTitle(_e('categories'));

        $categories = $this->categoriesRepository->getCategories();

        return Inertia::render('Categories/Index', ['activeId' => $this->activeId, 'categories' => $categories]);
    }

    public function create()
    {
        app('document')->setTitle(_e('new_category'));

        $categories = $this->categoriesRepository->getCategories();

        return Inertia::render('Categories/CreateEdit', ['activeId' => $this->activeId, 'categories' => $categories]);
    }

    public function store(CreateCategoryRequest $categoryRequest)
    {
        $result = $this->categoriesRepository->createCategory($categoryRequest);

        return redirect()->route('dashboard.categories.index')->with(alertFromStatus($result));
    }

    public function edit($category_id)
    {
        app('document')->setTitle(_e(['edit', 'category']));

        $category = $this->categoriesRepository->getCategory($category_id);

        $categories = $this->categoriesRepository->getCategories();

        return Inertia::render('Categories/CreateEdit', ['activeId' => $this->activeId, 'category' => $category, 'categories' => $categories]);
    }

    public function update(UpdateCategoryRequest $categoryRequest, $category_id)
    {
        $updated = $this->categoriesRepository->updateCategory($category_id, $categoryRequest);

        return redirect()->back()->with(alertFromStatus($updated));
    }

    public function destroy(Request $request)
    {
        $deleted = $this->categoriesRepository->deleteCategories($request->ids);

        return redirect()->back()->with(alertFromStatus($deleted));
    }

    public function sort(Request $request)
    {
        $request->validate(['sortable_categories' => 'required|array']);

        $sorted = $this->categoriesRepository->sortableCategories($request->sortable_categories);

        return redirect()->back()->with(alertFromStatus($sorted));
    }
}
