<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    public function store(RequestRole $request)
    {
        $role = Role::create($request->except(['team']));
        $role->permissions()->sync($request->team);
        return redirect()->route('roles.edit', $role)->with('info', 'El rol se creó con éxito');
    }
    public function create()
    {
        $permission = Permission::all();
        return view('roles.create', compact('permission'));
    }
    public function update(Role $role, RequestRole $request)
    {
        $role->update($request->except(['team']));
        $role->permissions()->sync($request->team);
        return redirect()->route('roles.edit', $role)->with('info', 'El rol se actualizó con éxito');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info', 'El rol se eliminó con éxito');
    }
    public function edit(Role $role)
    {
        $permission = Permission::all();
        return view('roles.edit', compact('role', 'permission'));
    }
    /* public function exportExcel()
    {
        $name = 'roles-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new RoleExport, $name);
    }
    public function exportPdf()
    {
        $roles  = Role::get();
        $pdf =  PDF::loadView('pdf.roles', compact('roles'));
        $name = 'roles-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    } */
}
