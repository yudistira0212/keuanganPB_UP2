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
    <form action="{{ route('update-sp2d', $sp2d->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
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
                                                    value="{{ $sp2d->no_spm }}" required autocomplete="no_spm" autofocus>

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
                                                <input name="tanggal_sp2ds" value="{{ $sp2d->tgl_sp2d }}" type="date"
                                                    class="form-control @error('tanggal_sp2ds') is-invalid @enderror"
                                                    placeholder="Tanggal Pembuatan Surat" required>
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
                                                <select name="dinas_skpd" class="form-control filter-notifikasi select2"
                                                    style="width: 100%;" id="inputDinas" required>
                                                    <option value="">Pilih Dinas</option>
                                                    @foreach ($skpd as $data)
                                                        <option name="dinas_skpd" value="{{ $data->id }}"
                                                            {{ $data->id == $sp2d->skpd_id ? 'selected' : '' }}>
                                                            {{ $data->dinas }} - {{ $data->alamat }} -
                                                            {{ $data->kode_pos }}
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
                                                        <input type="text" value="{{ $sp2d->no_surat }}"
                                                            class="form-control @error('no_surat') is-invalid @enderror"
                                                            id="nomorSurat" name="nomorSurat" required>
                                                        @error('no_surat')
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
                                            <label for="inputText" class="col-sm-4 col-form-label">Tahun Anggaran</label>
                                            <div class="col-sm-8">
                                                <input name="tanggaran" value="{{ $sp2d->tahun_anggaran }}" type="number"
                                                    id="inputTahun" min="2000" max="9999" step="1"
                                                    class="form-control" placeholder="Masukkan Tahun Anggaran">
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
                                                class="form-control @error('bank_pos_keuangan') is-invalid @enderror"
                                                placeholder="Masukan Bank/Pos Keuangan"
                                                value="{{ $sp2d->bank_pos_keuangan }}" required>
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
                                                class="form-control @error('no_rek_keuangan') is-invalid @enderror"
                                                placeholder="Masukan Nomor Rekening keuangan"
                                                value="{{ $sp2d->no_rek_keuangan }}" required>
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
                                        <input name="kepada" value="{{ $sp2d->kepada }}" type="text"
                                            class="form-control @error('kepada') is-invalid @enderror"
                                            placeholder="Masukan Nama Pihak ke Tiga" required>
                                        @error('kepada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label ">Bank / Pos</label>
                                    <div class="col-sm-10">
                                        <input name="bank_pos" type="text" value="{{ $sp2d->bank_pos }}"
                                            class="form-control  @error('bank_pos') is-invalid @enderror" required
                                            placeholder="Masukkan Bank / Pos">

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
                                        <input name="npwp" type="text" value="{{ $sp2d->npwp }}"
                                            class="form-control @error('npwp') is-invalid @enderror"
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
                                        <input name="no_rek" type="text" value="{{ $sp2d->rekening }}"
                                            class="form-control @error('no_rek') is-invalid @enderror"
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
                                        <input name="jumlah_uang" value="{{ $sp2d->jumlah_uang }}" type="text"
                                            class="form-control @error('jumlah_uang') is-invalid @enderror"
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
                                        <input name="keperluann" type="text" value="{{ $sp2d->keperluan }}"
                                            class="form-control @error('keperluann') is-invalid @enderror"
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
                                            {{-- <form id="dynamicForm" method="POST"
                                                action="{{ route('save-keperluan') }}"> --}}
                                            {{-- @csrf --}}
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
                                                </div>
                                            </div>
                                            {{-- </form> --}}
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
                                            @foreach ($ttd as $data)
                                                <option name='tdata' value="{{ $data->id }}"
                                                    {{ $data->id == $sp2d->ttd_id ? 'selected' : '' }}>
                                                    {{ $data->nama }} -
                                                    NIP.
                                                    {{ $data->nip }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" id="saveData"
                                            class="btn btn-success mt-3">Simpan</button>
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
            let formData = [];

            let defaultFormData = {!! json_encode($sp2d->keperluann) !!};

            function setDefaultValues(formIndex) {
                $('input[name="data_uraian_keperluan[' + formIndex + '][kode_rekening]"]').val(defaultFormData[
                    formIndex].kode_rekening);
                $('input[name="data_uraian_keperluan[' + formIndex + '][uraian]"]').val(defaultFormData[formIndex]
                    .uraian);
                $('input[name="data_uraian_keperluan[' + formIndex + '][jumlah]"]').val(defaultFormData[formIndex]
                    .jumlah);
            }

            // Menambahkan formulir baru dengan data default ketika halaman dimuat
            for (let i = 0; i < defaultFormData.length; i++) {
                let newForm = `
        <div class="row mb-3" id="formRowkeperluan${i}">
            <div class="col-md-4">
                <input type="text" class="form-control" name="data_uraian_keperluan[${i}][kode_rekening]" placeholder="Kode Rekening">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="data_uraian_keperluan[${i}][uraian]" placeholder="Uraian">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="data_uraian_keperluan[${i}][jumlah]" placeholder="Rp Jumlah">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger removeForm" data-id="${i}">Hapus</button>
            </div>
        </div>
    `;
                $('#dynamicFormContainer').append(newForm);
                setDefaultValues(i);
                formData.push({
                    kode_rekening: defaultFormData[i].kode_rekening,
                    uraian: defaultFormData[i].uraian,
                    jumlah: defaultFormData[i].jumlah
                });
            }

            // Menambahkan formulir baru saat tombol "Tambah Form" diklik
            $('#addForm').on('click', function() {
                let formIndex = formData.length;
                let newForm = `
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
                let removeFormId = $(this).data('id');
                $('#formRowkeperluan' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_uraian_keperluan"]', function() {
                let formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
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
            let formData = [];

            let defaultFormData = {!! json_encode($sp2d->potongan) !!};

            function setDefaultValues(formIndex) {
                $('input[name="data_potongan[' + formIndex + '][no_rekening]"]').val(defaultFormData[
                    formIndex].no_rekening);
                $('input[name="data_potongan[' + formIndex + '][jumlah]"]').val(defaultFormData[formIndex]
                    .jumlah);
                $('input[name="data_potongan[' + formIndex + '][keterangan]"]').val(defaultFormData[formIndex]
                    .keterangan);
            }

            // Menambahkan formulir baru dengan data default ketika halaman dimuat
            for (let i = 0; i < defaultFormData.length; i++) {
                let newForm = `
<div class="row mb-3" id="formRowpotongan${i}">
<div class="col-md-4">
    <input type="text" class="form-control" name="data_potongan[${i}][no_rekening]" placeholder="No Rekening/uraian">
</div>
<div class="col-md-4">
    <input type="text" class="form-control" name="data_potongan[${i}][jumlah]" placeholder="jumlah">
</div>
<div class="col-md-3">
    <input type="text" class="form-control" name="data_potongan[${i}][keterangan]" placeholder="Rp keterangan">
</div>
<div class="col-md-1">
    <button type="button" class="btn btn-danger removeFormPotongan" data-id="${i}">Hapus</button>
</div>
</div>
`;
                $('#dynamicFormContainerPotongan').append(newForm);
                setDefaultValues(i);
                formData.push({
                    no_rekening: defaultFormData[i].no_rekening,
                    jumlah: defaultFormData[i].jumlah,
                    keterangan: defaultFormData[i].keterangan
                });
            }


            $('#addFormPotongan').on('click', function() {
                let formIndex = formData.length;
                let newForm = `
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
                let removeFormId = $(this).data('id');
                $('#formRowpotongan' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_potongan"]', function() {
                let formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
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
        /////////////////////////////////// infomrasi //////////////////////////////////////
        $(document).ready(function() {
            let formData = [];

            let defaultFormData = {!! json_encode($sp2d->informasi) !!};

            function setDefaultValues(formIndex) {
                $('input[name="data_informasi[' + formIndex + '][no_rekening]"]').val(defaultFormData[
                    formIndex].no_rekening);
                $('input[name="data_informasi[' + formIndex + '][jumlah]"]').val(defaultFormData[formIndex]
                    .jumlah);
                $('input[name="data_informasi[' + formIndex + '][keterangan]"]').val(defaultFormData[formIndex]
                    .keterangan);
            }

            // Menambahkan formulir baru dengan data default ketika halaman dimuat
            for (let i = 0; i < defaultFormData.length; i++) {
                let newForm = `
<div class="row mb-3" id="formRowpotongan${i}">
<div class="col-md-4">
    <input type="text" class="form-control" name="data_informasi[${i}][no_rekening]" placeholder="No Rekening/uraian">
</div>
<div class="col-md-4">
    <input type="text" class="form-control" name="data_informasi[${i}][jumlah]" placeholder="jumlah">
</div>
<div class="col-md-3">
    <input type="text" class="form-control" name="data_informasi[${i}][keterangan]" placeholder="Rp keterangan">
</div>
<div class="col-md-1">
    <button type="button" class="btn btn-danger removeFormPotongan" data-id="${i}">Hapus</button>
</div>
</div>
`;
                $('#dynamicFormContainerInformasi').append(newForm);
                setDefaultValues(i);
                formData.push({
                    no_rekening: defaultFormData[i].no_rekening,
                    jumlah: defaultFormData[i].jumlah,
                    keterangan: defaultFormData[i].keterangan
                });
            }


            $('#addFormInformasi').on('click', function() {
                let formIndex = formData.length;
                let newForm = `
            <div class="row mb-3" id="formRowpotongan${formIndex}">
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

            $(document).on('click', '.removeFormPotongan', function() {
                let removeFormId = $(this).data('id');
                $('#formRowpotongan' + removeFormId).remove();
                formData.splice(removeFormId, 1);

                if (formData.length === 0) {
                    $('#saveData').hide();
                }
            });

            $(document).on('input', 'input[name^="data_informasi"]', function() {
                let formId = $(this).attr('name').match(/\[(\d+)\]/)[1];
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
            let nomorSurat = generateNomorSurat(); // Fungsi yang menghasilkan nomor surat

            document.getElementById('nomorSurat').value = nomorSurat;
        });

        function generateNomorSurat() {
            let date = new Date();
            let today = formatDate(date); // Format tanggal ke DD/MM/YYYY

            let lastDate = localStorage.getItem('lastDate');
            let lastNumber = localStorage.getItem('lastNumber');

            if (lastDate !== today) {
                lastDate = today;
                lastNumber = '0000'; // Mulai dari 000 setiap hari yang baru
            } else {
                lastNumber = ('0000' + (parseInt(lastNumber) + 1)).slice(-4);
            }

            localStorage.setItem('lastDate', lastDate);
            localStorage.setItem('lastNumber', lastNumber);

            let nomorSurat = lastNumber + '-' + 'SP2D' + '/' + lastDate.replace(/\//g, '/');

            return nomorSurat;
        }

        function formatDate(date) {
            let day = ('0' + date.getDate()).slice(-2);
            let month = ('0' + (date.getMonth() + 1)).slice(-2);
            let year = date.getFullYear();

            return day + '/' + month + '/' + year;
        }
    </script>
@endsection
