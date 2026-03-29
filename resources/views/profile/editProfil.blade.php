@extends('layouts.app')
@section('title', 'Profile Settings')
@section('header', 'Profile Settings')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.updateProfil', $user->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter your email" value="{{ old('email', $user->email) }}"
                                required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="no_hp">No Hp</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" placeholder="Enter your No Hp" value="{{ old('no_hp', $user->no_hp) }}"
                                required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" placeholder="Enter your Alamat" value="{{ old('alamat', $user->alamat) }}"
                                required>
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
