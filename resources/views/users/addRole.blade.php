@extends('layouts.app')
@section('title', 'Tambah Role')
@section('header', 'Tambah Role')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('role.assignRole', $data->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="departemen">Role Name</label>
                            <select name="role_name" id="role_name" class="form-control tomselect" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->name }}"
                                        {{ $data->roles->contains('name', $item->name) ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
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
