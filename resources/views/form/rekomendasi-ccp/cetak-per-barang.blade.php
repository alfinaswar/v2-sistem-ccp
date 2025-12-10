<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rekomendasi CCP - Cetak Per Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #444;
            padding: 6px 8px;
        }

        .main-table th {
            background: #eee;
            font-weight: bold;
            text-align: left;
        }

        .signature {
            margin-top: 80px;
            text-align: right;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="title">
        FORMULIR REKOMENDASI BARANG MEDIS
    </div>

    <table class="main-table" style="margin-bottom: 45px;">
        <td style="width: 100px;">RS yang Meminta</td>
        <td colspan="3">
            <strong>
                {{ $data[0]->getPengajuan && $data[0]->getPengajuan->getPerusahaan ? $data[0]->getPengajuan->getPerusahaan->Nama : '-' }}
            </strong>
        </td>
        </tr>
        <tr>
            <td>Nama Vendor</td>
            @foreach ($data as $key => $item)
                <td>
                    @if ($item->getVendor->Nama)
                        {{ $item->getVendor->Nama }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Nama Barang</td>
            @foreach ($data as $key => $item)
                <td>
                    @if ($item->getBarang && count($item->getBarang) && $item->getBarang[0]->Nama)
                        {{ $item->getBarang[0]->Nama }}
                    @else
                        {{ $item->NamaPermintaan ?? '-' }}
                    @endif
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Harga Awal</td>
            @foreach ($data as $key => $item)
                <td style="text-align: right;">
                    @if ($item->HargaAwal)
                        Rp {{ number_format($item->HargaAwal, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Harga Nego</td>
            @foreach ($data as $key => $item)
                <td style="text-align: right;">
                    @if ($item->HargaNego)
                        Rp {{ number_format($item->HargaNego, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Spesifikasi</td>
            @foreach ($data as $key => $item)
                <td>
                    @if ($item->Spesifikasi)
                        {!! $item->Spesifikasi !!}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Negara Produksi</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->NegaraProduksi ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Garansi</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Garansi ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Teknisi</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Teknisi ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Bmhp</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Bmhp ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>SparePart</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->SparePart ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>BackupUnit</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->BackupUnit ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Top</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Top ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Rekomendasi</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Rekomendasi ?? '-' }}
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Keterangan</td>
            @foreach ($data as $key => $item)
                <td>
                    {{ $item->Keterangan ?? '-' }}
                </td>
            @endforeach
        </tr>
    </table>

    <div class="signature">
        <div style="text-align: right; margin-bottom: 10px;">
            <span>
                {{ $data[0]->getPengajuan && $data[0]->getPengajuan->getPerusahaan && $data[0]->getPengajuan->getPerusahaan->Kota ? $data[0]->getPengajuan->getPerusahaan->Kota : '.............' }},
                {{ $data[0]->created_at ? \Carbon\Carbon::parse($data[0]->created_at)->format('d-m-Y') : date('d-m-Y') }}
            </span>
        </div>

        <table style="width: 100%; margin-top: 40px; border: none;">
            <tr>
                <td style="width:33%; text-align:center; vertical-align:top;">
                    <b>Yang Menegosiasi</b>
                    <div style="height:60px;"></div>
                    <hr style="width:80%; margin: 10px auto 0 auto;">
                </td>
                <td style="width:34%;"></td>
                <td style="width:33%; text-align:center; vertical-align:top;">
                    <b>Disetujui</b><br>
                    <b>Procurement Group</b>
                    <div style="height:48px;"></div>
                    <hr style="width:80%; margin: 10px auto 0 auto;">
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
