<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingsContactUsDataUpdatedRequest;
use App\Http\Requests\Dashboard\SettingsDashboardDataUpdatedRequest;
use App\Http\Requests\Dashboard\SettingsGeneralDataUpdatedRequest;
use App\Repositories\OptionRepository;
use App\Repositories\RolesRepository;
use App\Repositories\SettingsRepository;
use Inertia\Inertia;

class SettingsController extends Controller
{
    private $optionRepository;
    private $activeId = 'settings';

    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    public function index()
    {
        app('document')->setTitle(_e('settings'));
        $roles = app(RolesRepository::class)->getRoles();

        return Inertia::render('Settings/Index', ['activeId' => $this->activeId, 'roles' => $roles]);
    }

    public function updateGeneralData(SettingsGeneralDataUpdatedRequest $settingsGeneralDataUpdatedRequest)
    {
        $this->optionRepository->saveOptions($settingsGeneralDataUpdatedRequest->validated());

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function updateContactUsData(SettingsContactUsDataUpdatedRequest $settingsContactUsDataUpdatedRequest)
    {
        $this->optionRepository->saveOptions($settingsContactUsDataUpdatedRequest->validated());

        return redirect()->back()->with(alertFromStatus(true));
    }

    public function updateDashboardData(SettingsDashboardDataUpdatedRequest $settingsDashboardDataUpdatedRequest)
    {
        $this->optionRepository->saveOptions($settingsDashboardDataUpdatedRequest->validated());

        return redirect()->back()->with(alertFromStatus(true));
    }

}
