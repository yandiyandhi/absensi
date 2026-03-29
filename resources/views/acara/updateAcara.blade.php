@extends('layouts.app')
@section('title', 'Update Acara')
@section('header', 'Update Acara')
@section('content')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('acara.updateStatus', $acara->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="jenis">Status Acara</label>
                            <select name="status" id="statusEdit_id" class="form-control tomselect" required>
                                <option value="">-- Status --</option>
                                <option value="aktif" {{ $acara->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $acara->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif
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
