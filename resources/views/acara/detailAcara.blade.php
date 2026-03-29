@extends('layouts.app')
@section('title', 'Detail Acara')
@section('header', 'Detail Acara')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Nama Acara">Nama Acara</label>
                            <input type="text" class="form-control" id="nama_acara" name="nama_acara"
                                placeholder="Nama Acara" value="{{ $acara->nama_acara }}" readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Mulai">Tanggal Mulai</label>
                            <input type="text" class="form-control" name="tanggal_mulai"
                                value="{{ $acara->tanggal_mulai?->locale('id')->translatedFormat('d F Y') }}" readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Selesai">Tanggal Selesai</label>
                            <input type="text" class="form-control" name="tanggal_selesai"
                                value="{{ $acara->tanggal_selesai ? $acara->tanggal_selesai->locale('id')->translatedFormat('d F Y') : '-' }}"
                                readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Waktu">Waktu</label>
                            <input type="text" class="form-control" name="waktu" value="{{ $acara->waktu }}" readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi"
                                value="{{ $acara->lokasi }}" readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Deskripsi Acara">Deskripsi Acara</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Acara" rows="4" readonly>{{ $acara->deskripsi }}</textarea>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic text-center">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $acara->foto) }}" alt="img"
                                    class="imaged w-50 clickable-img">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')

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
