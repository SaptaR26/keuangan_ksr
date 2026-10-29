<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PembayaranKas;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class KasController extends Controller
{
    private $tarifKas = 5000;
    private $tarifDenda = 5000;

    // Helper untuk kalkulasi ringkasan dana
    private function hitungSisaSaldo()
    {
        $totalKas = PembayaranKas::where('apakah_bayar', true)->count() * $this->tarifKas;
        $totalDenda = PembayaranKas::where('kena_denda', true)->count() * $this->tarifDenda;
        $totalKeluar = Pengeluaran::sum('nominal');
        return [
            'kas' => $totalKas,
            'denda' => $totalDenda,
            'pengeluaran' => $totalKeluar,
            'saldo' => ($totalKas + $totalDenda) - $totalKeluar
        ];
    }

           // 1. Halaman Dashboard (Perbaikan Mutlak Urutan A-Z)
    public function dashboard()
    {
        $dana = $this->hitungSisaSaldo();
        
        // Memastikan relasi pembayaran diikat langsung dengan pengurutan alfabetis A-Z
        $anggotas = Anggota::with(['pembayaran' => function($query) {
            $query->orderBy('tanggal_periode', 'asc');
        }])->orderBy('nama', 'asc')->get();

        // Generate urutan 52 minggu periode kas dari 24 Agustus 2026
        $tanggalMulai = Carbon::parse('2026-08-24');
        $periods = [];
        for ($i = 0; $i < 52; $i++) {
            $periods[] = $tanggalMulai->copy()->addWeeks($i)->format('Y-m-d');
        }

        return view('kas.dashboard', compact('dana', 'anggotas', 'periods'));
    }



    // 2. Halaman Daftar Anggota
    public function anggotaIndex()
    {
        $anggotas = Anggota::orderBy('nama', 'asc')->get();
        return view('kas.anggota', compact('anggotas'));
    }

    // 3. Halaman Input Kas (Sistem Form, Sangat Aman)
    public function kasIndex()
    {
        $anggotas = Anggota::orderBy('nama', 'asc')->get();
        $tanggalMulai = Carbon::parse('2026-08-24');
        $periods = [];
        for ($i = 0; $i < 52; $i++) {
            $periods[] = $tanggalMulai->copy()->addWeeks($i)->format('Y-m-d');
        }
        return view('kas.input_kas', compact('anggotas', 'periods'));
    }

    public function storeKas(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'tanggal_periode' => 'required',
        ]);

        $pembayaran = PembayaranKas::firstOrCreate([
            'anggota_id' => $request->anggota_id,
            'tanggal_periode' => $request->tanggal_periode
        ]);

        $pembayaran->apakah_bayar = $request->has('apakah_bayar');
        $pembayaran->kena_denda = $request->has('kena_denda');
        $pembayaran->save();

        return redirect()->back()->with('success', 'Data Kas Berhasil Diperbarui!');
    }

    // 4. Halaman Pengeluaran
    public function pengeluaranIndex()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->get();
        return view('kas.pengeluaran', compact('pengeluarans'));
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'keterangan' => 'required|string',
            'nominal' => 'required|numeric|min:0',
        ]);

        Pengeluaran::create($request->all());
        return redirect()->back()->with('success', 'Pengeluaran Berhasil Dicatat!');
    }

    public function deletePengeluaran($id)
    {
        Pengeluaran::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function cetakLPJ()
    {
        $dana = $this->hitungSisaSaldo();
        $pengeluarans = Pengeluaran::orderBy('tanggal_pengeluaran', 'asc')->get();
        return view('kas.cetak', [
            'totalKas' => $dana['kas'],
            'totalDenda' => $dana['denda'],
            'totalPengeluaran' => $dana['pengeluaran'],
            'pengeluarans' => $pengeluarans
        ]);
    }
    // Fungsi untuk menampilkan halaman login
    public function showLogin() {
        return view('login');
    }

    // Fungsi untuk memproses pencocokan username dan password
    public function prosesLogin(Request $request) {
        $user = \DB::table('users')->where('username', $request->username)->first();
        
        if ($user && password_verify($request->password, $user->password)) {
            // Membuat session tanda sukses masuk
            session(['login_ksr' => true]);
            return redirect()->route('dashboard');
        }
        
        // Kembalikan ke halaman login dengan pesan kesalahan jika gagal
        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    // Fungsi untuk keluar (clear session)
    public function logout() {
        session()->forget('login_ksr');
        return redirect()->route('login');
    }
}
