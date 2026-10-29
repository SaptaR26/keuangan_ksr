@extends('master')
@section('content')
<div class="page-title">Pencatatan Pengeluaran Operasional KSR</div>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 30px;">
    <!-- Form Pengeluaran -->
    <div class="card card-danger">
        <h5 class="judul-seksi" style="color: #dc3545;">Catat Uang Keluar</h5>
        <form action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf
            <div class="form-group"><label>Tanggal Pengeluaran</label><input type="date" name="tanggal_pengeluaran" class="form-control" required></div>
            <div class="form-group"><label>Keperluan Logistik</label><input type="text" name="keterangan" class="form-control" placeholder="Beli Alkohol & Kasa P3K" required></div>
            <div class="form-group"><label>Nominal Uang (Rp)</label><input type="number" name="nominal" class="form-control" placeholder="100000" required></div>
            <button type="submit" class="btn btn-danger" style="width: 100%;">Simpan Pengeluaran</button>
        </form>
    </div>

    <!-- Tabel Pengeluaran -->
    <div class="card card-danger">
        <h5 class="judul-seksi">Riwayat Pengeluaran Dana KSR</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keperluan / Logistik</th>
                    <th>Nominal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluarans as $p)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pengeluaran)->format('d-m-Y') }}</td>
                    <td><strong>{{ $p->keterangan }}</strong></td>
                    <td style="color: #dc3545; font-weight: bold;">-Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td style="text-align: center;"><a href="{{ route('pengeluaran.delete', $p->id) }}" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.8rem;" onclick="return confirm('Hapus log pengeluaran ini?')">Hapus</a></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center; color: #888;">Belum ada log pengeluaran keuangan KSR.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
