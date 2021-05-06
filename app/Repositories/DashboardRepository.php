<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;

use Illuminate\Http\Request;

class DashboardRepository
{
    public function load(Request $request)
    {
        return [
            'countUsers'    => app(UsersRepository::class)->getCountUsers(),
            'countPages'    => app(PagesRepository::class)->getCountPages(),
            'countCategories'    => app(CategoriesRepository::class)->getCountCategories(),
            'latestUsers'    => app(UsersRepository::class)->getLatestUsers(),
        ];
    }
}
