<style>
    body,
    .cetak-hta-gpa-global {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10pt;
    }

    table.cetak-hta {
        font-size: 10pt;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table.cetak-hta th,
    table.cetak-hta td {
        border: 1px solid #222;
        padding: 5px;
    }

    table.cetak-hta tr {
        line-height: 0.9;
    }

    .cetak-hta-caption {
        border: none !important;
    }

    .cetak-hta-caption th,
    .cetak-hta-caption td {
        border: none !important;
        padding-bottom: 3px;
    }

    /* Make parameter and sub total a bit smaller */
    .col-parameter {
        font-size: 9pt !important;
        min-width: 110px;
        max-width: 180px;
        width: 140px;
        vertical-align: top;
    }

    .col-subtotal {
        font-size: 9pt !important;
        min-width: 60px;
        width: 70px;
        text-align: right;
        font-weight: 700;
        background: #f4f4f4;
    }
</style>
<div class="cetak-hta-gpa-global">
    <h2 style="text-align:center; margin-bottom:20px;">PENILAIAN HTA / GPA</h2>
    <table class="cetak-hta cetak-hta-caption">
        <tr>
            <th>Nama Barang</th>
            <td colspan="{{ count($data->getVendor) }}">
                {{ $data->getPengajuanItem[0]->getBarang->Nama ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>Merek</th>
            <td colspan="{{ count($data->getVendor) }}">
                {{ $data->getPengajuanItem[0]->getBarang->getMerk->Nama ?? '-' }}
            </td>
        </tr>
    </table>

    {{-- Table HEAD --}}
    <table class="cetak-hta">
        <thead>
            <tr>
                <th rowspan="2" style="min-width: 30px; width: 35px;">No</th>
                <th rowspan="2" class="col-parameter">Parameter</th>
                <th rowspan="2" style="min-width: 110px; max-width: 200px;">Deskripsi</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <th colspan="6" style="text-align:center; min-width:270px;">
                        {{ $Vendor->getNamaVendor->Nama ?? 'Vendor ' . ($vIdx + 1) }}
                    </th>
                @endforeach
            </tr>
            <tr>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th class="col-subtotal">Sub Total</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data->getJenisPermintaan->getForm->Parameter as $key => $pm)
                <tr>
                    <td style="text-align:center;">{{ $key + 1 }}</td>
                    <td class="col-parameter">{{ $parameter[$pm - 1]->Nama ?? '-' }}</td>
                    @foreach ($data->getVendor as $vIdx => $Vendor)
                        @if ($loop->first)
                            <td>{!! $Vendor->getHtaGpa->Deskripsi[$key] ?? '-' !!}</td>
                        @endif
                    @endforeach
                    @foreach ($data->getVendor as $vIdx => $Vendor)
                        <td style="width:20px;text-align:center;">{{ $Vendor->getHtaGpa->Nilai1[$key] ?? '' }}</td>
                        <td style="width:20px;text-align:center;">{{ $Vendor->getHtaGpa->Nilai2[$key] ?? '' }}</td>
                        <td style="width:20px;text-align:center;">{{ $Vendor->getHtaGpa->Nilai3[$key] ?? '' }}</td>
                        <td style="width:20px;text-align:center;">{{ $Vendor->getHtaGpa->Nilai4[$key] ?? '' }}</td>
                        <td style="width:20px;text-align:center;">{{ $Vendor->getHtaGpa->Nilai5[$key] ?? '' }}</td>
                        <td class="col-subtotal">
                            {{ $Vendor->getHtaGpa->SubTotal[$key] ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right;">Grand Total</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    @php
                        $grandTotal = 0;
                        if (isset($Vendor->getHtaGpa->SubTotal) && is_array($Vendor->getHtaGpa->SubTotal)) {
                            foreach ($Vendor->getHtaGpa->SubTotal as $sub) {
                                $grandTotal += is_numeric($sub) ? $sub : 0;
                            }
                        }
                    @endphp
                    <th colspan="6" style="text-align:right; background: #f4f4f4; font-weight:700;">
                        {{ $grandTotal }}</th>
                @endforeach
            </tr>
        </tfoot>
    </table>

    {{-- Table Perbandingan Ekonomi --}}
    <table class="cetak-hta">
        <thead>
            <tr>
                <th class="col-parameter">Parameter</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <th>{{ $Vendor->getNamaVendor->Nama ?? 'Vendor ' . ($vIdx + 1) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="col-parameter">Umur Ekonomis</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <td>{{ $Vendor->getHtaGpa->UmurEkonomis ?? '-' }}</td>
                @endforeach
            </tr>
            <tr>
                <th class="col-parameter">Buyback Period</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <td>{{ $Vendor->getHtaGpa->BuybackPeriod ?? '-' }}</td>
                @endforeach
            </tr>
            <tr>
                <th class="col-parameter">Tarif Diusulkan</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <td>{{ $Vendor->getHtaGpa->TarifDiusulkan ?? '-' }}</td>
                @endforeach
            </tr>
            <tr>
                <th class="col-parameter">Target Pemakaian Bulanan</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <td>{{ $Vendor->getHtaGpa->TargetPemakaianBulanan ?? '-' }}</td>
                @endforeach
            </tr>
            <tr>
                <th class="col-parameter">Keterangan</th>
                @foreach ($data->getVendor as $vIdx => $Vendor)
                    <td>{!! $Vendor->getHtaGpa->Keterangan ?? '-' !!}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
