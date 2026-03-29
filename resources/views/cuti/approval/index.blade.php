@extends('layouts.app')
@section('title', 'Daftar Approval Cuti')
@section('header', 'Daftar Approval Cuti')
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
                            <th scope="col">Tgl Mulai</th>
                            <th scope="col">Tgl Selesai</th>
                            <th scope="col">Ketarangan</th>
                            <th scope="col">Pendukung</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Andi Saputra</td>
                            <td>Menikah</td>
                            <td>2026-04-01</td>
                            <td>2026-04-03</td>
                            <td>Acara pernikahan</td>
                            <td>surat_pengantar.pdf</td>
                            <td>
                                <div class="dropdown position-static">
                                    <a href="#" role="button" data-bs-toggle="dropdown">
                                        <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end z-1000">
                                        <li><a class="dropdown-item" href="#">Lihat</a></li>
                                        <li><a class="dropdown-item text-success" href="#">Setujui</a></li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)">Tolak</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Siti Marlina</td>
                            <td>Melahirkan</td>
                            <td>2026-05-10</td>
                            <td>2026-08-10</td>
                            <td>Melahirkan anak pertama</td>
                            <td>surat_dokter.pdf</td>
                            <td>
                                <div class="dropdown position-static">
                                    <a href="#" role="button" data-bs-toggle="dropdown">
                                        <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end z-1000">
                                        <li><a class="dropdown-item" href="#">Lihat</a></li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)">Batalkan</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Budi Hartono</td>
                            <td>Cuti tahunan</td>
                            <td>2026-06-20</td>
                            <td>2026-06-25</td>
                            <td>Liburan</td>
                            <td>-</td>
                            <td>
                                <div class="dropdown position-static">
                                    <a href="#" role="button" data-bs-toggle="dropdown">
                                        <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end z-1000">
                                        <li><a class="dropdown-item" href="#">Lihat</a></li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- @forelse ($kantor as $item)
                            
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse --}}
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
