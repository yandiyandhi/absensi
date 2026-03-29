@extends('layouts.app')
@section('title', 'Role Has Permission')
@section('header', 'Role Has Permission')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2">
        <div class="section-title">List Permission</div>
        <div class="card">
            <div class="card-body p-0">

                <div class="input-list">
                    @forelse ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input permission-checkbox"
                                id="customCheckd{{ $permission->id }}" data-permission="{{ $permission->name }}"
                                data-role="{{ $role->id }}"
                                {{ $role->permissions->pluck('name')->contains($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="customCheckd{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @empty
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheckd1">
                            <label class="form-check-label" for="customCheckd1">No Permissions Found</label>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
@push('myscript')
    <script>
        $(document).ready(function() {
            $('.permission-checkbox').change(function() {
                var permission = $(this).data('permission');
                var roleId = $(this).data('role');
                var checked = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/role/permission/' + roleId,
                    type: 'POST',
                    data: {
                        permission_name: permission,
                        checked: checked,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {

                    },
                    error: function(err) {

                    }
                });
            });
        });
    </script>
@endpush
