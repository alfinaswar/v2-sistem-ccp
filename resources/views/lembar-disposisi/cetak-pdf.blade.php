<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #e31e24;
            margin: 0;
        }

        .info-section {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .approval-box {
            height: 80px;
            vertical-align: top;
        }

        .sign-area {
            min-height: 60px;
        }

        .footer-note {
            font-size: 9px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>RS AWAL BROS</h2>
        <h3>LEMBARAN DISPOSISI PENGADAAN BARANG / JASA</h3>
    </div>

    <div class="info-section">
        <table style="border: none;">
            <tr style="border: none;">
                <td style="border: none; width: 40%;">NAMA BARANG / JASA YANG AKAN DIBELI</td>
                <td style="border: none;">: {{ $data['namaBarang'] ?? '-' }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">HARGA</td>
                <td style="border: none;">:
                    {{ isset($data['harga']) ? number_format($data['harga'], 0, ',', '.') : '-' }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">RENCANA VENDOR</td>
                <td style="border: none;">: {{ $data['rencanaVendor'] ?? '-' }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">TUJUAN PENGGUNA/RUANGAN</td>
                <td style="border: none;">: {{ $data['tujuanPenempatan'] ?? '-' }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">FORM PERMINTAAN DARI USER</td>
                <td style="border: none;">
                    :
                    @if (isset($data['formPermintaan']))
                        {{ $data['formPermintaan'] == 'Y' ? 'ada' : 'Tidak' }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <table>
        <tr>
            <th style="width: 70%;">JUSTIFIKASI PEMBELIAN BARANG/JASA</th>
            <th style="width: 30%;">KADIV YANMED RS</th>
        </tr>
        <tr>
            <td class="approval-box">
                @if (!empty($data['approval'][0]) && isset($data['approval'][0]->Catatan))
                    {{ $data['approval'][0]->Catatan }}
                @endif
            </td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (!empty($data['approval'][0]) && isset($data['approval'][0]->Nama))
                        <p>{{ $data['approval'][0]->Nama }}</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 70%;">JUSTIFIKASI PEMILIHAN BARANG/JASA</th>
            <th style="width: 30%;">KADIV JANGMED RS</th>
        </tr>
        <tr>
            <td class="approval-box">
                @if (!empty($data['approval'][1]) && isset($data['approval'][1]->Catatan))
                    {{ $data['approval'][1]->Catatan }}
                @endif
            </td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (
                        !empty($data['approval'][1]) &&
                            isset($data['approval'][1]->StatusApprove) &&
                            $data['approval'][1]->StatusApprove == 'Y')
                        <p>{{ $data['approval'][1]->Nama ?? '' }}</p>
                        <p>{{ isset($data['approval'][1]->ApprovePada) ? date('d/m/Y H:i', strtotime($data['approval'][1]->ApprovePada)) : '' }}
                        </p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 70%;">PERSETUJUAN</th>
            <th style="width: 30%;">DIREKTUR RS</th>
        </tr>
        <tr>
            <td class="approval-box"></td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (
                        !empty($data['approval'][2]) &&
                            isset($data['approval'][2]->StatusApprove) &&
                            $data['approval'][2]->StatusApprove == 'Y')
                        <p>{{ $data['approval'][2]->Nama ?? '' }}</p>
                        <p>{{ isset($data['approval'][2]->ApprovePada) ? date('d/m/Y H:i', strtotime($data['approval'][2]->ApprovePada)) : '' }}
                        </p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 70%;">PERSETUJUAN</th>
            <th style="width: 30%;">GH PROCUREMENT</th>
        </tr>
        <tr>
            <td class="approval-box"></td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (
                        !empty($data['approval'][3]) &&
                            isset($data['approval'][3]->StatusApprove) &&
                            $data['approval'][3]->StatusApprove == 'Y')
                        <p>
                            {{ $data['approval'][3]->Nama ?? '' }}
                            @if (isset($data['approval'][3]->Jabatan))
                                , {{ $data['approval'][3]->Jabatan }}
                            @endif
                        </p>
                        <p>{{ isset($data['approval'][3]->ApprovePada) ? date('d/m/Y H:i', strtotime($data['approval'][3]->ApprovePada)) : '' }}
                        </p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 70%;">PERSETUJUAN</th>
            <th style="width: 30%;">DIREKTUR RSAB GROUP</th>
        </tr>
        <tr>
            <td class="approval-box"></td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (
                        !empty($data['approval'][4]) &&
                            isset($data['approval'][4]->StatusApprove) &&
                            $data['approval'][4]->StatusApprove == 'Y')
                        <p>{{ $data['approval'][4]->Nama ?? '' }}</p>
                        <p>{{ isset($data['approval'][4]->ApprovePada) ? date('d/m/Y H:i', strtotime($data['approval'][4]->ApprovePada)) : '' }}
                        </p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 70%;">PERSETUJUAN</th>
            <th style="width: 30%;">CEO RSAB GROUP</th>
        </tr>
        <tr>
            <td class="approval-box"></td>
            <td class="approval-box">
                <div class="sign-area">
                    @if (
                        !empty($data['approval'][5]) &&
                            isset($data['approval'][5]->StatusApprove) &&
                            $data['approval'][5]->StatusApprove == 'Y')
                        <p>{{ $data['approval'][5]->Nama ?? '' }}</p>
                        <p>{{ isset($data['approval'][5]->ApprovePada) ? date('d/m/Y H:i', strtotime($data['approval'][5]->ApprovePada)) : '' }}
                        </p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        *) Coret jika tidak ada halaman lain
    </div>
</body>

</html>
