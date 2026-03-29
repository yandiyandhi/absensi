<div class="appBottomMenu">
    <a href="{{ route('dashboard') }}" class="item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('acara.index') }}"
        class="item {{ request()->routeIs('acara.index', 'acara.create', 'acara.show', 'acara.edit', 'acara.status') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline"></ion-icon>
            <strong>Acara</strong>
        </div>
    </a>
    <a href="{{ route('presensi.presensi') }}"
        class="item {{ request()->routeIs('presensi.presensi') ? 'active' : '' }}">
        <div class="col">
            <div class="action-button">
                <ion-icon name="finger-print-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('lokasi.index') }}" class="item {{ request()->routeIs('lokasi.index') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="map-outline"></ion-icon>
            <strong>Lokasi</strong>
        </div>
    </a>
    <a href="{{ route('profile.index') }}" class="item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="settings-outline"></ion-icon>
            <strong>Setting</strong>
        </div>
    </a>
</div>
