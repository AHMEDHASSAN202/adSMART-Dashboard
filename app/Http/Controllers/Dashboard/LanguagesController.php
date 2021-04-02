<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\Utilities;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Language;
use App\Http\Requests\Dashboard\CreateNewLanguageRequest;
use App\Http\Requests\Dashboard\DeleteLanguageRequest;
use App\Http\Requests\Dashboard\UpdateLanguageRequest;
use App\Repositories\LocalizationRepository;
use Inertia\Inertia;

class LanguagesController extends Controller
{
    private $localizationRepository;

    public function __construct(LocalizationRepository $localizationRepository) {
        $this->localizationRepository = $localizationRepository;
    }

    public function index(Request $request)
    {
        $data['languages'] = $this->localizationRepository->getLanguages($request);

        app('document')->setTitle(_e('languages'));

        return Inertia::render('Localization/Language/Index', $data);
    }

    public function create()
    {
        app('document')->setTitle(_e(['add', 'language']));

        return Inertia::render('Localization/Language/CreateEdit', ['flags' => Utilities::getFlags()]);
    }

    public function store(CreateNewLanguageRequest $createNewLanguageRequest)
    {
        $newLanguage = $this->localizationRepository->addNewLanguage($createNewLanguageRequest);

        return redirect()->route('dashboard.languages.index', [], 303)->with(Utilities::alertFromStatus($newLanguage));
    }

    public function edit($languageId)
    {
        $language = $this->localizationRepository->getLanguageById($languageId);
        $flags = Utilities::getFlags();

        abort_if(is_null($language), 404);

        app('document')->setTitle(_e(['edit', 'language']));

        return Inertia::render('Localization/Language/CreateEdit', compact('language', 'flags'));
    }

    public function update(Language $language, UpdateLanguageRequest $updateLanguageRequest)
    {
        $updated = $this->localizationRepository->updateLanguage($language, $updateLanguageRequest);

        return redirect()->route('dashboard.languages.index')->with(Utilities::alertFromStatus($updated));
    }

    public function destroy(DeleteLanguageRequest $deleteLanguageRequest)
    {
        $deleted = $this->localizationRepository->removeLanguage($deleteLanguageRequest->ids);

        return redirect()->back(303)->with(Utilities::alertFromStatus($deleted));
    }

    public function toggleDisplayFront(Language $language)
    {
        $this->localizationRepository->toggleDisplayFront($language);

        return redirect()->back(303)->with(Utilities::alertFromStatus(true));
    }
}
