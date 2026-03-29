<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="theme-color" content="#000000">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="description" content="Presensi Template">
<meta name="keywords" content="presensi,absensi, mobile, html, responsive" />
<link rel="icon" type="image/png" href="{{ asset('assets/img/logo-icon1.png') }}" sizes="128x128">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

<style>
    .floating-alert {
        position: fixed;
        bottom: 80px;
        /* lebih tinggi dari bottom menu */
        right: 20px;
        z-index: 9999;
        min-width: 280px;
        max-width: 350px;

        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .floating-alert.show-custom {
        opacity: 1;
        transform: translateY(0);
    }

    .ts-control {
        border: none !important;
        box-shadow: none !important;
    }

    /* Foto Profil */
    .avatar-circle {
        width: 120px;
        /* ukuran tetap */
        height: 120px;
        border-radius: 50%;
        /* bikin lingkaran */
        overflow: hidden;
        /* potong gambar */
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: fill;
        /* 🔥 kunci utama */
    }

    /* Foto Profil */

    /* Foto Navbar */
    .foto-icon {
        width: 40px;
        /* ukuran tetap */
        height: 40px;
        border-radius: 50%;
        /* bikin lingkaran */
        overflow: hidden;
        /* potong gambar */
    }

    .foto-icon img {
        width: 100%;
        height: 100%;
        object-fit: fill;
        /* 🔥 kunci utama */
    }

    /* Foto Navbar */

    /* Tampil foto pada adashboard */

    /* overlay fullscreen */
    #imgOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #imgOverlay img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 5px;
    }

    #imgOverlay:after {
        content: '✖';
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 30px;
        color: white;
        cursor: pointer;
    }

    /* Tampil foto pada adashboard */
</style>
