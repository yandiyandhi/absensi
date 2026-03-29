@extends('layouts.app')
@section('title', 'Jenis Izin')
@section('header', 'Jenis Izin')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 ">
        <div class="card mt-2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Izin</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jenis as $item)
                            <tr>
                                <th scope="col">{{ $loop->iteration }}</th>
                                <th scope="col">{{ $item->nama_izin }}</th>
                                <td>
                                    <div class="dropdown position-static">
                                        <a href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('jenisizin.update')
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditJenisIzin" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->nama_izin }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('jenisizin.delete')
                                                <li>
                                                    <a class="dropdown-item text-danger deleteJenisIzin"
                                                        href="javascript:void(0)" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->nama_izin }}">
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
                                <td colspan="3" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="formDeleteJenisIzin" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @include('izin.jenis.addJenisIzin')
    @include('izin.jenis.editJenisIzin')

    @include('partials.alert')

@endsection
@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
@endpush
