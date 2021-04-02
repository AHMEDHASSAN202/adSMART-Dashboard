<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class InitialVisitorInfoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->query('lang')) {
            $language = app('App\Repositories\LocalizationRepository')->getLanguage($request->query('lang'));
        }

        if (empty($language)) {
            $language = app('App\Repositories\VisitorsInformationRepository')->getVisitorInformation();
        }

        app()->setLocale($language->language_code);

        View::share('language', $language);

        return $next($request);
    }
}
