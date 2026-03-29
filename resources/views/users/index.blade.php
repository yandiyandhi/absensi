@extends('layouts.app')
@section('title', 'List User')
@section('header', 'List User')
@section('content')
    @include('layouts.loader')

    <div class="section mt-2">
        <form action="{{ route('users.index') }}" method="GET" class="mt-2 mb-2">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari..."
                    style="outline: none; box-shadow: none; font-size: 12px;">

                <button type="submit" class="btn btn-primary">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
        </form>
        <div class="card">

            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Kantor</th>
                            <th scope="col">Dept</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->kantor->nama_kantor }}</td>
                                <td>{{ $item->jabatan->departemen->nama_departemen }}</td>
                                <td>{{ $item->jabatan->nama_jabatan }}</td>
                                <td>{{ $item->getRoleNames()->first() }}</td>
                                <td>
                                    @if ($item->active == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('user.update')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('users.edit', ['user' => $item->uuid]) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('user.role')
                                                <li>
                                                    <a href="{{ route('role.roleUser', ['user' => $item->uuid]) }}"
                                                        class="dropdown-item text-danger deleteUser" href="javascript:void(0)">
                                                        Role
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <span class="dropdown-item text-muted">Tidak ada akses ROLE</span>
                                                </li>
                                            @endcan
                                            <div class="dropdown-divider"></div>
                                            @can('user.password')
                                                <a class="dropdown-item"
                                                    href="{{ route('users.password', ['user' => $item->uuid]) }}">
                                                    Password
                                                </a>
                                            @else
                                                <li>
                                                    <span class="dropdown-item text-muted">Tidak ada akses PASSWORD</span>
                                                </li>
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

    @include('partials.alert')
@endsection
