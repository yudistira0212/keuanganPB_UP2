<!DOCTYPE html>
<html lang="id">

<head>
    <style>
        #judul {
            text-align: center;
        }

        #halaman {
            /* width: auto;
            height: auto;
            position: center;
            border: 0.1px solid;
            padding: 20px;
            padding-left: 30px;
            padding-right: 30px; */

            width: 21cm;
            /* Lebar A4 */
            height: 29.7cm;
            /* Tinggi A4 */
            position: absolute;
            /* border: 0.1cm solid; Border dengan ketebalan 0.1cm */
            padding: 2cm;
            /* Padding keseluruhan */
        }

        #judul_kop {
            font-size: 7pt;
            color: black;
            margin-bottom: 0%;
            text-align: center;
            padding-bottom: 0%;
        }

        table {
            border-collapse: collapse;
            padding: 2px;
            width: 100%;
        }

        table,
        tr,
        th {
            text-align: center;
        }

        table,
        th,
        td {
            font-size: 12px;
            font-family: 'Times New Roman', Times, serif;
            padding: 0px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 2px;
            text-align: left;
        }

        .separator {
            border-bottom: 2px solid #616161;
            margin: -1.3rem 0 1.5rem;
        }
    </style>
</head>

<body>
    <div>
        <div id="halaman">
            <h3 id="judul"> Surat SP2D</h3>
            <table>
                <tr>
                    <td>
                        <div style="text-align: center;">
                            <h3>Kantor Pusat Keuangan</h3>
                            <p>Jl. Jendral Sudirman No. 123, Jakarta</p>
                        </div>
                        <table style="text-align: left; border: none;">

                            <tr>
                                <td style="border: none;">Nomor SPM</td>
                                <td style="border: none;">:</td>
                                <td style="border: none;">{{ $sp2d->no_spm }}</td>
                            </tr>
                            <tr>
                                <td style="border: none;">Tanggal</td>
                                <td style="border: none;">:</td>
                                <td style="border: none;">{{ date('d F Y', strtotime($sp2d->tgl_sp2d)) }}</td>
                            </tr>
                            <tr>
                                <td style="border: none;">SKPD</td>
                                <td style="border: none;">:</td>
                                <td style="border: none;">{{ $sp2d->skpd->dinas }}</td>
                            </tr>

                        </table>

                    </td>
                    <td>
                        <div style="text-align: right;">
                            Nomor : {{ $sp2d->no_surat }}
                        </div>
                        <div style="text-align: center;">
                            <h3>SURAT PERINTAH PENCAIRAN DANA<br>
                                (SP2D)
                            </h3>
                        </div>
                        <table style=" border: none;">
                            <tr>
                                <td style="border: none;">Dari</td>
                                <td style="border: none;">:</td>
                                <td style="border: none;">Kuasa BUD</td>
                            </tr>
                            <tr>
                                <td style="border: none;">Tahun Anggaran</td>
                                <td style="border: none;">:</td>
                                <td style="border: none;">{{ $sp2d->tahun_anggaran }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <td colspan="2">
                    <table style="text-align: left; border: none;">
                        <tr>
                            <td style="border: none;">Bank / Pos : {{ $sp2d->bank_pos_keuangan }} </td>
                        </tr>
                        <tr>
                            <td style="border: none;">Hendaklah Mencairkan / memindahbukukan dari Bank Rekening :
                                {{ $sp2d->no_rek_keuangan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;">Uang Sebesar &nbsp;Rp. <a
                                    style="border: 1px;">{{ number_format($sp2d->jumlah_uang, 2, ',', '.') }}</a></td>
                        </tr>
                    </table>
                </td>
                <tr>
                    <table table style="text-align: left; border-top: none;">
                        <tr>
                            <td style="text-align: center; border-top: none; padding: 5px;">
                                <i style="text-align: center;   text-transform: uppercase; ">**{{ $terbilang }}
                                    RUPIAH**</i>
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table style="text-align: left; border-top: none ; border-bottom: none;">
                        <td style="border: none; padding-left: 30px; width: 25%;">
                            Kepada <br>
                            NPWP <br>
                            No. Rekening Bank <br>
                            Bank / Pos <br>
                            Keperluan <br>
                        </td>
                        <td style="border: none; width: 75%;">
                            : {{ $sp2d->kepada }}<br>
                            : {{ $sp2d->npwp }}<br>
                            : {{ $sp2d->rekening }} <br>
                            : {{ $sp2d->bank_pos }}<br>
                            : {{ $sp2d->keperluan }} <br>
                        </td>
                    </table>
                </tr>
                <tr>
                    <table style="text-align: left; border-bottom: none;">
                        <tr>
                            <th style="text-align: center;">NO</th>
                            <th style="text-align: center;">KODE REKENING </th>
                            <th style="text-align: center;">URAIAN</th>
                            <th style="text-align: center;">JUMLAH (Rp)</th>
                        </tr>
                        @foreach ($sp2d->keperluann as $index => $data)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td>{{ $data->kode_rekening }} </td>
                                <td>{{ $data->uraian }} </td>

                                <td style="text-align: right;">Rp. {{ number_format($data->jumlah, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td> </td>
                            <td> &nbsp;</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td> </td>
                            <td> </td>
                        </tr> --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;"><b>TOTAL JUMLAH BIAYA</b></td>
                            <td style="text-align: right;">Rp{{ number_format($sp2d->jumlah_uang, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table table style="text-align: left; border-top: none ; border-bottom: none;">
                        <tr>
                            <td style="border-top: none; border-bottom: none;">
                                <span> POTONGAN-POTONGAN </span>
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table style="text-align: left; border-top: none;">
                        <tr>
                            <th style="text-align: center; ">NO</th>
                            <th style="text-align: center;">URAIAN (NO REKENING)</th>
                            <th style="text-align: center;">JUMLAH</th>
                            <th style="text-align: center;">KETERANGAN</th>
                        </tr>
                        @foreach ($sp2d->potongan as $index => $data)
                            <tr>
                                <td> {{ $index + 1 }}</td>
                                <td style="text-align: right;">{{ $data->no_rekening }}</td>
                                <td style="text-align: right;">Rp{{ number_format($data->jumlah, 2, ',', '.') }}</td>
                                <td> &nbsp;{{ $data->keterangan }}</td>
                            </tr>
                        @endforeach
                    </table>
                </tr>
                <tr>
                    <table table style="text-align: left; border-top: none ; border-bottom: none;">
                        <tr>
                            <td style="border-top: none; border-bottom: none;">
                                <span> INFORMASI : <i style="font-style: italic;">mengurangi jumlah pembayaran
                                        (SP2D)</i> </span>
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table style="text-align: left; border-top: none;">
                        <tr>
                            <th style="text-align: center; ">NO</th>
                            <th style="text-align: center;">URAIAN (NO REKENING)</th>
                            <th style="text-align: center;">JUMLAH</th>
                            <th style="text-align: center;">KETERANGAN</th>
                        </tr>
                        @foreach ($sp2d->informasi as $index => $data)
                            <tr>
                                <td> {{ $index + 1 }}</td>
                                <td style="text-align: right;">{{ $data->no_rekening }}</td>
                                <td style="text-align: right;">Rp{{ number_format($data->jumlah, 2, ',', '.') }}</td>
                                <td> &nbsp;{{ $data->keterangan }}</td>
                            </tr>
                        @endforeach

                    </table>
                </tr>
                <tr>
                    <table style="text-align: left; border: none;">
                        <td style="border: none; width: auto;">
                            <br>
                            Jumlah yang Diminta <br>
                            Jumlah Potongan <br>
                            Jumlah yang Dibayarakan <br>
                        </td>
                        <td style="border: none; width: 20%;">
                            <br>
                            Rp. <br>
                            Rp. <br>
                            Rp. <br>
                        </td>
                    </table>
                </tr>
                <tr>
                    <table table style=" border-right: none; border-left: none; border-bottom: none;">
                        <tr>
                            <td style="border-right: none; border-left: none; border-bottom: none;">
                                <br>
                                <span style="text-align: center;">UANG SEJUMLAH</span><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; text-align: center;">
                                <span style="  text-transform: uppercase;">**{{ $terbilang }} RUPIAH**</span><br>
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table style="text-align: left;">
                        <td style="border: none; width: auto; padding: 5px;">
                            Lembar 1 : <br>
                            Lembar 2 : <br>
                            Lembar 3 : <br>
                            Lembar 4 : <br>
                            Lembar 5 : <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td style=" width:40%; text-align: center;">
                            Manokwari, 06 November 2023<br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>{{ $sp2d->ttd->nama }}
                            <br>NIP: {{ $sp2d->ttd->nip }}
                        </td>
                    </table>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
