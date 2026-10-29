@extends('master')
@section('content')
<div class="page-title">Daftar Anggota UKM Korps Sukarela</div>

<div class="card card-primary">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 80px; text-align: center;">No</th>
                <th>Nama Lengkap Anggota</th>
                <th>Instansi / UKM</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $index => $anggota)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td><strong>{{ $anggota->nama }}</strong></td>
                <td>UKM KSR ARIYANTI</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
