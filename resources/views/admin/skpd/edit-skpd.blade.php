@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Tambah Data SKPD</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('skpd-update', $skpd->id) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-body" style="height: 480px; overflow-y: auto;">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Dinas </label>
                                            <div class="col-sm-8">

                                                <input type="text" name="dinas" placeholder="Masukkan Dinas"
                                                    class="form-control @error('dinas') is-invalid @enderror"
                                                    value="{{ $skpd->dinas }}" required autocomplete="dinas" autofocus>
                                                @error('dinas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Alamat </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ $skpd->alamat }}" required autocomplete="alamat"
                                                    placeholder="Masukkan Alamat">
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputText" class="col-sm-4 col-form-label">Kode Pos</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                class="form-control @error('kode_pos') is-invalid @enderror"
                                                value="{{ $skpd->kode_pos }}" required autocomplete="kode_pos"
                                                name="kode_pos" placeholder="Masukkan NIP">
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan Berkas</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
