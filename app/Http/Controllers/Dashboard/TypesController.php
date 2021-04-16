<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateTypeRequest;
use App\Http\Requests\Dashboard\UpdateTypeRequest;
use App\Repositories\TypesRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypesController extends Controller
{
    private $typesRepository;

    public function __construct(TypesRepository $typesRepository)
    {
        $this->typesRepository = $typesRepository;
    }

    public function index($type_key)
    {
        $pageTitle = '';

        if ($type_key == 'page_type') {
            $pageTitle = _e(['pages', 'types']);
        }

        app('document')->setTitle($pageTitle);

        $types = $this->typesRepository->getTypes($type_key);

        return Inertia::render('Types/Index', ['activeId' => $type_key, 'type_key' => $type_key, 'types' => $types]);
    }

    public function store(CreateTypeRequest $createTypeRequest)
    {
        $result = $this->typesRepository->createType($createTypeRequest);

        return redirect()->back()->with(alertFromStatus($result));
    }

    public function update(UpdateTypeRequest $updateTypeRequest, $type_id)
    {
        $updated = $this->typesRepository->updateType($updateTypeRequest, $type_id);

        return redirect()->back()->with(alertFromStatus($updated));
    }

    public function destroy(Request $request)
    {
        $deleted = $this->typesRepository->deleteTypes($request->ids);

        return redirect()->back()->with(alertFromStatus($deleted));
    }
}
