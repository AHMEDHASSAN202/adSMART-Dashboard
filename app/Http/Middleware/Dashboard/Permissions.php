<?php

namespace App\Http\Middleware\Dashboard;

use App\Repositories\AuthRepository;
use Closure;
use Illuminate\Http\Request;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $me = app(AuthRepository::class)->getAdmin();
        abort_if(!$me->hasPermissions($permissions), 403);
        return $next($request);
    }
}
