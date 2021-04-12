<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\UpdateTranslateRequest;
use App\Repositories\LocalizationRepository;
use Inertia\Inertia;


class TranslationsController extends Controller
{
    private $localizationRepository;

    public function __construct(LocalizationRepository $localizationRepository)
    {
        $this->localizationRepository = $localizationRepository;
    }

    function index(Request $request)
    {
        app('document')->setTitle(_e('translations'));

        $translations =  $this->localizationRepository->getTranslations($request);

        return Inertia::render('Localization/Translations/Index', compact('translations'));
    }

    public function updateTranslate(UpdateTranslateRequest $updateTranslateRequest)
    {
        //validate data
        $data = $updateTranslateRequest->validated();
        //update method
        $this->localizationRepository->updateTranslate($data['translations']);

        return response()->json(alertFromStatus(true));
    }

}
