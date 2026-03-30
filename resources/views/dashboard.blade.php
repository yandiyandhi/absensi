@extends('layouts.app')
@section('title', 'PRESENSI')
@section('header', 'PRESENSI')
@section('content')
    @include('layouts.loader')
    <!-- Wallet Card -->
    <div class="section wallet-card-section pt-1">
        <div class="wallet-card">
            <!-- Balance -->
            <div class="balance">
                <div class="left">
                    <span class="title">Jam Masuk</span>
                    <h1 class="total">
                        @if (empty($user->jam_masuk))
                            <span>00:00</span>
                        @else
                            {{ $user->jam_masuk->format('H:i') }}
                        @endif
                    </h1>
                </div>
                <div class="right">
                    <span class="title">Jam Keluar</span>
                    <h1 class="total">
                        @if (empty($user->jam_keluar))
                            <span>00:00</span>
                        @else
                            {{ $user->jam_keluar->format('H:i') }}
                        @endif
                    </h1>
                </div>
            </div>
            <!-- * Balance -->
            <!-- Wallet Footer -->
            <div class="wallet-footer">
                <div class="item">
                    <a href="{{ route('presensi.histori') }}">
                        <div class="icon-wrapper bg-danger">
                            <ion-icon name="time-outline"></ion-icon>
                        </div>
                        <strong>Histori</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                        <div class="icon-wrapper">
                            <ion-icon name="wallet-outline"></ion-icon>
                        </div>
                        <strong>Slip Gaji</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="app-cards.html">
                        <div class="icon-wrapper bg-success">
                            <ion-icon name="partly-sunny-outline"></ion-icon>
                        </div>
                        <strong>Cuti</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="{{ route('izin.index') }}">
                        <div class="icon-wrapper bg-warning">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </div>
                        <strong>Izin</strong>
                    </a>
                </div>

            </div>
            <!-- * Wallet Footer -->
        </div>
    </div>
    <!-- Wallet Card -->

    <div class="section full mt-2">
        <div class="section-heading padding">
            <h4 class="font-weight-bold">Foto Absen</h4>
        </div>
        <!-- carousel small -->
        <div class="carousel-small splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($presensi as $item)
                        <li class="splide__slide">
                            <img src="{{ asset($item->foto_masuk ? 'storage/' . $item->foto_masuk : 'assets/img/sample/logo.png') }}"
                                alt="img"
                                class="image-block imaged w48 {{ $item->foto_masuk ? 'clickable-img' : '' }}">
                        </li>
                    @empty
                        <li class="splide__slide">
                            <img src="{{ asset('assets/img/sample/logo.png') }}" alt="img"
                                class="image-block imaged w48">
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <!-- * carousel small -->

    </div>

    <!-- Transactions -->
    <div class="section mt-2 mb-4">
        <div class="section-heading">
            <h4 class="font-weight-bold">Leaderboard</h4>
            <a href="{{ route('leaderboard.index') }}" class="link">View All</a>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#masuk" role="tab">
                            In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#keluar" role="tab">
                            Out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#not" role="tab">
                            Not
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-2">
                    <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                        <div class="transactions">
                            @forelse ($presensi as $item)
                                <a href="#" class="item">
                                    <div class="detail">
                                        <img src="{{ asset('storage/' . $item->foto_masuk) }}" alt="img"
                                            class="image-block imaged w48">
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
                    <div class="tab-pane fade" id="keluar" role="tabpanel">
                        <div class="transactions">
                            @forelse ($out as $item)
                                <a href="#" class="item">
                                    <div class="detail">
                                        <img src="{{ asset('storage/' . $item->foto_keluar) }}" alt="img"
                                            class="image-block imaged w48">
                                        <div>
                                            <strong>{{ $item->user->name }}</strong>
                                            <p>{{ $item->jam_keluar }}</p>
                                        </div>
                                    </div>
                                    <div class="right">

                                    </div>
                                </a>
                            @empty
                                <a href="#" class="item">
                                    <p>Tidak ada data presensi.</p>
                                </a>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="not" role="tabpanel">
                        <div class="transactions">
                            @forelse ($belumPresensi as $item)
                                <a href="#" class="item">
                                    <div class="detail">
                                        <img src="{{ asset('assets/img/sample/logo.png') }}" alt="img"
                                            class="image-block imaged w48">
                                        <div>
                                            <strong>{{ $item->name }}</strong>

                                        </div>
                                    </div>
                                    <div class="right">

                                    </div>
                                </a>
                            @empty
                                <a href="#" class="item">
                                    <p>Tidak ada data presensi.</p>
                                </a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Transactions -->

    <div id="imgOverlay">
        <img src="" alt="Preview">
    </div>
@endsection
@push('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const overlay = document.getElementById('imgOverlay');
            const overlayImg = overlay.querySelector('img');

            document.querySelectorAll('.clickable-img').forEach(img => {
                img.addEventListener('click', () => {
                    overlayImg.src = img.src;
                    overlay.style.display = 'flex';
                });
            });

            // Tutup overlay kalau di klik ✖ atau background
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay || e.target === overlayImg) {
                    overlay.style.display = 'none';
                }
            });

            // Tutup overlay dengan tombol ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    overlay.style.display = 'none';
                }
            });

        });
    </script>
@endpush
