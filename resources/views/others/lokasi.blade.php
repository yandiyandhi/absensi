@extends('layouts.app')
@section('title', 'Lokasi')
@section('header', 'Lokasi')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2" style="height: 80vh;">
        <div id="map" style="height: 90%;"></div>
        <p id="coords" style="margin-top:10px;"></p>
    </div>
@endsection

@push('myscript')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let map = L.map('map').setView([0, 0], 13);

            // Tile Google Hybrid
            L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            // 📍 DATA KANTOR
            let kantor = @json($data->kantor);
            let markerKantor = null;

            if (kantor) {
                let lat_kantor = kantor.latitude ?? 0;
                let lng_kantor = kantor.longitude ?? 0;
                let radius_kantor = kantor.radius ?? 0;

                // Marker kantor
                markerKantor = L.marker([lat_kantor, lng_kantor])
                    .addTo(map)
                    .bindPopup("Lokasi Kantor");

                // Circle kantor
                L.circle([lat_kantor, lng_kantor], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.3,
                    radius: radius_kantor
                }).addTo(map);

                // Set initial view
                map.setView([lat_kantor, lng_kantor], 15);
            }

            // ========================
            // CEK IZIN GEOLOCATION
            // ========================
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

                // Start tracking lokasi
                startTracking();

                // Listen perubahan izin
                perm.onchange = function() {
                    if (this.state === 'granted') startTracking();
                };
            });

            function startTracking() {
                navigator.geolocation.watchPosition(
                    function(position) {
                        let lat_user = position.coords.latitude;
                        let lng_user = position.coords.longitude;
                        let akurasi = position.coords.accuracy;

                        // Hapus marker user lama
                        if (window.markerUser) map.removeLayer(window.markerUser);

                        // Marker user
                        window.markerUser = L.marker([lat_user, lng_user])
                            .addTo(map)
                            .bindPopup("Lokasi Anda (akurasi ±" + Math.round(akurasi) + " m)")
                            .openPopup();

                        // Fit bounds kantor + user
                        if (markerKantor) {
                            let group = L.featureGroup([window.markerUser, markerKantor]);
                            map.fitBounds(group.getBounds().pad(0.5));
                        } else {
                            map.setView([lat_user, lng_user], 17);
                        }

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
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 0
                    }
                );
            }

        });
    </script>

    {{-- Untuk proses absen --}}
    {{-- <script>
        let map = L.map('map').setView([0, 0], 13);

        // Tile
        L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        // 📍 DATA KANTOR (ambil dari database nanti)
        let lat_kantor = -6.200000;
        let lng_kantor = 106.816666;
        let radius_kantor = 50; // meter

        let kantor = L.latLng(lat_kantor, lng_kantor);

        // 🔴 Circle kantor
        let circle = L.circle(kantor, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.3,
            radius: radius_kantor
        }).addTo(map);

        // Marker kantor
        L.marker(kantor).addTo(map)
            .bindPopup("Lokasi Kantor");

        // Ambil lokasi user
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                let user = L.latLng(lat, lng);

                // Marker user
                L.marker(user).addTo(map)
                    .bindPopup("Lokasi Anda")
                    .openPopup();

                // Zoom ke tengah antara user & kantor
                map.fitBounds([user, kantor]);

                // 🎯 HITUNG JARAK
                let jarak = user.distanceTo(kantor);

                // Tampilkan info
                document.getElementById("coords").innerHTML =
                    "Jarak ke kantor: " + Math.round(jarak) + " meter";

                // 🔥 VALIDASI
                if (jarak <= radius_kantor) {
                    document.getElementById("coords").innerHTML +=
                        "<br><span style='color:green'>✅ Dalam radius - bisa absen</span>";

                    // contoh aktifkan tombol
                    // document.getElementById("btnAbsen").disabled = false;

                    circle.setStyle({
                        color: 'green',
                        fillColor: 'green'
                    });

                } else {
                    document.getElementById("coords").innerHTML +=
                        "<br><span style='color:red'>❌ Di luar radius</span>";

                    // document.getElementById("btnAbsen").disabled = true;
                }

            }, function(error) {
                alert("Gagal ambil lokasi: " + error.message);
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        }
    </script> --}}
@endpush
