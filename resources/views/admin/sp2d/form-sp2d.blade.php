@extends('admin.layout.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Pembuatan Surat SP2D</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- General Form Elements -->
    <form action="{{ route('store-sp2d') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="height: 480px; overflow-y: auto;">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label text-center font font-italic font-weight-bold">Bagian
                                            Atas Kiri</label>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label">Nomor SPM</label>
                                            <div class="col-sm-8">
                                                <input name="no_spm" type="text"
                                                    class="form-control
                                                    @error('no_spm') is-invalid @enderror"
                                                    value="{{ old('no_spm') }}" required autocomplete="no_spm" autofocus>

                                                @error('no_spm')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-4 col-form-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input name="tanggal_sp2ds" type="date"
                                                    class="form-control
                                                @error('tanggal_sp2ds') is-invalid @enderror"
                                                    value="{{ old('tanggal_sp2ds') }}" required autocomplete="tanggal_sp2ds"
                                                    placeholder="Tanggal Pembuatan Surat">
                                                @error('tanggal_sp2ds')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDinas" class="col-sm-4 col-form-label">SKPD</label>
                                            <div class="col-sm-8">
                                                <select name="dinas_skpd"
                                                    class="form-control filter-notifikasi select2  @error('dinas_skpd') is-invalid @enderror"
                                                    style="width: 100%;" id="inputDinas" required>
                                                    <option value="">Pilih Dinas</option>
                                                    @foreach ($data as $dat)
                                                        <option name="dinas_skpd" value="{{ $dat->id }}">
                                                            {{ $dat->dinas }} - {{ $dat->alamat }} - {{ $dat->kode_pos }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('dinas_skpd')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label text-center font font-italic font-weight-bold">Bagian
                                            Atas Kanan</label>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat:</label>
                                            <div class="col-sm-8">
                                                <form id="suratForm">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control  @error('nomorSurat') is-invalid @enderror"
                                                            id="nomorSurat" name="nomorSurat" required
                                                            autocomplete="nomorSurat" enabled>
                                                        @error('nomorSurat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <button type="button" class="btn btn-primary"
                                                        id="ambilButton">Ambil</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-4 col-form-label ">Tahun Anggaran</label>
                                            <div class="col-sm-8">
                                                <input name="tanggaran" type="number" id="inputTahun" min="2000"
                                                    max="9999" step="1"
                                                    class="form-control  @error('tanggaran') is-invalid @enderror" required
                                                    placeholder="Masukkan Tahun Anggaran">

                                                @error('tanggaran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row-mb-3">
                                    <label class="col-form-label text-center font font-italic font-weight-bold">Bagian
                                        Keuangan</label>
                                    <hr>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Bank/Pos</label>
                                        <div class="col-sm-10">
                                            <input name="bank_pos_keuangan" type="text"
                                                class="form-control  @error('bank_pos_keuangan') is-invalid @enderror"
                                                placeholder="Masukan Bank/Pos Keuangan"
                                                value="{{ old('bank_pos_keuangan') }}" required>

                                            @error('bank_pos_keuangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nomor Rekening</label>
                                        <div class="col-sm-10">
                                            <input name="no_rek_keuangan" type="text"
                                                class="form-control  @error('no_rek_keuangan') is-invalid @enderror"
                                                placeholder="Masukan Nomor Rekening keuangan"
                                                value="{{ old('no_rek_keuangan') }}" required>

                                            @error('no_rek_keuangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label
                                        class="col-sm-2 col-form-label text-center font font-italic font-weight-bold">Bagian
                                        Isi</label>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kepada</label>
                                    <div class="col-sm-10">
                                        <input name="kepada" type="text"
                                            class="form-control  @error('kepada') is-invalid @enderror"
                                            placeholder="Masukan Nama Pihak ke Tiga" required>

                                        @error('kepada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Bank / Pos</label>
                                    <div class="col-sm-10">
                                        <input name="bank_pos" type="text"
                                            class="form-control  @error('bank_pos') is-invalid @enderror"
                                            placeholder="Masukkan Bank / Pos" required>

                                        @error('bank_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">NPWP</label>
                                    <div class="col-sm-10">
                                        <input name="npwp" type="text"
                                            class="form-control  @error('npwp') is-invalid @enderror" required
                                            placeholder="Masukkan NPWP">

                                        @error('npwp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">No. Rekening</label>
                                    <div class="col-sm-10">
                                        <input name="no_rek" type="text"
                                            class="form-control  @error('no_rek') is-invalid @enderror" required
                                            placeholder="Masukan No. Rekening">

                                        @error('no_rek')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jumlah Uang</label>
                                    <div class="col-sm-10">
                                        <input name="jumlah_uang" type="text"
                                            class="form-control  @error('jumlah_uang') is-invalid @enderror" required
                                            placeholder="Masukan Jumlah Uang">

                                        @error('jumlah_uang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Keperluan</label>
                                    <div class="col-sm-10">
                                        <input name="keperluann" type="text"
                                            class="form-control  @error('jumlah_uang') is-invalid @enderror" required
                                            placeholder="Keperluan Untuk">

                                        @error('keperluann')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Uraian Keperluan</label>
                                    <div class="col-sm-8">
                                        <table id="tabelData">
                                            <!-- Kolom Header -->
                                            <form id="dynamicForm" method="POST"
                                                action="{{ route('save-keperluan') }}">
                                                @csrf
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="dynamicFormContainer">
                                                                <!-- Area untuk menambahkan elemen formulir -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-primary mt-3"
                                                                id="addForm">Tambahkan Data</button>
                                                        </div>
                                                        {{-- <div class="col-md-12">
                                                        <button type="button" class="btn btn-primary mt-3"
                                                            id="saveData">save Data</button>
                                                    </div> --}}
                                                    </div>
                                                </div>
                                            </form>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Uraian Potongan</label>
                                    <div class="col-sm-8">
                                        <table id="tabelData">
                                            <!-- Kolom Header -->
                                            {{-- <form id="dynamicFormPotongan"> --}}
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="dynamicFormContainerPotongan">
                                                            <!-- Area untuk menambahkan elemen formulir -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-primary mt-3"
                                                            id="addFormPotongan">Tambahkan Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </form> --}}
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Informasi</label>
                                    <div class="col-sm-8">
                                        <table id="tabelData">
                                            <!-- Kolom Header -->
                                            {{-- <form id="dynamicFormInformasi"> --}}
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="dynamicFormContainerInformasi">
                                                            <!-- Area untuk menambahkan elemen formulir -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-primary mt-3"
                                                            id="addFormInformasi">Tambahkan Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </form> --}}
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label
                                        class="col-sm-3 col-form-label text-center font font-italic font-weight-bold">Bagian
                                        Bawah</label>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputDinas" class="col-sm-2 col-form-label">Penandatangan</label>
                                    <div class="col-sm-10">
                                        <select name="ttd" class="form-control filter-notifikasi select2"
                                            style="width: 100%;">
                                            <option value="">-Pilih-</option>
                                            @foreach ($TTD as $dttd)
                                                <option name='ttd' value="{{ $dttd->id }}">
                                                    {{ $dttd->id }} {{ $dttd->nama }} -
                                                    NIP.
                                                    {{ $dttd->nip }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" id="saveData" class="btn btn-success mt-3">Simpan &
                                            Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- End General Form Elements -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        /////////////////////////////////// detail keperluan //////////////////////////////////////
        $(document).ready(function() {
            var formData = [];

            $('#addForm').on('click', function() {
                var formIndex = formData.length;
                var newForm = `
            <div class="row mb-3" id="formRowkeperluan${formIndex}">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="data_uraian_keperluan[${formIndex}][kode_rekening]" placeholder="Kode Rekening">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="data_uraian_keperluan[${formIndex}][uraian]" placeholder="Uraian">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="data_uraian_keperluan[${formIndex}][jumlah]" placeholder="Rp Jumlah">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger removeForm" data-id="${formIndex}">Hapus</button>
                </div>
            </div>
        `;
                $('#dynamicFormContainer').append(newForm);
                formData.push({
                    kode_rekening: "",
                    uraian: "",
                    jumlah: ""
                });
                $('#saveData').show();
            });

            $(document).on('click', '.removeForm', function() {
                var removeFormId = $(this).data('id');
                $('#formRowkeperluan' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_uraian_keperluan"]', function() {
                var formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
                formData[formId] = {
                    kode_rekening: $('input[name="data_uraian_keperluan[' + formId +
                        '][kode_rekening]"]').val(),
                    uraian: $('input[name="data_uraian_keperluan[' + formId + '][uraian]"]').val(),
                    jumlah: $('input[name="data_uraian_keperluan[' + formId + '][jumlah]"]').val()
                };
            });
        });
    </script>


    <script>
        /////////////////////////////////// potongan //////////////////////////////////////
        $(document).ready(function() {
            var formData = [];

            $('#addFormPotongan').on('click', function() {
                var formIndex = formData.length;
                var newForm = `
            <div class="row mb-3" id="formRowpotongan${formIndex}">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="data_potongan[${formIndex}][no_rekening]"  placeholder="No Rekening/Uraian">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="data_potongan[${formIndex}][jumlah]"  placeholder="Rp Jumlah">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="data_potongan[${formIndex}][keterangan]" placeholder="Keterangan">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger removeFormPotongan" data-id="${formIndex}">Hapus</button>
                </div>
            </div>
        `;
                $('#dynamicFormContainerPotongan').append(newForm);
                formData.push({
                    no_rekening: "",
                    jumlah: "",
                    keterangan: ""
                });
                $('#saveData').show();
            });

            $(document).on('click', '.removeFormPotongan', function() {
                var removeFormId = $(this).data('id');
                $('#formRowpotongan' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_potongan"]', function() {
                var formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
                formData[formId] = {
                    no_rekening: $('input[name="data_potongan[' + formId +
                        '][no_rekening]"]').val(),
                    jumlah: $('input[name="data_potongan[' + formId + '][jumlah]"]').val(),
                    keterangan: $('input[name="data_potongan[' + formId + '][keterangan]"]').val()
                };
            });
        });
    </script>

    <script>
        /////////////////////////////////// informasi //////////////////////////////////////
        $(document).ready(function() {
            var formData = [];

            $('#addFormInformasi').on('click', function() {
                var formIndex = formData.length;
                var newForm = `
        <div class="row mb-3" id="formRowinformasi${formIndex}">
            <div class="col-md-4">
                <input type="text" class="form-control" name="data_informasi[${formIndex}][no_rekening]"  placeholder="No Rekening/Uraian">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="data_informasi[${formIndex}][jumlah]"  placeholder="Rp Jumlah">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="data_informasi[${formIndex}][keterangan]" placeholder="Keterangan">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger removeFormInformasi" data-id="${formIndex}">Hapus</button>
            </div>
        </div>
    `;
                $('#dynamicFormContainerInformasi').append(newForm);
                formData.push({
                    no_rekening: "",
                    jumlah: "",
                    keterangan: ""
                });
                $('#saveData').show();
            });

            $(document).on('click', '.removeFormInformasi', function() {
                var removeFormId = $(this).data('id');
                $('#formRowinformasi' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_informasi"]', function() {
                var formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
                formData[formId] = {
                    no_rekening: $('input[name="data_informasi[' + formId +
                        '][no_rekening]"]').val(),
                    jumlah: $('input[name="data_informasi[' + formId + '][jumlah]"]').val(),
                    keterangan: $('input[name="data_informasi[' + formId + '][keterangan]"]').val()
                };
            });
        });
    </script>

    <script>
        document.getElementById('ambilButton').addEventListener('click', function() {
            var nomorSurat = generateNomorSurat(); // Fungsi yang menghasilkan nomor surat

            document.getElementById('nomorSurat').value = nomorSurat;
        });

        function generateNomorSurat() {
            var date = new Date();
            var today = formatDate(date); // Format tanggal ke DD/MM/YYYY

            var lastDate = localStorage.getItem('lastDate');
            var lastNumberSP2D = localStorage.getItem('lastNumberSP2D');

            if (lastDate !== today) {
                lastDate = today;
                lastNumberSP2D = '0000'; // Mulai dari 000 setiap hari yang baru
            } else {
                lastNumberSP2D = ('0000' + (parseInt(lastNumberSP2D) + 1)).slice(-4);
            }

            localStorage.setItem('lastDate', lastDate);
            localStorage.setItem('lastNumberSP2D', lastNumberSP2D);

            var nomorSurat = lastNumberSP2D + '-' + 'SP2D' + '/' + lastDate.replace(/\//g, '/');

            return nomorSurat;
        }

        function formatDate(date) {
            var day = ('0' + date.getDate()).slice(-2);
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();

            return day + '/' + month + '/' + year;
        }
    </script>
@endsection
