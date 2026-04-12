@extends('layouts.app')
@section('title', 'Histori Izin')
@section('header', 'Histori Izin')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('izin.index') }}" method="GET">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tangga_awal"
                                value="{{ request('tanggal_awal') }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir"
                                value="{{ request('tanggal_akhir') }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mb-1">SUBMIT</button>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tanggal ? $item->tanggal : '' }}</td>
                                <td>{{ $item->jam_mulai ? $item->jam_mulai->format('H:i') : '-' }}</td>
                                <td>{{ $item->jam_selesai ? $item->jam_selesai->format('H:i') : '-' }}</td>
                                <td>{{ $item->alasan ? $item->alasan : '' }}</td>
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
                                    {{ $item->status }}
                                </td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <div class="dropdown position-static">
                                            <a href="#" role="button" data-bs-toggle="dropdown">
                                                <ion-icon name="ellipsis-vertical-outline"
                                                    style="font-size:20px;"></ion-icon>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-end z-1000">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('izin.edit', ['id' => $item->uuid]) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger cancelIzin"
                                                        href="javascript:void(0)" data-id="{{ $item->id }}">
                                                        Batal
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="dropdown position-static">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data izin</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="formCancelIzin" method="POST">
        @csrf
        @method('PUT')
    </form>

    @include('partials.alert')
@endsection
@push('myscript')
    <script src="{{ asset('assets/js/script/tools.js') }}"></script>
@endpush
