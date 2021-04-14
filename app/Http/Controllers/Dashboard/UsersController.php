<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    private $usersRepository;
    private $activeId = 'users';

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function index(Request $request)
    {
        $users = $this->usersRepository->getUsers($request);
        $activeId = $this->activeId;

        return Inertia::render('Users/Index', compact('users', 'activeId'));
    }

    public function create()
    {
        $activeId = $this->activeId;

        return Inertia::render('Users/CreateEdit', compact('activeId'));
    }

    public function destroy(Request $request)
    {
        $this->usersRepository->removeUsers($request->ids);

        return redirect()->back()->with(alertFromStatus(true));
    }
}
