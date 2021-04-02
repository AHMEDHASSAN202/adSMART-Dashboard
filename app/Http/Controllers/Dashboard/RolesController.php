<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\Utilities;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Role;
use App\Http\Requests\Dashboard\CreateNewRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use App\Repositories\RolesRepository;

class RolesController extends Controller
{
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }


    public function index(Request $request)
    {
        app('document')->setTitle(_e('roles'))->setDescription(_e('browse'));

        $roleForUpdate = null;

        //edit role
        if ($editRoleId = $request->query('editRole')) {
            $roleForUpdate = $this->rolesRepository->getRole($editRoleId);
        }

        if ($request->wantsJson()) {
            //edit role
            if ($roleForUpdate) {
                return response()->json($roleForUpdate);
            }
            $roles = $this->rolesRepository->getRoles($request);
            $ktColumns = $this->rolesRepository->showRolesColumns($roles);
            $data = Utilities::KtDatatableResponse($ktColumns, null, 'asc', '#');
            return response()->json($data);
        }

        return view('roles::pages.roles_index', ['roleForUpdate' => $roleForUpdate]);
    }

    public function addRole(CreateNewRoleRequest $createNewRoleRequest)
    {
        $result = $this->rolesRepository->addNewRole($createNewRoleRequest->all());

        if ($createNewRoleRequest->wantsJson()) {
            return response()->json([], $result ? 400 : 201);
        }

        return redirect()->route('roles.index')->with(Utilities::toastr($result));
    }

    public function updateRole(Role $role, UpdateRoleRequest $updateRoleRequest)
    {
        $this->rolesRepository->updateRole($role->role_id, $updateRoleRequest->all());

        if ($updateRoleRequest->wantsJson()) {
            return response()->json([], 200);
        }

        return redirect()->route('roles.index')->with(Utilities::toastr(true));
    }

    public function deleteRole(Request $request)
    {
        $this->rolesRepository->deleteRoles($request->ids);

        if ($request->wantsJson()) {
            return response()->json([], 200);
        }

        return redirect()->route('roles.index')->with(Utilities::toastr(true));
    }
}
