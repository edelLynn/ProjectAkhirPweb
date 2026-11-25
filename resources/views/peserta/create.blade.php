@extends('layout.app')

@section('title', 'Tambah Peserta')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Tambah peserta</h1>
            <p class="page-sub">Buat akun mahasiswa baru. Mahasiswa masuk memakai email dan password ini.</p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            @include('peserta._form', [
                'action'      => route('participants.store'),
                'participant' => null,
            ])
        </div>
    </div>
@endsection
