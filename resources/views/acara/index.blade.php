@extends('layouts.app')
@section('title', 'Daftar Acara')
@section('header', 'Daftar Acara')
@section('content')
    @include('layouts.loader')
    <!-- Transactions -->
    <div class="section mt-2 mb-2">
        <div class="transactions">
            <!-- item -->
            <div class="dropdown position-static">
                @forelse ($acara as $item)
                    <a href="#" role="button" class="item" data-bs-toggle="dropdown">
                        <div class="detail">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="img" class="image-block imaged w48">
                            <div>
                                <strong>{{ $item->nama_acara }}</strong>
                                @if (empty($item->tanggal_mulai))
                                    <p>Tanggal mulai tidak tersedia</p>
                                @else
                                    <p>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="right">
                            <ion-icon name="ellipsis-vertical-outline" style="font-size:20px;"></ion-icon>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end z-1000">
                        @can('acara.detail')
                            <li>
                                <a class="dropdown-item" href="{{ route('acara.show', ['id' => $item->uuid]) }}">
                                    Detail
                                </a>
                            </li>
                        @endcan
                        @can('acara.edit')
                            <li>
                                <a class="dropdown-item" href="{{ route('acara.edit', ['id' => $item->uuid]) }}">
                                    Edit
                                </a>
                            </li>
                        @endcan
                        @can('acara.update')
                            <li>
                                <a class="dropdown-item" href="{{ route('acara.update', ['id' => $item->uuid]) }}">
                                    Update
                                </a>
                            </li>
                        @endcan
                    </ul>
                @empty
                    <a href="#" role="button" class="item" data-bs-toggle="dropdown">
                        <div class="detail">
                            <p>Tidak ada acara yang tersedia.</p>
                        </div>
                    </a>
                @endforelse
            </div>
            <!-- * item -->
        </div>
    </div>
    <!-- * Transactions -->
@endsection
