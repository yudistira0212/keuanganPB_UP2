@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Data Users nih</h1>
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
                            <a href="{{ route('create-user') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Create</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data as $dat)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dat->name }}</td>
                                            <td>{{ $dat->email }}</td>
                                            <td>{{ $dat->role }}</td>
                                            <td>
                                                <a href="" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    Delete</a>
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
