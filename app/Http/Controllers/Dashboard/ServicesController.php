<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicesController extends Controller
{
    public function settingsPage()
    {
        app('document')->setTitle(_e('services'));

        return Inertia::render('Settings/Services', ['activeId' => 'services']);
    }
}
