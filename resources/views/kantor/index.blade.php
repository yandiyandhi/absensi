@extends('layouts.app')
@section('title', 'Kantor')
@section('header', 'Kantor')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2">
        <div class="card">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longtitude</th>
                            <th scope="col">Radius</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kantor as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_kantor }}</td>
                                <td>{{ $item->alamat_kantor }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>{{ $item->radius }}</td>
                                <td>
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('kantor.update')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('kantor.edit', $item->uuid) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('kantor.delete')
                                                <li>
                                                    <a class="dropdown-item text-danger deleteKantor" href="javascript:void(0)"
                                                        data-id="{{ $item->uuid }}" data-name="{{ $item->nama_kantor }}">
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

    <form id="formDeleteKantor" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @include('partials.alert')
@endsection
@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
@endpush
