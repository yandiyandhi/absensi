@extends('layouts.app')
@section('title', 'Daftar Approval Izin')
@section('header', 'Daftar Approval Izin')
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
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Ket</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">File</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->jenisIzin->nama_izin }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_mulai)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->alasan }}</td>
                                <td>{{ $item->jam_mulai }}</td>
                                <td>{{ $item->jam_selesai }}</td>
                                <td>
                                    @if (empty($item->file))
                                        <span>Tidak ada foto</span>
                                    @else
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                            Lihat Foto
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('approval.izin')
                                                <li>
                                                    <a class="dropdown-item text-success SetujuiIzin" href="javascript:void(0)"
                                                        data-id="{{ $item->id }}"
                                                        data-name="{{ $item->user->name }}">Setujui</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger TolakIzin" href="javascript:void(0)"
                                                        data-id="{{ $item->id }}"
                                                        data-name="{{ $item->user->name }}">Tolak</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="dropdown-item text-muted" href="javascript:void(0)">Tidak ada
                                                        aksi</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <form id="SetujuiIzin" method="POST">
        @csrf
        @method('PUT')
    </form>
    <form id="TolakIzin" method="POST">
        @csrf
        @method('PUT')
    </form>

    @include('partials.alert')
@endsection
@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
@endpush
