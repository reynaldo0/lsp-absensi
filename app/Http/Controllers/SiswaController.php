<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function create()
    {
        return view('pages.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn|max:20',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
    ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan.');
    }
}
