@extends('layouts.app')
@section('title', 'Ubah Permission')
@section('header', 'Ubah Permission')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="permission_name">Permission Name</label>
                            <input type="text" class="form-control @error('permission_name') is-invalid @enderror"
                                id="permission_name" name="permission_name" value="{{ $permission->name }}"
                                placeholder="Enter Permission Name" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        @error('permission_name')
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
