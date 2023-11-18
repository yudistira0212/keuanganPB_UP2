@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Data Arsip SPM tu</h1>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li class="active">Data Users</li>
                                    </ol>
                                </div>
                            </div>
                        </div> -->
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('arspm-gu-create') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Upload Berkas</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nomor Arsip</th>
                                        <th>Nama Arsip</th>
                                        <th>Jumlah Berkas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ArsipSpm as $index => $data)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->nomor_arsip }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>


                                                <!-- View -->
                                                <form action="{{ route('download-file-tu', $data->id) }}" method="GET"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('delete-file-tu', $data->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
