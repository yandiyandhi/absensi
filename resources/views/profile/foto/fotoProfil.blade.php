@extends('layouts.app')
@section('title', 'Profil')
@section('header', 'Profil')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.foto.update', ['id' => $user->uuid]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                    <p class="text-muted">
                        1. Supported formats : .png, .jpg, .jpeg<br>2. Skala foto 1:1 (Persegi)</p>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Simpan</button>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
