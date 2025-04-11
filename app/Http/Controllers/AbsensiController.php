<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::now()->toDateString();

        $absensiHariIni = Absensi::with('siswa')
            ->whereDate('tanggal', $tanggal)
            ->get();

        return view('pages.absensi.index', compact('absensiHariIni'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'keterangan' => 'required|array',
        ]);

        $tanggal = now()->toDateString();

        foreach ($request->siswa_id as $siswaId) {
            $keterangan = $request->keterangan[$siswaId] ?? null;

            if ($keterangan) {
                Absensi::updateOrCreate(
                    ['siswa_id' => $siswaId, 'tanggal' => $tanggal],
                    ['keterangan' => $keterangan]
                );
            }
        }

        return redirect()->route('absensi.create')->with('success', 'Data kehadiran berhasil disimpan atau diperbarui.');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $tanggal = now()->toDateString();
        $kelasFilter = $request->get('kelas_filter');

        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');

        $query = Siswa::orderBy('nama');
        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        $siswa = $query->paginate(10)->appends(['kelas_filter' => $kelasFilter]);

        $absenHariIni = Absensi::whereDate('tanggal', $tanggal)->get()->keyBy('siswa_id');

        return view('pages.absensi.create', compact('siswa', 'absenHariIni', 'kelasFilter', 'kelasList'));
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
