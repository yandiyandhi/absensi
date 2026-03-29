@extends('layouts.app')
@section('title', 'Role')
@section('header', 'Role')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2">
        <div class="card">

            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('role.create')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('role.edit', $item->id) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('role.permission')
                                                <li>
                                                    <a href="{{ route('role.permissions', ['role' => $item->id]) }}"
                                                        class="dropdown-item ">
                                                        Permission
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <span class="dropdown-item text-muted">Tidak ada akses PERMISSION</span>
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
