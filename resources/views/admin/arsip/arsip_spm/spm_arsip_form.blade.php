@extends('admin.layout.master')
@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Pembuatan Arsip SPM</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('arspm-store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body" style="height: 480px; overflow-y: auto;">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Nama Arsip</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-4 col-form-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="tanggal" class="form-control"
                                                    placeholder="Tanggal Pembuatan Arsip">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="jenisArsip" class="col-sm-4 col-form-label">Jenis Arsip SPM</label>
                                            <div class="col-sm-8">
                                                <select id="jenisArsip" name="jenis"
                                                    class="form-control filter-notifikasi select2" style="width: 100%;">
                                                    <option value="GU">SPM GU</option>
                                                    <option value="TU">SPM TU</option>
                                                    <option value="UP">SPM UP</option>
                                                    <option value="LS">SPM LS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-3">
                                            <label for="nomorArsip" class="col-sm-4 col-form-label">Nomor Arsip</label>
                                            <div class="col-sm-8">
                                                <form id="ArsipForm">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="nomorArsip"
                                                            name="nomor_arsip" enabled>
                                                    </div>
                                                    <button type="button" class="btn btn-primary"
                                                        id="ambilButton">Ambil</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="keterangan"
                                                    placeholder="Isi Keterangan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label
                                        class="col-sm-2 col-form-label text-center font font-italic font-weight-bold">Upload
                                        Berkas</label>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Pilih Berkas</label>
                                    <div class="col-sm-10">
                                        <input name="file" class="form-control" type="file" id="formFile">
                                    </div>
                                </div>
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
    <!-- <script>
        document.getElementById('ambilButton').addEventListener('click', function() {
            var nomorArsip = generateNomorArsip(); // Fungsi yang menghasilkan nomor Arsip

            document.getElementById('nomorArsip').value = nomorArsip;
        });

        function generateNomorArsip() {
            var date = new Date();
            var today = formatDate(date); // Format tanggal ke DD/MM/YYYY

            var lastDate = localStorage.getItem('lastDate');
            var lastNumberspmgu = localStorage.getItem('lastNumberspmgu');
            var lastNumberspmtu = localStorage.getItem('lastNumberspmtu');

            if (lastDate !== today) {
                lastDate = today;
                lastNumberspmgu = '0001'; // Mulai dari 000 setiap hari yang baru
            } else {
                lastNumberspmgu = ('0000' + (parseInt(lastNumberspmgu) + 1)).slice(-4);
            }

            localStorage.setItem('lastDate', lastDate);
            localStorage.setItem('lastNumberspmgu', lastNumberspmgu);

            var nomorArsip = lastNumberspmgu + '-' + 'ARSP' + '/' + 'SPM-gu' + '/' + lastDate.replace(/\//g, '/');

            return nomorArsip;
        }

        function formatDate(date) {
            var day = ('0' + date.getDate()).slice(-2);
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();

            return day + '/' + month + '/' + year;
        }
    </script> -->

    <script>
        document.getElementById('ambilButton').addEventListener('click', function() {
            var jenisArsip = document.getElementById('jenisArsip').value;
            var nomorArsip = generateNomorArsip(jenisArsip);

            document.getElementById('nomorArsip').value = nomorArsip;
        });

        function generateNomorArsip(jenisArsip) {
            var date = new Date();
            var today = formatDate(date); // Format tanggal ke DD/MM/YYYY

            var lastDate = localStorage.getItem('lastDate');
            var lastNumberKey = 'lastNumber' + jenisArsip;
            var lastNumber = localStorage.getItem(lastNumberKey);

            if (lastDate !== today) {
                lastDate = today;
                lastNumber = '0001'; // Mulai dari 0001 setiap hari yang baru
            } else {
                lastNumber = ('0000' + (parseInt(lastNumber) + 1)).slice(-4);
            }

            localStorage.setItem('lastDate', lastDate);
            localStorage.setItem(lastNumberKey, lastNumber);

            var nomorArsip = lastNumber + '-ARSPM/' + jenisArsip + '/' + lastDate.replace(/\//g, '/');

            return nomorArsip;
        }

        function formatDate(date) {
            var day = ('0' + date.getDate()).slice(-2);
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();

            return day + '/' + month + '/' + year;
        }
    </script>
@endsection
