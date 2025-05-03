<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList    = Siswa::select('kelas')->distinct()->pluck('kelas');
        $kelasFilter  = $request->kelas_filter;
        $search       = $request->search;
        $periode      = $request->periode ?? 10;
        $startDate    = now()->subDays($periode);

        $query = Absensi::with('siswa')
            ->whereDate('created_at', '>=', $startDate);

        if ($kelasFilter) {
            $query->whereHas('siswa', function ($q) use ($kelasFilter) {
                $q->where('kelas', $kelasFilter);
            });
        }

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%");
            });
        }

        $dataAbsensi = $query->latest()->get();

        $terlambat     = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Terlambat')->count();

        $hadir         = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Hadir')->count();

        $totalHariIni  = Absensi::whereDate('created_at', '>=', $startDate)->count();

        return view('pages.absensi.index', compact(
            'dataAbsensi',
            'kelasList',
            'kelasFilter',
            'search',
            'periode',
            'terlambat',
            'hadir',
            'totalHariIni'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'keterangan' => 'required|array'
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

        return redirect()->route('absensi.store')->with('susccess', 'data berhasil disimpan');
    }

    public function create(Request $request)
    {
        $tanggal = now()->toDateString();
        $kelasFilter = $request->get('kelas_filter');

        $query = Siswa::orderBy('nama');
        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        $siswa = $query->paginate(10)->appends(['kelas_filter' => $kelasFilter]);

        $absenHariIni = Absensi::whereDate('tanggal', $tanggal)->get()->keyBy('siswa_id');

        return view('pages.absensi.create', compact('siswa', 'absenHariIni', 'kelasFilter'));
    }

    public function destroy(string $id)
    {
        $data = Absensi::find($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
