@extends('layout.app')

@section('title', 'Ubah Peserta')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Ubah peserta</h1>
            <p class="page-sub">{{ $participant->name }} · {{ $participant->nim }}</p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            @include('peserta._form', [
                'action'      => route('participants.update', $participant->id),
                'participant' => $participant,
            ])
        </div>
    </div>
@endsection
