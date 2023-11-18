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
        <!-- <div class="col-sm-8">
                                <div class="page-header float-right">
                                    <div class="page-title">
                                         <ol class="breadcrumb text-right">
                                             <li class="active">Data Users</li>
                                      </ol>
                                  </div>
                              </div>  </div> -->
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('create-sp2d') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Create</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>SKPD</th>
                                        <th>Tanggal</th>
                                        <th>Ation/th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data as $dat)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dat->no_surat }}</td>
                                            <td>{{ $dat->skpd->dinas }}</td>
                                            <td>{{ $dat->tgl_sp2d ? date('d F Y', strtotime($dat->tgl_sp2d)) : '' }}</td>
                                            <td>
                                                <form action="{{ route('edit-sp2d-view', $dat->id) }}" method="GET"
                                                    {{-- target="_blank" --}} style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </form>

                                                <!-- View -->
                                                <form action="{{ route('SP2D-view', $dat->id) }}" method="GET"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i> View
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('delete-sp2d', $dat->id) }}" method="POST"
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


                <table>
                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->data }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
