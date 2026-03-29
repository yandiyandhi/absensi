@extends('layouts.app')
@section('title', 'Jabatan')
@section('header', 'Jabatan')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2">
        <div class="card">

            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Jabatan</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jabatan as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_jabatan }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td class="text-end">
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('jabatan.update')
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditJabatan" data-id="{{ $item->uuid }}"
                                                        data-name="{{ $item->nama_jabatan }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('jabatan.delete')
                                                <li>
                                                    <a class="dropdown-item text-danger deleteJabatan" href="javascript:void(0)"
                                                        data-id="{{ $item->uuid }}" data-name="{{ $item->nama_jabatan }}">
                                                        Hapus
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liDelete')
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @include('jabatan.addJabatan')
    @include('jabatan.editJabatan')

    <form id="formDeleteJabatan" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @include('partials.alert')
@endsection

@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
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
