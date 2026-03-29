@extends('layouts.app')
@section('title', 'Departemen')
@section('header', 'Departemen')
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
                            <th scope="col">Nama Departemen</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departemen as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_departemen }}</td>
                                <td>{{ $item->nama_departemen }}</td>
                                <td class="text-end">
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('departemen.update')
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditDepartemen" data-id="{{ $item->uuid }}"
                                                        data-name="{{ $item->nama_departemen }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('departemen.delete')
                                                <li>
                                                    <a class="dropdown-item text-danger deleteDepartemen"
                                                        href="javascript:void(0)" data-id="{{ $item->uuid }}"
                                                        data-name="{{ $item->nama_departemen }}">
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

    @include('departemen.addDepartemen')
    @include('departemen.editDepartemen')

    <form id="formDeleteDepartemen" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @include('partials.alert')
@endsection
@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
@endpush
