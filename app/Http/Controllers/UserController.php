<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('list-users', [
            'users' => User::latest()->get()
        ]);
    }

    public function assignRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::latest()->get();

        /**
         * Kode ini digunakan untuk mengambil semua nama role yang terkait dengan pengguna/user
         * dan menyimpannya dalam array. Array ini akan  digunakan untuk menampilkan role user
         * Pada UI atau tabel atau memeriksa apakah user memiliki role tertentu.
         */
        $userRole = $user->roles->pluck('name', 'name');

        return view('role.assignRole', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole
        ]);
    }

    public function setRoleUser(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->input('role'));
        return to_route('list-users')->with('info','Role berhasil ditambahkan');
    }
}
