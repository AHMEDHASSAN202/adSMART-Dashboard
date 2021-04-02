<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class SettingsController extends Controller
{

    public function index()
    {
        app('document')->setTitle(_e('settings'))->setDescription(_e('settings_description'));

        return view('settings::pages.index');
    }

    public function clearCache(Request $request, SettingsRepository $settingsRepository)
    {
        $cleared = $settingsRepository->clearCache();

        if ($request->wantsJson()) {
            return response()->json(['cleared' => $cleared], $cleared ? 200 : 400);
        }

        $d = [
            'toastr' => [
                'status' => $cleared ? 'success' : 'error',
                'title' => $cleared ? _e('success_message') : _e('error_message'),
            ]
        ];

        return redirect()->back()->with($d);
    }

}
