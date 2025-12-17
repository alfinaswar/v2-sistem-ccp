@foreach ($data->getVendor as $vIdx => $Vendor)
    <h2 style="text-align:center; margin-bottom:20px;">PENILAIAN HTA / GPA</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="margin-bottom:20px;">
        <tr>
            <th>Nama Barang</th>
            <td>{{ $data->getPengajuanItem[0]->getBarang->Nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Merek</th>
            <td>{{ $data->getPengajuanItem[0]->getBarang->getMerk->Nama ?? '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-top:30px;">Vendor: {{ $Vendor->getNamaVendor->Nama ?? 'Vendor' }}</h4>
    @php
        // Hitung grand total dari subtotal
        $grandTotal = 0;
        if (isset($Vendor->getHtaGpa->SubTotal) && is_array($Vendor->getHtaGpa->SubTotal)) {
            foreach ($Vendor->getHtaGpa->SubTotal as $sub) {
                $grandTotal += is_numeric($sub) ? $sub : 0;
            }
        }
    @endphp
    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="margin-bottom:10px;">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Parameter</th>
                <th rowspan="2">Deskripsi</th>
                <th colspan="5">Nilai</th>
                <th rowspan="2">Sub Total</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->getJenisPermintaan->getForm->Parameter as $key => $pm)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $parameter[$pm - 1]->Nama ?? '-' }}</td>
                    <td>{!! $Vendor->getHtaGpa->Deskripsi[$key] ?? '-' !!}</td>
                    <td>{{ $Vendor->getHtaGpa->Nilai1[$key] ?? '' }}</td>
                    <td>{{ $Vendor->getHtaGpa->Nilai2[$key] ?? '' }}</td>
                    <td>{{ $Vendor->getHtaGpa->Nilai3[$key] ?? '' }}</td>
                    <td>{{ $Vendor->getHtaGpa->Nilai4[$key] ?? '' }}</td>
                    <td>{{ $Vendor->getHtaGpa->Nilai5[$key] ?? '' }}</td>
                    <td>{{ $Vendor->getHtaGpa->SubTotal[$key] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" style="text-align:right;">Grand Total</th>
                <th>{{ $grandTotal }}</th>
            </tr>
        </tfoot>
    </table>

    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="margin-bottom:10px;">
        <tr>
            <th>Umur Ekonomis</th>
            <td>{{ $Vendor->getHtaGpa->UmurEkonomis ?? '-' }}</td>
        </tr>
        <tr>
            <th>Buyback Period</th>
            <td>{{ $Vendor->getHtaGpa->BuybackPeriod ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tarif Diusulkan</th>
            <td>{{ $Vendor->getHtaGpa->TarifDiusulkan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Target Pemakaian Bulanan</th>
            <td>{{ $Vendor->getHtaGpa->TargetPemakaianBulanan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{!! $Vendor->getHtaGpa->Keterangan ?? '-' !!}</td>
        </tr>
    </table>
    @if (!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach
