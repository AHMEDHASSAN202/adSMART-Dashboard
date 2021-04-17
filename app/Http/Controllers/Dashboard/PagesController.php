<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreatePageRequest;
use App\Http\Requests\Dashboard\UpdatePageRequest;
use App\Repositories\PagesRepository;
use App\Repositories\TypesRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    private $pagesRepository;
    private $activeId = 'pages';

    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    public function index()
    {
        app('document')->setTitle(_e('pages'));

        $pages = $this->pagesRepository->getPages();

        return Inertia::render('Pages/Index', ['activeId' => $this->activeId, 'pages' => $pages]);
    }

    public function create(TypesRepository $typesRepository)
    {
        app('document')->setTitle(_e('new_page'));

        $types = $typesRepository->getTypes('page_type');

        return Inertia::render('Pages/CreateEdit', ['activeId' => $this->activeId, 'types' => $types]);
    }

    public function store(CreatePageRequest $createPageRequest)
    {
        $result = $this->pagesRepository->createPage($createPageRequest);

        return redirect()->route('dashboard.pages.index')->with(alertFromStatus($result));
    }

    public function edit($page_id, TypesRepository $typesRepository)
    {
        app('document')->setTitle(_e(['edit', 'page']));

        $types = $typesRepository->getTypes('page_type');
        $page = $this->pagesRepository->getPage($page_id);

        return Inertia::render('Pages/CreateEdit', ['activeId' => $this->activeId, 'types' => $types, 'page' => $page]);
    }

    public function update(UpdatePageRequest $updatePageRequest, $page_id)
    {
        $updated = $this->pagesRepository->updatePage($page_id, $updatePageRequest);

        return redirect()->back()->with(alertFromStatus($updated));
    }

    public function destroy(Request $request)
    {
        $deleted = $this->pagesRepository->deletePages($request->ids);

        return redirect()->back()->with(alertFromStatus($deleted));
    }
}
