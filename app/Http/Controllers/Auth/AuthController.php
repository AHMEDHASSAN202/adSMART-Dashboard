<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;
    protected $target = '';
    protected $loginView = 'dashboard.dashboard-login';

    public function __construct(AuthRepository $authRepository, Request $request)
    {
        $this->authRepository = $authRepository;
        $this->target = $request->query('target');
    }

    public function loginPage()
    {
        return view($this->loginView, ['target' => $this->target]);
    }
}
