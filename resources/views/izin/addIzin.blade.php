@extends('layouts.app')
@section('title', 'Form Izin')
@section('header', 'Form Izin')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('izin.store') }}" enctype="multipart/form-data">
                    @csrf
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
                            <input type="text" class="form-control" value="{{ $user->kantor->id ?? '' }}"
                                name="kantor_id" hidden>
                            <input type="text" class="form-control" value="{{ $user->kantor->nama_kantor ?? '' }}"
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
                                    <option value="{{ $item->id }}">{{ $item->nama_izin }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Jam Mulai">Jam Mulai</label>
                            <input type="time" id="jam_mulai" class="form-control" name="jam_mulai">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Jam Selesai">Jam Selesai</label>
                            <input type="time" id="jam_selesai" class="form-control" name="jam_selesai">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Keterangan">Keterangan</label>
                            <textarea id="keterangan" name="alasan" class="form-control" rows="3" style="resize: none"></textarea>
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

    <script>
        let now = new Date();

        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');

        let jam = `${hours}:${minutes}`; // format HH:mm

        document.getElementById('jam_mulai').value = jam;
        document.getElementById('jam_selesai').value = jam;
    </script>
@endpush
