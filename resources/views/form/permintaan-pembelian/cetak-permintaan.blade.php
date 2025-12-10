<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Permintaan Barang</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin-top: 4.0cm;
            margin-bottom: 1.0cm;
            margin-left: 2.54cm;
            margin-right: 2.54cm;
            font-size: 13.3px;
            color: #000;
            background: #fff;
        }

        .header {
            text-align: center;
        }

        .main-title {
            font-size: 18pt;
            font-weight: bold;
            padding-top: 0.6cm;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #000;
        }

        .document-info table {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
            font-size: 13px;
            background: #fff;
            color: #000;
        }

        .document-info td {
            padding: 6px 4px;
        }

        .document-info td.label {
            font-weight: bold;
            width: 26%;
        }

        .document-info td.sep {
            width: 2%;
        }

        #tabelalat {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 18px;
            background: #fff;
            color: #000;
        }

        #tabelalat th,
        #tabelalat td {
            border: 1px solid #444;
            padding: 5px 4px;
            vertical-align: middle;
        }

        #tabelalat th {
            background: #fff;
            color: #000;
            font-size: 13px;
            text-align: center;
        }

        #tabelalat td {
            font-size: 13px;
        }

        #tabelalat tr:nth-child(even) td {
            background: #fff;
        }

        .signature-section {
            margin-top: 34px;
            color: #000;
        }

        .signature-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 24px 10px;
        }

        .signature-table>tbody>tr>td {
            vertical-align: top;
            width: 33.3%;
        }

        .signature-table .bottom-sign {
            width: 50%;
        }

        .signature-title {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            letter-spacing: .5px;
            color: #000;
        }

        .signature-box {
            height: 85px;
            padding: 4px 0 0 0;
            text-align: center;
            vertical-align: bottom;
        }

        .signature-box img {
            max-height: 80px;
            opacity: 1;
        }

        .no-signature {
            color: #aaa;
            font-style: italic;
            font-size: 12px;
        }

        .signature-line {
            border-bottom: 1.2px solid #666;
            height: 18px;
            margin: 7px 15px 0 15px;
        }

        .signature-name {
            text-align: center;
            font-weight: 600;
            padding-top: 7px;
            font-size: 13px;
            color: #000;
        }

        @media print {
            body {
                background: #fff !important;
                color: #000 !important;
            }

            .document-info table,
            #tabelalat {
                font-size: 12px;
                background: #fff !important;
                color: #000 !important;
            }
        }
    </style>
</head>

