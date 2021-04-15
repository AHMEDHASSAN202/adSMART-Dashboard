<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\Models\User;
use App\Repositories\RolesRepository;
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
        app('document')->setTitle(_e('users'));

        $users = $this->usersRepository->getUsers($request);
        $activeId = $this->activeId;

        return Inertia::render('Users/Index', compact('users', 'activeId'));
    }

    public function create()
    {
        app('document')->setTitle(_e('new_users'));
        $activeId = $this->activeId;
        $flags = getFlags();
        $roles = app(RolesRepository::class)->getRolesForSelectable();

        return Inertia::render('Users/CreateEdit', compact('activeId', 'flags', 'roles'));
    }

    public function store(CreateUserRequest $createUserRequest)
    {
        $newUser = $this->usersRepository->createUser($createUserRequest);

        return redirect()->route('dashboard.users.index')->with(alertFromStatus($newUser));
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        $updated = $this->usersRepository->updateUser($user, $updateUserRequest);

        return redirect()->back()->with(alertFromStatus($updated));
    }

    public function edit($userId)
    {
        app('document')->setTitle(_e(['update', 'user']));
        $flags = getFlags();
        $roles = app(RolesRepository::class)->getRolesForSelectable();
        $activeId = $this->activeId;
        $user = $this->usersRepository->getUserForEdit($userId);

        return Inertia::render('Users/CreateEdit', compact('activeId', 'flags', 'roles', 'user'));
    }

    public function destroy(Request $request)
    {
        $this->usersRepository->removeUsers($request->ids);

        return redirect()->back()->with(alertFromStatus(true));
    }
}
