<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roleRepository = null;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return view('role.index');
    }

    public function show($id)
    {
        $role = $this->roleRepository->findById($id);
        $permissions = Permission::all();

        $currentPermissions = $role->permissions->pluck('id')->toArray();

        return view('role.view', compact('role', 'permissions', 'currentPermissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $validated = $request->validated();
        $role = $this->roleRepository->create(['name' => $validated['roleName'], 'guard_name' => 'web']);
        $role->permissions()->sync($validated['selectedPermissions']);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $validated = $request->validated();
        $role = $this->roleRepository->updateById($id, ['name' => $validated['roleName'], 'guard_name' => 'web']);
        $role->permissions()->sync($validated['selectedPermissions']);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->roleRepository->deleteById($id);

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