<body>
    <div style="margin-top: 0.3cm; margin-bottom: 0.3cm;">
        <center>
            <span class="main-title">FORMULIR PERMINTAAN BARANG</span>
            <br>
            <small style="font-size:12px;letter-spacing:1px; color:#000;">Dokumen ini dicetak otomatis melalui sistem.
                Tidak perlu tanda tangan basah.</small>
            <br>
            <b style="font-size:13px;display:block;margin-top:8px;">Permintaan barang ini diajukan ke bagian SMI /
                Logistik untuk diproses lebih lanjut.</b>
        </center>
    </div>

    <div class="document-info">
        <table>
            <tr>
                <td class="label">Departemen</td>
                <td class="sep">:</td>
                <td>{{ optional($data->getDepartemen)->Nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Permintaan</td>
                <td class="sep">:</td>
                <td>{{ \Carbon\Carbon::parse($data->Tanggal ?? '')->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">Diajukan Oleh</td>
                <td class="sep">:</td>
                <td>{{ optional($data->getDiajukanOleh)->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Pengajuan</td>
                <td class="sep">:</td>
                <td>{{ $data->NomorPengajuan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <center>
        <p style="font-weight:bold;margin:0 0 8px 0;letter-spacing:.5px;color:#000;">Daftar Barang Diajukan</p>
    </center>
    <table id="tabelalat">
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:20%;">Nama Barang</th>
                <th style="width:15%;">Merek</th>
                <th style="width:10%;">Jumlah</th>
                <th style="width:10%;">Satuan</th>
                <th style="width:15%;">Rencana Penempatan</th>
                <th style="width:20%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data->getDetail as $index => $detail)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $detail->getBarang->Nama ?? '-' }}</td>
                    <td>{{ $detail->getBarang->getMerk->Nama ?? '-' }}</td>
                    <td style="text-align: center;">{{ $detail->Jumlah ?? '-' }}</td>
                    <td>{{ $detail->getBarang->getSatuan->NamaSatuan ?? '-' }}</td>
                    <td>{{ $detail->RencanaPenempatan ?? '-' }}</td>
                    <td>{{ $detail->Keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; font-style:italic;">Tidak ada data barang</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-section">
        <table class="signature-table" id="ttd">
            <tr>
                <!-- Diajukan Oleh -->
                <td>
                    <table>
                        <tr>
                            <td class="signature-title">Diajukan Oleh</td>
                        </tr>
                        <tr>
                            <td class="signature-box">
                                @if (!empty($data->getDiajukanOleh->ttd))
                                    <img src="{{ asset('storage/tandatangan/' . $data->getDiajukanOleh->ttd) }}"
                                        alt="Tanda Tangan">
                                @else
                                    <span class="no-signature">Tidak ada tanda tangan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="signature-line"></td>
                        </tr>
                        <tr>
                            <td class="signature-name">{{ $data->getDiajukanOleh->name ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <!-- Kepala Divisi -->
                <td>
                    <table>
                        <tr>
                            <td class="signature-title">Kepala Divisi</td>
                        </tr>
                        <tr>
                            <td class="signature-box">
                                @if (!empty($data->getKepalaDivisi->ttd))
                                    <img src="{{ asset('storage/tandatangan/' . $data->getKepalaDivisi->ttd) }}"
                                        alt="Tanda Tangan">
                                @else
                                    <span class="no-signature">Tidak ada tanda tangan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="signature-line"></td>
                        </tr>
                        <tr>
                            <td class="signature-name">{{ $data->getKepalaDivisi->name ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <!-- Penunjang Medis/Umum -->
                <td>
                    <table>
                        <tr>
                            <td class="signature-title">Penunjang Medis/Umum</td>
                        </tr>
                        <tr>
                            <td class="signature-box">
                                @if (!empty($data->getAccPenunjangMedis->ttd))
                                    <img src="{{ asset('storage/tandatangan/' . $data->getAccPenunjangMedis->ttd) }}"
                                        alt="Tanda Tangan">
                                @else
                                    <span class="no-signature">Tidak ada tanda tangan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="signature-line"></td>
                        </tr>
                        <tr>
                            <td class="signature-name">{{ $data->getAccPenunjangMedis->name ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <!-- Direktur -->
                <td class="bottom-sign">
                    <table>
                        <tr>
                            <td class="signature-title">Direktur</td>
                        </tr>
                        <tr>
                            <td class="signature-box">
                                @if (!empty($data->getAccDirektur->ttd))
                                    <img src="{{ asset('storage/tandatangan/' . $data->getAccDirektur->ttd) }}"
                                        alt="Tanda Tangan">
                                @else
                                    <span class="no-signature">Tidak ada tanda tangan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="signature-line"></td>
                        </tr>
                        <tr>
                            <td class="signature-name">{{ $data->getAccDirektur->name ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <!-- SMI / Logistik -->
                <td class="bottom-sign">
                    <table>
                        <tr>
                            <td class="signature-title">SMI / Logistik</td>
                        </tr>
                        <tr>
                            <td class="signature-box">
                                @if (!empty($data->getSmi->ttd))
                                    <img src="{{ asset('storage/tandatangan/' . $data->getSmi->ttd) }}"
                                        alt="Tanda Tangan">
                                @else
                                    <span class="no-signature">Tidak ada tanda tangan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="signature-line"></td>
                        </tr>
                        <tr>
                            <td class="signature-name">{{ $data->getSmi->name ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</body>

</html>
