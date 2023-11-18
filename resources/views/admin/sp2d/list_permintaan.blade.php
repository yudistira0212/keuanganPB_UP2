@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Data Permintaan SP2D</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                @if (Auth::user()->role == 'keuangan')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nomor SPM</th>
                                            <th>SKPD</th>
                                            <th>Nama Peminta</th>
                                            <th>Tanggal</th>
                                            <th>Berkas SPM</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $dat)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $dat->sp2d->no_spm }}</td>
                                                <td>{{ $dat->sp2d->skpd->dinas }}</td>
                                                <td>{{ $dat->sp2d->user->name }}</td>
                                                <td>{{ $dat->tanggal }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('listPermintaanSP2D-download', $dat->sp2d->id) }}"
                                                        method="GET" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                            SPM
                                                        </button>
                                                    </form>

                                                </td>
                                                <td>
                                                    {{ $dat->status }}

                                                </td>
                                                <td>
                                                    @if ($dat->status == 'menunggu')
                                                        <form
                                                            action="{{ route('PermintaanSP2D-updateStatus', ['id' => $dat->id, 'status' => 'tolak']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#rejectModal{{ $dat->id }}">
                                                                Tolak
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('PermintaanSP2D-updateStatus', ['id' => $dat->id, 'status' => 'proses']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-info btn-sm">Terima</button>
                                                        </form>
                                                    @elseif ($dat->status == 'tolak')
                                                        <form
                                                            action="{{ route('PermintaanSP2D-updateStatus', ['id' => $dat->id, 'status' => 'menunggu']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-info btn-sm">Proses</button>
                                                        </form>
                                                    @elseif ($dat->status == 'proses')
                                                        <form
                                                            action="{{ route('PermintaanSP2D-updateStatus', ['id' => $dat->id, 'status' => 'menunggu']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Batal</button>
                                                        </form>

                                                        <form action="{{ route('edit-sp2d-view', $dat->sp2d->id) }}"
                                                            method="GET" {{-- target="_blank" --}} style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i> SP2D
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($dat->status == 'proses')
                                                    @endif
                                                    {{-- <a href="{{ route('create-sp2d') }}" id="actionButton" target="_blank"
                                                        class="btn btn-success btn-sm" style="display: none;"><i
                                                            class="fa fa-download"></i> Download</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif


                @if (Auth::user()->role == 'dinas')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('Form-Permintaan-SP2D') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i>
                                    Buat Permintaan SP2D</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nomor SPM</th>
                                            <th>SKPD</th>
                                            <th>Nama Peminta</th>
                                            <th>Tanggal</th>
                                            <th>Berkas SPM</th>
                                            <th>Status</th>
                                            <th>SP2D</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $index => $dat)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $dat->sp2d->no_spm }}</td>
                                                <td>{{ $dat->sp2d->skpd->dinas }}</td>
                                                <td>{{ $dat->sp2d->user->name }}</td>
                                                <td>{{ $dat->tanggal }}</td>
                                                <td>
                                                    <form action="{{ route('listPermintaanSP2D-download', $dat->id) }}"
                                                        method="GET" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                            SPM
                                                        </button>
                                                    </form>

                                                </td>
                                                <td>
                                                    {{ $dat->status }}
                                                </td>
                                                <td>
                                                    @if ($dat->status == 'selesai')
                                                        <form action="{{ route('SP2D-view', $dat->sp2d->id) }}"
                                                            method="GET" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-info btn-sm">
                                                                <i class="fa fa-eye"></i> View
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <script>
        // Ambil elemen select dan tombol action
        var statusSelect = document.getElementById('status');
        var actionButton = document.getElementById('actionButton');

        // Tambahkan event listener untuk perubahan nilai pada elemen select
        statusSelect.addEventListener('change', function() {
            // Periksa nilai yang dipilih
            if (statusSelect.value === 'Proses') {
                // Jika nilai adalah "Proses", tampilkan tombol action
                actionButton.style.display = 'block';
            } else {
                // Jika nilai bukan "Proses", sembunyikan tombol action
                actionButton.style.display = 'none';
            }
        });
    </script>
@endsection
