<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAdminUser;
use App\Http\Requests\RequestUser;
use App\Mail\StatusMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }
    public function store(RequestAdminUser $request)
    {
        $user = User::create($request->except('team'));
        $user->roles()->sync($request->team);
        $emails = ['easuarez@vizcarra.com', 'icarvajal@vizcarra.com', 'sistemas@vizcarra.com'];
        Mail::to($emails)->send(new StatusMailable($user));
        return redirect()->route('admin.users.index');
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update(RequestUser $request, User $user)
    {
        $user->update($request->except('team'));
        if (is_null($request->team)) {
            $user->roles()->sync($request->team);
        } else {
            $user->roles()->sync($request->team);
        }
        return redirect()->route('admin.users.edit', $user)->with('info', 'El registro se actualizo correctamente');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
