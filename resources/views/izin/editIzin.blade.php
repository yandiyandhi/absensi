@extends('layouts.app')
@section('title', 'Form Izin')
@section('header', 'Form Izin')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('izin.update', ['id' => $data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="nama">Nama</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->id }}" name="user_id"
                                hidden>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="kantor">Kantor</label>
                            <input type="text" class="form-control" value="{{ $data->kantor->id ?? '' }}"
                                name="kantor_id" hidden>
                            <input type="text" class="form-control" value="{{ $data->kantor->nama_kantor ?? '' }}"
                                readonly required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="departemen">Kategori Izin</label>
                            <select name="jenis_izin_id" id="jenis_izin_id" class="form-control tomselect" required>
                                <option value="">-- Kategori Izin --</option>
                                @foreach ($jenis_izin as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $data->jenis_izin_id ? 'selected' : '' }}>
                                        {{ $item->nama_izin }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal"
                                value="{{ $data->tanggal ? $data->tanggal : '' }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Jam Mulai">Jam Mulai</label>
                            <input type="text" id="jam_mulai" class="form-control" name="jam_mulai"
                                value="{{ $data->jam_mulai ? \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') : '' }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Jam Selesai">Jam Selesai</label>
                            <input type="text" id="jam_selesai" class="form-control" name="jam_selesai"
                                value="{{ $data->jam_selesai ? \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') : '' }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Keterangan">Keterangan</label>
                            <textarea id="keterangan" name="alasan" class="form-control" rows="3" style="resize: none">{{ $data->alasan }}</textarea>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <div class="custom-file-upload" id="fileUpload1">
                                <input type="file" id="fileuploadInput" name="file" accept=".png, .jpg, .jpeg">
                                <label for="fileuploadInput">
                                    <span>
                                        <strong>
                                            <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                            <i>Upload .png, .jpg, .jpeg</i>
                                        </strong>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body text-center">
                                @if (!empty($data->file))
                                    <img src="{{ asset('storage/' . $data->file) }}" alt="img" class="imaged w-50">
                                @else
                                    <span>Tidak ada file</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mt-2 mb-1">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    @include('partials.alert')
@endsection
@push('myscript')
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#jam_selesai, #jam_mulai", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            // disableMobile: true,
            minuteIncrement: 1,
            allowInput: true
        });
    </script>
@endpush
