@extends('layouts.appLogin')
@section('title', 'Login')
@section('content')

    <div class="appHeader">
        <div class="left">

        </div>
        <div class="pageTitle">PRESENSI</div>
        <div class="right">
        </div>
    </div>

    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Log in</h1>
            <h4>E-Presensi</h4>
            <h4>CV Sinar Terang Fastener</h4>
        </div>
        <div class="section mb-5 p-2">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Your username">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password"
                                    autocomplete="off" placeholder="Your password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-button-group  transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>

            </form>
        </div>

    </div>

    @include('partials.alert')
@endsection
