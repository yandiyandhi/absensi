@extends('layouts.app')
@section('title', 'Ubah User')
@section('header', 'Ubah User')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $users->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="name"
                                value="{{ $users->name }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ $users->username }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ $users->nik }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="kantor">Kantor</label>
                            <select name="kantor_id" id="kantor_id" class="form-control tomselect" required>
                                <option value="">-- Kantor --</option>
                                @foreach ($kantor as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $users->kantor_id === $item->id ? 'selected' : '' }}>{{ $item->nama_kantor }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="departemen">Departemen</label>
                            <input type="text" class="form-control" id="departemen_id" name="departemen_id"
                                value="{{ $users->jabatan->departemen->nama_departemen }}" required readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="jenis">Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control tomselect" required>
                                <option value="">-- Jabatan --</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $users->jabatan_id === $item->id ? 'selected' : '' }}>{{ $item->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="no_hp">No HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                                value="{{ $users->no_hp }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $users->alamat }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $users->email }}" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="active">Status Akun</label>
                            <select name="active" id="active" class="form-control tomselect" required>
                                <option value="">-- Status Akun --</option>
                                <option value="1" {{ $users->active == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $users->active == 0 ? 'selected' : '' }}>Non-Aktif
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Simpan</button>
                </form>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
@push('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tomselect').forEach(el => {
                new TomSelect(el, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    },
                });
            });
        });
    </script>
@endpush
