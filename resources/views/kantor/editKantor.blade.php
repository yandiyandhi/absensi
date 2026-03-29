@extends('layouts.app')
@section('title', 'Ubah Kantor')
@section('header', 'Ubah Kantor')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kantor.update', $kantor->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nama_kantor">Nama Kantor</label>
                            <input type="text" class="form-control" id="nama_kantor" name="nama_kantor"
                                placeholder="Masukan Nama Kantor" value="{{ $kantor->nama_kantor }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="alamat_kantor">Alamat Kantor</label>
                            <input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor"
                                placeholder="Masukan Alamat Kantor" value="{{ $kantor->alamat_kantor }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Masukan Latitude" value="{{ $kantor->latitude }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" maxlength="15"
                                placeholder="Masukan Longitude" value="{{ $kantor->longitude }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="radius">Radius (Meter) - 2.5/3</label>
                            <input type="text" class="form-control" id="radius" name="radius"
                                placeholder="Masukan Radius" value="{{ $kantor->radius }}" required>
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
