<?php

namespace App\Http\Controllers;

use App\Models\Selfie;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SelfieController extends Controller
{
    public function index()
    {
        // Ambil semua data absensi dari database
        $absensis = Selfie::all();

        // Tampilkan halaman dengan data absensi
        return view('pages.selfie.index', compact('absensis'));
    }

    public function create()
    {
        // Ambil daftar siswa untuk ditampilkan di form (jika diperlukan)
        $siswa = Siswa::all();

        // Tampilkan form selfie
        return view('pages.selfie.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => 'required|exists:siswas,nisn',
            'keterangan' => 'required|in:Hadir,Sakit,Izin,Terlambat,Alpha',
            'image' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'alamat' => 'required|string', // Menambahkan validasi untuk alamat
        ]);

        // Ambil data siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $request->nisn)->firstOrFail();
        $tanggal = now()->toDateString(); // Tanggal hari ini

        $imagePath = null;

        // Menyimpan gambar jika ada
        if ($request->image) {
            $imageData = str_replace('data:image/jpeg;base64,', '', $request->image);
            $imageData = str_replace(' ', '+', $imageData);
            $fileName = 'selfie_' . $siswa->nisn . '_' . time() . '.jpg';
            Storage::disk('public')->put("selfies/{$fileName}", base64_decode($imageData));
            $imagePath = "selfies/{$fileName}";
        }

        // Simpan atau update data absensi selfie ke database
        Selfie::updateOrCreate(
            ['siswa_id' => $siswa->id, 'tanggal' => $tanggal],
            [
                'keterangan' => $request->keterangan,
                'image_path' => $imagePath,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'alamat' => $request->alamat, // Menambahkan alamat ke data yang disimpan
                'waktu' => now(), // Menyimpan waktu saat data disimpan
            ]
        );

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Absensi selfie berhasil');
    }
}
