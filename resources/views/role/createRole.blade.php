@extends('layouts.app')
@section('title', 'Tambah Role')
@section('header', 'Tambah Role')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="role_name">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                id="role_name" name="role_name" placeholder="Enter Role Name" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        @error('role_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Simpan</button>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
