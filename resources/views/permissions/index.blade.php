@extends('layouts.app')
@section('title', 'Permission')
@section('header', 'Permission')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2">
        <div class="card">

            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Permission</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <div class="dropdown position-static">
                                        <a href="#" role="button" data-bs-toggle="dropdown">
                                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end z-1000">
                                            @can('permission.update')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('permission.edit', $item->id) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                            @else
                                                @include('partials.liEdit')
                                            @endcan
                                            @can('permission.delete')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#">
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
