@extends('layouts.app')
@section('title', 'Histori Presensi')
@section('header', 'Histori Presensi')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 ">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('presensi.histori') }}">
                    @csrf
                    @method('GET')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggal_awal" value="{{ old('tanggal_awal') }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir"
                                value="{{ old('tanggal_akhir') }}">
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
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presensis as $presensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presensi->tanggal }}</td>
                                <td>
                                    @if ($presensi->jam_masuk <= '08:01:00')
                                        <span class="text-success">{{ $presensi->jam_masuk?->format('H:i') ?? '-' }}</span>
                                    @else
                                        <span class="text-danger">{{ $presensi->jam_masuk?->format('H:i') ?? '-' }}</span>
                                    @endif

                                </td>
                                <td>
                                    @if ($presensi->jam_keluar <= '17:01:00')
                                        <span class="text-danger">{{ $presensi->jam_keluar?->format('H:i') ?? '-' }}</span>
                                    @else
                                        <span class="text-success">{{ $presensi->jam_keluar?->format('H:i') ?? '-' }}</span>
                                    @endif
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
@endsection
