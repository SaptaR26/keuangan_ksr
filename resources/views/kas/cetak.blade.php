<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pertanggungjawaban Keuangan KSR</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .summary-box { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .summary-box td, .summary-box th { padding: 8px; border: 1px solid #ddd; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table-data th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>LAPORAN PERTANGGUNGJAWABAN (LPJ) KEUANGAN</h2>
        <h3>UNIT KEGIATAN MAHASISWA KORPS SUKARELA (UKM KSR)</h3>
        <p>Periode Kas Aktif: 24 Agustus 2026 - Agustus 2027</p>
    </div>

    <h4>I. RINGKASAN REKAPITULASI DANA</h4>
    <table class="summary-box">
        <tr><th>Total Penerimaan Uang Kas Pokok</th><td class="text-right">Rp {{ number_format($totalKas, 0, ',', '.') }}</td></tr>
        <tr><th>Total Penerimaan Uang Denda</th><td class="text-right">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td></tr>
        <tr style="background-color: #f9f9f9; font-weight: bold;"><th>TOTAL SELURUH PEMASUKAN</th><td class="text-right">Rp {{ number_format($totalKas + $totalDenda, 0, ',', '.') }}</td></tr>
        <tr style="color: red;"><th>TOTAL SELURUH PENGELUARAN (-)</th><td class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td></tr>
        <tr style="background-color: #e6ffe6; font-weight: bold; font-size: 1.1em; border: 2px solid green;"><th>SISA SALDO BERSIH ORGANISASI (KAS SEKARANG)</th><td class="text-right">Rp {{ number_format(($totalKas + $totalDenda) - $totalPengeluaran, 0, ',', '.') }}</td></tr>
    </table>

    <h4>II. RINCIAN PENGGUNAAN DANA (PENGELUARAN)</h4>
    <table class="table-data">
        <thead>
            <tr><th style="width: 5%;">No</th><th style="width: 20%;">Tanggal</th><th style="width: 50%;">Keterangan / Keperluan Operasional</th><th style="width: 25%; text-align: right;">Nominal</th></tr>
        </thead>
        <tbody>
            @forelse($pengeluarans as $index => $pengeluaran)
            <tr><td>{{ $index + 1 }}</td><td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal_pengeluaran)->translatedFormat('d F Y') }}</td><td>{{ $pengeluaran->keterangan }}</td><td class="text-right">Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td></tr>
            @empty
            <tr><td colspan="4" style="text-align: center; color: gray;">Belum ada catatan pengeluaran dana.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 50px; float: right; text-align: center; width: 200px;">
        <p>Mengetahui,</p>
        <p style="margin-top: 60px; font-weight: bold; border-bottom: 1px solid #000;">Bendahara UKM KSR</p>
    </div>
</body>
</html>
