<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\PagesRepository;
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

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
