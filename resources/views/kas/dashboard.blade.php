@extends('master')
@section('content')
<!-- Tata Letak Judul Halaman dan Tombol Cetak LPJ di Pojok Kanan Atas -->
<div class="page-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #dee2e6; padding-bottom: 10px;">
    <span style="font-size: 1.6rem; font-weight: 600; color: #333;">Dashboard Analisis Keuangan UKM KSR</span>
    <a href="{{ route('kas.cetak') }}" target="_blank" class="btn btn-dark" style="font-size: 0.85rem; padding: 10px 20px; font-weight: bold;">🖨️ Cetak Laporan LPJ</a>
</div>

<style>
    /* Desain Grid Ringkasan Dana */
    .grid-dash { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px; }
    .box-info { padding: 25px; color: white; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .b-kas { background-color: #0d6efd; } .b-denda { background-color: #ffc107; color: #333; }
    .b-keluar { background-color: #dc3545; } .b-saldo { background-color: #198754; }
    .box-info small { display: block; margin-bottom: 5px; opacity: 0.8; }
    .box-info h2 { font-size: 1.8rem; }

    /* Desain Tabel Matriks Pemantauan Ceklis */
    .table-responsive { max-height: 480px; overflow: auto; border: 1px solid #dee2e6; border-radius: 4px; margin-top: 15px; }
    .table-matriks { width: 100%; border-collapse: collapse; text-align: center; font-size: 0.85rem; background: #fff; }
    .table-matriks th, .table-matriks td { padding: 10px; border: 1px solid #dee2e6; }
    .table-matriks th { position: sticky; top: 0; background: #f8f9fa; z-index: 2; font-weight: bold; }
    .sticky-col { position: sticky; left: 0; background: white !important; z-index: 1; min-width: 180px; text-align: left; font-weight: 600; border-right: 2px solid #dee2e6; }
    th.sticky-col { z-index: 3; background: #f8f9fa !important; }
    
    /* Indikator Status */
    .check-disabled { transform: scale(1.2); pointer-events: none; opacity: 0.8; }
    .badge-status { display: inline-block; padding: 2px 5px; border-radius: 4px; font-size: 0.7rem; font-weight: bold; }
    .bg-denda-aktif { background-color: #dc3545; color: white; }
</style>

<!-- BOX RINGKASAN REKAPITULASI DANA -->
<div class="grid-dash">
    <div class="box-info b-kas"><small>Total Kas Masuk</small><h2>Rp {{ number_format($dana['kas'], 0, ',', '.') }}</h2></div>
    <div class="box-info b-denda"><small>Total Denda Masuk</small><h2>Rp {{ number_format($dana['denda'], 0, ',', '.') }}</h2></div>
    <div class="box-info b-keluar"><small>Total Pengeluaran</small><h2>Rp {{ number_format($dana['pengeluaran'], 0, ',', '.') }}</h2></div>
    <div class="box-info b-saldo"><small>Sisa Saldo Kas Bersih</small><h2>Rp {{ number_format($dana['saldo'], 0, ',', '.') }}</h2></div>
</div>

<!-- TABEL PANTUAN VISUAL CEKLIS KAS 52 MINGGU -->
<div class="card card-primary" style="border-top: 3px solid #0d6efd; background: #fff; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.2); padding: 20px;">
    <h5 class="judul-seksi" style="color: #0d6efd; font-size: 1.1rem; font-weight: bold; margin-bottom: 5px;">📊 Data Pembayaran Uang Kas Anggota KSR</h5>
    <p style="font-size: 0.85rem; color: #666; margin-bottom: 15px;">Tabel di bawah ini menampilkan rekap centang secara otomatis setelah Anda menginput pembayaran kas.</p>
    
    <div class="table-responsive">
        <table class="table-matriks">
                        <thead>
                <tr>
                    <th class="sticky-col">Nama Anggota KSR</th>
                    @foreach($periods as $index => $periode)
                        @php
                            // Menghitung tanggal awal (Senin) dan akhir (Minggu) untuk rentang waktu kas secara otomatis
                            $tanggalAwal = \Carbon\Carbon::parse($periode);
                            $tanggalAkhir = $tanggalAwal->copy()->endOfWeek();
                        @endphp
                        <th>
                            Minggu {{ $index + 1 }}<br>
                            <small style="font-size:0.7rem; color:#666; font-weight:normal; display:block; white-space: nowrap;">
                                ({{ $tanggalAwal->translatedFormat('d M') }} - {{ $tanggalAkhir->translatedFormat('d M Y') }})
                            </small>
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach($anggotas as $anggota)
                <tr>
                    <td class="sticky-col">{{ $anggota->nama }}</td>
                    @foreach($periods as $periode)
                        @php
                            $dataBayar = $anggota->pembayaran->firstWhere('tanggal_periode', $periode);
                            $apakahBayar = $dataBayar ? $dataBayar->apakah_bayar : false;
                            $kenaDenda = $dataBayar ? $dataBayar->kena_denda : false;
                        @endphp
                        <td>
                            <!-- Ceklis Otomatis Bawaan SQLite -->
                            <input type="checkbox" class="check-disabled" {{ $apakahBayar ? 'checked' : '' }}>
                            
                            @if($kenaDenda)
                                <br>
                                <span class="badge-status bg-denda-aktif" style="margin-top: 4px;">⚠️ Denda</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
