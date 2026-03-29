@extends('layouts.app')
@section('title', 'Histori Izin')
@section('header', 'Histori Izin')
@section('content')
    @include('layouts.loader')
    <div class="section mt-2 ">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tangga_awal">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="Tanggal Akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mb-1">SUBMIT</button>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">1</th>
                            <th scope="col">15-03-20026</th>
                            <th scope="col"><span class="text-success">08:00</span></th>
                            <th scope="col"><span class="text-success">17:05</span></th>
                        </tr>
                        <tr>
                            <th scope="col">2</th>
                            <th scope="col">16-03-20026</th>
                            <th scope="col"><span class="text-danger">08:05</span></th>
                            <th scope="col"><span class="text-warning">-</span></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
