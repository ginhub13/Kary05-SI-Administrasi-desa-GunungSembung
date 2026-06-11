<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KelolaAkunController extends Controller
{
    public function index()
    {
        $dataPetugas = User::oldest()->get();
        return view('admin.akun.index', compact('dataPetugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Akun petugas baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $petugas->id,
            'password' => 'nullable|string|min:6', // Password boleh kosong saat edit
        ]);

        $petugas->name = $request->name;
        $petugas->email = $request->email;
        
        // Jika form password diisi, update passwordnya
        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }
        
        $petugas->save();

        return redirect()->back()->with('success', 'Data akun petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = User::findOrFail($id);

        // Mencegah akun yang sedang login menghapus dirinya sendiri
        if ($petugas->id == Auth::id()) {
            return redirect()->back()->with('error', 'Gagal: Anda tidak dapat menghapus akun Anda sendiri saat sedang login.');
        }

        $petugas->delete();

        return redirect()->back()->with('success', 'Akun petugas berhasil dihapus dari sistem.');
    }
}