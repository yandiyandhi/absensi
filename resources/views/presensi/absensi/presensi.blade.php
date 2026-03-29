@extends('layouts.app')
@section('title', 'Presensi')
@section('header', 'Presensi')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="formKamera" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Kamera -->
                    <video id="camera" width="100%" autoplay playsinline></video>

                    <!-- Canvas hidden -->
                    <canvas id="canvas" style="display:none;"></canvas>

                    <!-- Input hidden -->
                    <input type="text" name="foto" id="foto" hidden>
                    <input type="text" name="latitude" id="latitude" hidden>
                    <input type="text" name="longitude" id="longitude" hidden>
                    <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mb-2 mt-2">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <div class="section mt-2 mb-2" style="height: 80vh;">
        <div id="map" style="height: 70%;"></div>
        <p id="coords" style="margin-top:10px;"></p>
    </div>

    @include('partials.alert')
@endsection
@push('myscript')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('assets/js/script/kamera.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Pastikan input hidden ada
            let inputLat = document.getElementById('latitude');
            let inputLng = document.getElementById('longitude');
            if (!inputLat || !inputLng) {
                console.error("Input latitude & longitude tidak ditemukan!");
                return;
            }

            let map = L.map('map');

            // Tile Google Hybrid
            L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            let kantor = @json($data->kantor);
            let markerUser = null;
            let markerKantor = null;

            // ======== Marker & circle kantor ========
            if (kantor) {
                let lat_kantor = kantor.latitude ?? 0;
                let lng_kantor = kantor.longitude ?? 0;
                let radius_kantor = kantor.radius ?? 0;

                markerKantor = L.marker([lat_kantor, lng_kantor])
                    .addTo(map)
                    .bindPopup("Lokasi Kantor");

                L.circle([lat_kantor, lng_kantor], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.3,
                    radius: radius_kantor
                }).addTo(map);

                map.setView([lat_kantor, lng_kantor], 15);
            }

            // ======== Pengecekan izin lokasi ========
            if (!navigator.geolocation) {
                alert("Geolocation tidak didukung di browser ini.");
                if (markerKantor) map.setView(markerKantor.getLatLng(), 15);
                return;
            }

            navigator.permissions.query({
                name: 'geolocation'
            }).then(function(perm) {

                if (perm.state === 'denied') {
                    alert("Lokasi belum diizinkan. Silakan aktifkan izin lokasi pada browser/HP Anda.");
                    if (markerKantor) map.setView(markerKantor.getLatLng(), 15);
                    return;
                }

                startTracking();

                perm.onchange = function() {
                    if (this.state === 'granted') startTracking();
                };
            });

            // ======== Watch posisi user realtime ========
            function startTracking() {
                navigator.geolocation.watchPosition(
                    function(position) {
                        let lat_user = position.coords.latitude;
                        let lng_user = position.coords.longitude;
                        let akurasi = position.coords.accuracy;

                        // Update input hidden
                        inputLat.value = lat_user;
                        inputLng.value = lng_user;

                        // Hapus marker user lama
                        if (markerUser) map.removeLayer(markerUser);

                        // Marker user
                        markerUser = L.marker([lat_user, lng_user])
                            .addTo(map)
                            .bindPopup("Lokasi Anda (akurasi ±" + Math.round(akurasi) + " m)")
                            .openPopup();

                        // Fit bounds kantor + user
                        if (markerKantor) {
                            let group = L.featureGroup([markerUser, markerKantor]);
                            map.fitBounds(group.getBounds().pad(0.5));
                        } else {
                            map.setView([lat_user, lng_user], 17);
                        }

                        // Refresh map agar tampil penuh
                        setTimeout(() => map.invalidateSize(), 200);

                    },
                    function(error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Lokasi belum diizinkan. Silakan aktifkan izin lokasi pada browser/HP Anda.");
                        } else {
                            console.error("Gagal mendapatkan lokasi:", error.message);
                        }
                        if (markerKantor) map.setView(markerKantor.getLatLng(), 15);
                    }, {
                        enableHighAccuracy: true, // GPS akurat
                        timeout: 15000,
                        maximumAge: 0
                    }
                );
            }

        });
    </script>
@endpush
