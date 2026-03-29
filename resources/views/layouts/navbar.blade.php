<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        @yield('header')
    </div>
    @if (request()->routeIs('profile.index'))
    @elseif (request()->routeIs('departemen.index'))
        @can('departemen.create')
            <div class="right">
                <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#modalTambahDepartemen">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('jabatan.index'))
        @can('jabatan.create')
            <div class="right">
                <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#modalTambahJabatan">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('kantor.index'))
        @can('kantor.create')
            <div class="right">
                <a href="{{ route('kantor.create') }}" class="headerButton">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('jenis-izin.index'))
        @can('jenisizin.create')
            <div class="right">
                <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#modalJenisIzin">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('users.index'))
        @can('users.create')
            <div class="right">
                <a href="{{ route('users.create') }}" class="headerButton">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('izin.index'))
        <div class="right">
            <a href="{{ route('izin.create') }}" class="headerButton">
                <ion-icon name="add-circle"></ion-icon>
            </a>
        </div>
    @elseif (request()->routeIs('role.index'))
        @can('role.create')
            <div class="right">
                <a href="{{ route('role.create') }}" class="headerButton">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('permission.index'))
        @can('permission.create')
            <div class="right">
                <a href="{{ route('permission.create') }}" class="headerButton">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @elseif (request()->routeIs('acara.index'))
        @can('acara.create')
            <div class="right">
                <a href="{{ route('acara.create') }}" class="headerButton">
                    <ion-icon name="add-circle"></ion-icon>
                </a>
            </div>
        @endcan
    @else
        <div class="right">
            @if (!empty(Auth::user()->foto))
                <a href="{{ route('profile.index') }}" class="headerButton">
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="image" class="foto-icon">
                </a>
            @else
                <a href="{{ route('profile.index') }}" class="headerButton">
                    <img src="{{ asset('assets/img/sample/logo.png') }}" alt="image" class="imaged w32">
                </a>
            @endif
        </div>
    @endif
</div>
