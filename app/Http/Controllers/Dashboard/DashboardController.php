<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    private $dashboardRepository;
    private $activeId = 'dashboard';

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {
        $data = $this->dashboardRepository->load($request);
        $data['pageTitle'] = _e('dashboard');
        $data['pageDescription'] = _e('dashboard_description');
        $data['activeId'] = $this->activeId;

        return \Inertia\Inertia::render('Dashboard', $data);
    }
}
