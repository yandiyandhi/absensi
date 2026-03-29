@extends('layouts.app')
@section('title', 'Tambah Kantor')
@section('header', 'Tambah Kantor')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kantor.store') }}" method="POST">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nama_kantor">Nama Kantor</label>
                            <input type="text" class="form-control" id="nama_kantor" name="nama_kantor"
                                placeholder="Masukan Nama Kantor" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="alamat_kantor">Alamat Kantor</label>
                            <input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor"
                                placeholder="Masukan Alamat Kantor" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Masukan Latitude" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" step="any"
                                placeholder="Masukan Longitude" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="radius">Radius (Meter) - 2.5/3</label>
                            <input type="text" class="form-control" id="radius" name="radius"
                                placeholder="Masukan Radius" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Simpan</button>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
