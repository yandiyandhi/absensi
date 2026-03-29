@extends('layouts.app')
@section('title', 'Leaderboard')
@section('header', 'Leaderboard')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2">
        <div class="transactions">
            @forelse ($presensi as $item)
                <a href="#" class="item">
                    <div class="detail">
                        <img src="{{ asset('storage/' . $item->foto_masuk) }}" alt="img" class="image-block imaged w48">
                        <div>
                            <strong>{{ $item->user->name }}</strong>
                            <p>{{ $item->jam_masuk }}</p>
                        </div>
                    </div>
                    <div class="right">
                        @if ($item->jam_masuk <= '08:01:00')
                            <div class="price text-success">Tepat Waktu</div>
                        @else
                            <div class="price text-danger">Terlambat</div>
                        @endif
                    </div>
                </a>
            @empty
                <a href="#" class="item">
                    <p>Tidak ada data presensi.</p>
                </a>
            @endforelse
        </div>
    </div>
@endsection
