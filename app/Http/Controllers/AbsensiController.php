<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::orderBy('nama')->get(); // Bisa difilter nanti
        return view('pages.absensi.index', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'keterangan' => 'required|array',
        ]);

        foreach ($request->siswa_id as $siswaId) {
            if (isset($request->keterangan[$siswaId])) {
                Absensi::create([
                    'siswa_id' => $siswaId,
                    'keterangan' => $request->keterangan[$siswaId],
                    'tanggal' => now()->toDateString(),
                ]);
            }
        }

        return redirect()->route('absensi.index')->with('success', 'Kehadiran berhasil disimpan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
