<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('role.index', [
            'role' => Role::latest()->get(),
            'permissions' => Permission::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);

        $role = new Role;
        $role->name = $request->input('name');
        $role->save();

        return to_route('manage-role.index')->with('info', 'Role berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::findById($id);
        /**
        * Dalam kode di atas, perintah DB::table('role_has_permissions') menentukan tabel yang akan digunakan,
          yaitu role_has_permissions. Selanjutnya, where digunakan untuk menentukan kondisi pencarian,
          yaitu role_id yang sama dengan variabel $id.

          Perintah pluck digunakan untuk mengambil atribut yang diinginkan, yaitu permission_id, dan all digunakan untuk mengembalikan seluruh hasil dalam bentuk array.
          Jadi, kode ini akan mengembalikan array dari permission_id yang terkait dengan role_id tertentu.
         */
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role.assignPermission', [
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => Permission::latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        return view('role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = Role::findById($id);
        $role->name = $request->input('name');
        $role->update();

        return to_route('manage-role.index')->with('info', 'Role berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return to_route('manage-role.index')->with('info', 'Role berhasil dihapus');
    }

    public function assignPermission(Request $request, $id)
    {
        $role = Role::findById($id);

        /** Proses sinkronisasi permission dengan data role yang ada */
        $role->syncPermissions($request->input('permission'));

        return to_route('manage-role.index')->with('info', 'Permission berhasil diperbarui');
    }
}
