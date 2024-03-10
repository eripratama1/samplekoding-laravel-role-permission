<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission.index',[
            'permissions' => Permission::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:permissions,name'
        ]);

        $permissions = new Permission;
        $permissions->name = $request->input('name');
        $permissions->save();

        return to_route('manage-permission.index')->with('info','Permission berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::findById($id);
        return view('permission.edit',['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $permissions = Permission::findById($id);
        $permissions->name = $request->input('name');
        $permissions->update();

        return to_route('manage-permission.index')->with('info','Permission berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permissions = Permission::findById($id);
        $permissions->delete();
        return to_route('manage-permission.index')->with('info','Permission berhasil dihapus');
    }
}
