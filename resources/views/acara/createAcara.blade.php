@extends('layouts.app')
@section('title', 'Tambah Acara')
@section('header', 'Tambah Acara')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('acara.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Nama Acara">Nama Acara</label>
                            <input type="text" class="form-control" id="nama_acara" name="nama_acara"
                                placeholder="Nama Acara" value="{{ old('nama_acara') }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai') }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Waktu">Waktu</label>
                            <input type="time" class="form-control" name="waktu" value="{{ old('waktu') }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi"
                                value="{{ old('lokasi') }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Deskripsi Acara">Deskripsi Acara</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Acara" rows="4" required>{{ old('deskripsi') }}</textarea>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <div class="custom-file-upload" id="fotoProfil1">
                                <input type="file" id="fotoProfil" name="foto" accept=".png, .jpg, .jpeg">
                                <label for="fotoProfil">
                                    <span>
                                        <strong>
                                            <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                            <i>Upload a Photo</i>
                                        </strong>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mb-1">SIMPAN</button>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
