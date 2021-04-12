<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
            $info = app('App\Repositories\VisitorsInformationRepository')->getVisitorInformation();
            $language = $info['language'];
        }

        app()->setLocale($language->language_code);

        return $next($request);
    }
}
