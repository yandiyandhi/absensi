@extends('layouts.app')
@section('title', 'Tambah User')
@section('header', 'Tambah User')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="name"
                                placeholder="Enter a Name" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter a Username" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Enter a NIK" required>
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
                                    <option value="{{ $item->id }}">{{ $item->nama_kantor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="departemen">Departemen</label>
                            <select name="departemen_id" id="departemen_id" class="form-control tomselect" required>
                                <option value="">-- Departemen --</option>
                                @foreach ($departemen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="jenis">Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control tomselect" required>
                                <option value="">-- Jabatan --</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="no_hp">No HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                                placeholder="Enter a No HP" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Enter a Alamat" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter a Email" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter a Password" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Enter a Confirm Password" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        <small id="error" style="color:red;"></small>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="status_akun">Status Akun</label>
                            <select name="status_akun" id="status_akun" class="form-control tomselect" required>
                                <option value="">-- Status Akun --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
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

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const error = document.getElementById('error');

        function validatePassword() {
            if (confirmPassword.value.length === 0) {
                error.textContent = "";
                return;
            }

            if (password.value !== confirmPassword.value) {
                error.textContent = "Password tidak sama";
                error.style.color = "red";
            } else {
                error.textContent = "Password cocok";
                error.style.color = "green";
            }
        }

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);
    </script>
@endpush
