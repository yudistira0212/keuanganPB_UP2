@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Data Users</h1>
                </div>
            </div>
        </div>

    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('skpd-crete') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah SKPD</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Dinas</th>
                                        <th>Alamat</th>
                                        <th>KOde Pos</th>
                                        <th>Ation/th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($skpd as $dat)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dat->dinas }}</td>
                                            <td>{{ $dat->alamat }}</td>
                                            <td>{{ $dat->kode_pos }}</td>
                                            <td>
                                                <form action="{{ route('skpd-edit', $dat->id) }}" method="GET"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </form>

                                                <form action="#" method="POST" style="display:inline;"
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


                <table>
                    @foreach ($skpd as $skpd)
                        <tr>
                            <td>{{ $skpd->data }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
