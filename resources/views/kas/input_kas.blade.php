@extends('master')
@section('content')
<div class="page-title">Pencatatan Masuk Uang Kas & Denda</div>

@if(session('success'))
    <div style="background-color: #d1e7dd; color: #0f5132; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-weight: bold;">
        {{ session('success') }}
    </div>
@endif

<div class="card card-primary">
    <h5 class="judul-seksi">Form Pembayaran (Input Manual - Pasti Tersimpan)</h5>
    <form action="{{ route('kas.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: flex-end;">
        @csrf
        <div class="form-group">
            <label>Pilih Anggota</label>
            <select name="anggota_id" class="form-control" required>
                <option value="">-- Pilih Nama --</option>
                @foreach($anggotas as $anggota)
                    <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Pilih Tanggal Periode Kas</label>
            <select name="tanggal_periode" class="form-control" required>
                <option value="">-- Pilih Minggu Kas --</option>
                @foreach($periods as $period)
                    <option value="{{ $period }}">{{ \Carbon\Carbon::parse($period)->translatedFormat('d M Y') }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="padding-bottom: 10px;">
            <label><input type="checkbox" name="apakah_bayar" value="1"> Sudah Bayar Kas (Rp5.000)</label>
        </div>
        <div class="form-group" style="padding-bottom: 10px;">
            <label style="color: #dc3545;"><input type="checkbox" name="kena_denda" value="1"> Kena Denda (Rp5.000)</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan Pembayaran</button>
        </div>
    </form>
</div>

<div class="card card-success">
    <h5 class="judul-seksi">Informasi Tambahan</h5>
    <p style="color: #555; font-size: 0.95rem;">Untuk memasukkan data kas, pilih nama anggota, pilih minggu tanggal kas, lalu centang statusnya dan klik <strong>Simpan Pembayaran</strong>. Data dijamin aman masuk ke file SQLite tanpa takut hilang saat di-refresh.</p>
</div>
@endsection
