<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagaUserController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('pages.user.index', compact('admins'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', ['admin' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nip' => 'required|max:20|unique:users,nip,' . $user->id,
            'name' => 'required|string|max:100',
        ]);

        $user->update([
            'nip' => $request->nip,
            'name' => $request->name,
        ]);

        return redirect()->route('user.index')->with('success', 'Data admin berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Admin berhasil dihapus.');
    }
}
