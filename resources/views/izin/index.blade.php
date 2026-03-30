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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam_mulai->format('H:i') }}</td>
                                <td>{{ $item->jam_selesai->format('H:i') }}</td>
                                <td>{{ $item->alasan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data izin</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
