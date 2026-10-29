<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\PembayaranKas;
use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Daftar 21 Nama Anggota KSR Resmi
        $daftarNama = [
            'Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep',
            'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita',
            'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah',
            'Sapta Rosadi Permana', 'Seni Cahyani', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah',
            'Yulinda anggraeni', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho',
            'Reyhan avisa rizvan', 'Nurul wahidah'
        ];

        // Pembuatan urutan 52 minggu periode kas dari 24 Agustus 2026
        $tanggalMulai = Carbon::parse('2026-08-24');
        $periodeKas = [];
        for ($i = 0; $i < 52; $i++) {
            $periodeKas[] = $tanggalMulai->copy()->addWeeks($i)->format('Y-m-d');
        }

        // Simpan ID anggota ke dalam array untuk mempermudah pemetaan data
        $anggotaIds = [];
        foreach ($daftarNama as $nama) {
            $anggota = Anggota::create(['nama' => $nama]);
            $anggotaIds[$nama] = $anggota->id;
        }

        // =========================================================================
        // LOGIC OTOMATISASI: Seni Cahyani & Yulinda Anggraeni (LUNAS 1 PERIODE - 52 MINGGU)
        // =========================================================================
        foreach (['Seni Cahyani', 'Yulinda anggraeni'] as $lunasName) {
            foreach ($periodeKas as $periode) {
                PembayaranKas::create([
                    'anggota_id' => $anggotaIds[$lunasName],
                    'tanggal_periode' => $periode,
                    'apakah_bayar' => true,
                    'kena_denda' => false
                ]);
            }
        }

        // =========================================================================
        // SUNTIK DATA HISTORIS KAS MINGGU 1 - 15 (SESUAI CATATAN TEKS ANDA)
        // =========================================================================

        // --- MINGGU 1 (24 Agst - 30 Agst 2026) ---
        $m1_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[0], $m1_bayar, []);

        // --- MINGGU 2 (31 Agst - 6 Sept 2026) ---
        $m2_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[1], $m2_bayar, []);

        // --- MINGGU 3 (7 Sept - 13 Sept 2026) ---
        $m3_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[2], $m3_bayar, []);

        // --- MINGGU 4 (14 Sept - 20 Sept 2026) ---
        $m4_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[3], $m4_bayar, []);

        // --- MINGGU 5 (21 Sept - 27 Sept 2026) ---
        $m5_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[4], $m5_bayar, []);

        // --- MINGGU 6 (28 Sept - 4 Okt 2026) -> Ririn Cantika (+Denda) ---
        $m6_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $m6_denda = ['Ririn Cantika'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[5], $m6_bayar, $m6_denda);

        // --- MINGGU 7 (5 Okt - 11 Okt 2026) -> Farid Febrian & Reyhan avisa (+Denda) ---
        $m7_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $m7_denda = ['Farid Febrian', 'Reyhan avisa rizvan'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[6], $m7_bayar, $m7_denda);

        // --- MINGGU 8 (12 Okt - 18 Okt 2026) -> Regina, Reyhan, Nurul (+Denda) ---
        $m8_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $m8_denda = ['Regina Puspita', 'Reyhan avisa rizvan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[7], $m8_bayar, $m8_denda);

        // --- MINGGU 9 (19 Okt - 25 Okt 2026) -> Reyhan (+Denda) Saja (Kotak Kas Kosong) ---
        $m9_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Ardi Awaludin', 'Asep', 'Artika Citra Lestari', 'Davina Noviandini', 'Farid Febrian', 'Regina Puspita', 'Reva Noviara', 'Ririn Cantika', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Siti Lesya Alfiyani', 'Teuku Reyki Septiansyah', 'Yusup Muhammad Ramdan', 'Ramdan Dwi Nugroho', 'Nurul wahidah'];
        $m9_denda = ['Reyhan avisa rizvan'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[8], $m9_bayar, $m9_denda);

        // --- MINGGU 10 (26 Okt - 1 Nov 2026) ---
        $m10_bayar = ['Adelya Putri Ramadhani', 'Andien Amalia Pratiwi', 'Artika Citra Lestari', 'Farid Febrian', 'Regina Puspita', 'Rizki Pratama Putra', 'Sapira Rizki Fauziyah', 'Sapta Rosadi Permana', 'Yusup Muhammad Ramdan', 'Nurul wahidah'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[9], $m10_bayar, []);

        // --- MINGGU 11 (2 Nov - 8 Nov 2026) ---
        $m11_bayar = ['Artika Citra Lestari', 'Farid Febrian', 'Rizki Pratama Putra'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[10], $m11_bayar, []);

        // --- MINGGU 12 (9 Nov - 15 Nov 2026) ---
        $m12_bayar = ['Artika Citra Lestari', 'Rizki Pratama Putra'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[11], $m12_bayar, []);

        // --- MINGGU 13 (16 Nov - 22 Nov 2026) ---
        $m13_bayar = ['Rizki Pratama Putra'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[12], $m13_bayar, []);

        // --- MINGGU 14 (23 Nov - 29 Nov 2026) ---
        $m14_bayar = ['Rizki Pratama Putra'];
        $this->prosesSuntikKas($anggotaIds, $periodeKas[13], $m14_bayar, []);


        // =========================================================================
        // DATA HISTORIS LOG PENGELUARAN DANA KSR
        // =========================================================================
        Pengeluaran::create([
            'tanggal_pengeluaran' => '2026-08-25',
            'keterangan' => 'Print penerimaan calon anggota',
            'nominal' => 4000
        ]);

        // =========================================================================
        // DATA HISTORIS LOG AKUN LOGIN BENDHARA
        // =========================================================================
        \DB::table('users')->insert([
            'username' => 'bendaharaksr',
            'password' => password_hash('ksr2026', PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Helper otomatis untuk memproses record data kas & denda ke SQLite
     */
    private function prosesSuntikKas($anggotaIds, $tanggalTarget, $listBayar, $listDenda)
    {
        // 1. Proses Suntik Anggota yang Membayar Kas
    foreach ($listBayar as $nama) {
$id = $anggotaIds[$nama] ?? null;
if ($id) {
PembayaranKas::updateOrCreate(
['anggota_id' => $id, 'tanggal_periode' => $tanggalTarget],
['apakah_bayar' => true]
);
}
}
// 2. Proses Suntik Anggota yang Terkena Denda
foreach ($listDenda as $nama) {
$id = $anggotaIds[$nama] ?? null;
if ($id) {
PembayaranKas::updateOrCreate(
['anggota_id' => $id, 'tanggal_periode' => $tanggalTarget],
['kena_denda' => true]
);
}
}
}
}