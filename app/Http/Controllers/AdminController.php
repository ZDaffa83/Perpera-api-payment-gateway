<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('fdadmin.listadmin', compact('admin'));
    }

    public function create()
    {
        return view('fdadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required',
            'email_admin' => 'required|email|unique:_admin,email_admin',
            'username' => 'required|unique:_admin,username',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'nama_admin' => $request->nama_admin,
            'email_admin' => $request->email_admin,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin)
    {
        return view('fdadmin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'nama_admin' => 'required',
            'email_admin' => 'required|email|unique:_admin,email_admin,' . $admin->id,
            'username' => 'required|unique:_admin,username,' . $admin->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'nama_admin' => $request->nama_admin,
            'email_admin' => $request->email_admin,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}