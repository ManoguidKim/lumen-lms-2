<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Institution\Models\Center;
use Modules\Institution\Models\TrainerCenter;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        $roles = Role::all();
        $centers = Center::all();

        return view('user.create', [
            'rolelists' => $roles,
            'centers' => $centers
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole($request->role);

        // Add to Trainer Center table
        TrainerCenter::create([
            'center_id' => $request->center_id,
            'trainer_id' => $user->id
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User registered successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $currentRole = $user->getRoleNames();
        $currentCenter = TrainerCenter::where('trainer_id', $user->id)->first();
        $currentCenterData = Center::where('id', $currentCenter->center_id)->first();

        $roles = Role::all();
        $centers = Center::all();

        // dd($user, $currentRole, $currentCenterData, $roles, $centers);

        return view('user.view', [
            'rolelists' => $roles,
            'centers' => $centers,
            // Other details
            'user' => $user,
            'currentRole' => $currentRole,
            'currentCenterData' => $currentCenterData,
        ]);
    }
}
