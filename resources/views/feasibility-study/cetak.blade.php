<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feasibility Study</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            padding: 20px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        .nb {
            border: none;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .gray {
            background: #ddd;
        }
    </style>
</head>

<body>
    <h3 class="center bold">FEASIBILITY STUDY</h3>
    <p class="bold">A. Rincian Data</p>
    <table>
        <tr>
            <td width="180px">Nama Alat</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nilai Investasi</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Spesifikasi</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>

    <p class="bold">B. Biaya</p>
    <table>
        <tr>
            <td colspan="3" class="bold">Biaya Tetap & Variable</td>
        </tr>
        <tr>
            <td width="180px">Bunga Tetap</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px">Penyusutan</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px">Maintenance</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px">Pegawai</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px">Sewa Gedung</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px" class="bold">Total Biaya Tetap</td>
            <td width="5px" class="bold">:</td>
            <td class="bold"></td>
        </tr>
        <tr>
            <td width="180px">Konsumable</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
        <tr>
            <td width="180px">Dokter</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
    </table>


    <p class="bold">C. Tarif</p>
    <table>
        <tr>
            <td width="180px">Coding BPJS kit sebesar Rp</td>
            <td width="5px">:</td>
            <td></td>
        </tr>
    </table>


    <p class="bold">D. Laba Rugi</p>
    <table>
        <tr class="gray bold center">
            <td>Keterangan</td>
            <td>Tahun I</td>
            <td>Tahun II</td>
            <td>Tahun III</td>
            <td>Tahun IV</td>
            <td>Tahun V</td>
            <td>Tahun VI</td>
            <td>Tahun VII</td>
        </tr>
        <tr>
            <td>Jumlah Tindakan BPJS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tarif Umum</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tarif BPJS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Revenue</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Biaya</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Biaya Tetap</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Biaya Variable</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Net Profit</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>EBITDA</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Akumulasi EBITDA</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>ROI Tahun Ke-</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>


    <h5 class="text-center mb-4"><strong>Persetujuan Permintaan Pembelian</strong></h5>
    <!-- Untuk cetak PDF tanda tangan approval -->
    <table style="width:100%; margin: 0 auto; border:none;">
        <colgroup>
            @if (!empty($approval))
                @foreach ($approval as $item)
                    <col style="width: {{ 100 / count($approval) }}%;">
                @endforeach
            @endif
        </colgroup>
        <tbody>
            <tr>
                @foreach ($approval as $item)
                    <td style="text-align:center; font-weight:600; border:none;">
                        {{ $item->getJabatan->Nama ?? '-' }}<br>
                        {{ $item->getDepartemen->Nama ?? '-' }}
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($approval as $item)
                    <td class="text-center align-bottom" style="height: 20px; border:none;">
                        {{-- Tempat kosong untuk tanda tangan basah di cetak PDF --}}
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($approval as $item)
                    <td style="height: 70px; text-align:center; border:none;">
                        @if (!empty($item->Ttd))
                            <img src="{{ public_path('storage/upload/tandatangan/' . $item->Ttd) }}" alt="TTD"
                                style="max-width:110px; max-height:60px;">
                        @else
                            <!-- Jika tidak ada tanda tangan digital, biarkan kosong untuk tanda tangan manual -->
                        @endif
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($approval as $item)
                    <td class="text-center" style="padding-bottom:0; border:none;">
                        <hr style="width: 70%; margin:0 auto 3px auto;border-top:2px solid #000;">
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach ($approval as $item)
                    <td class="text-center align-top" style="border:none;">
                        <span style="font-weight:600; display: block; text-align: center;">
                            {{ $item->Nama ?? '-' }}
                        </span>
                        <div style="display: block; text-align: center;">
                            <small style="display: inline-block;">{{ $item->Status ?? '-' }}</small>
                            <br>
                            <small style="display: inline-block;">Approved</small>
                        </div>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>

</html>
