@extends('layouts.app')
@section('title', 'Profil')
@section('header', 'Profil')
@section('content')
    @include('layouts.loader')
    <div class="section mt-3 text-center">
        <div class="avatar-section">
            <a href="{{ route('profile.foto') }}">
                <div class="avatar-circle">
                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/img/sample/logo.png') }}"
                        alt="avatar">
                    <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span>
                </div>
            </a>
        </div>
    </div>

    <div class="listview-title mt-1">Theme</div>
    <ul class="listview image-listview text inset">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        Dark Mode
                    </div>
                    <div class="form-check form-switch  ms-2">
                        <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                        <label class="form-check-label" for="darkmodeSwitch"></label>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="listview-title mt-1">Profil Detail</div>
    <ul class="listview image-listview text inset mb-2">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        Username
                        <div class="text-muted">
                            {{ $user->username }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        Email
                        <div class="text-muted">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        Alamat
                        <div class="text-muted">
                            {{ $user->alamat }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        No Hp
                        <div class="text-muted">
                            {{ $user->no_hp }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="listview-title mt-1">Profile Settings</div>
    <ul class="listview image-listview text inset mb-2">
        <li>
            <a href="{{ route('profile.editProfil') }}" class="item">
                <div class="in">
                    <div>Profile Settings</div>
                    <span class="text-primary">Edit</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.password') }}" class="item">
                <div class="in">
                    <div>Password</div>
                    <span class="text-primary">Edit</span>
                </div>
            </a>
        </li>
    </ul>
@endsection
