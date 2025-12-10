@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Pengajuan Pembelian</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ajukan.index') }}">Pengajuan Pembelian</a></li>
                    <li class="breadcrumb-item active">Detail Pengajuan Pembelian</li>
                </ul>
            </div>

        </div>
        <div class="col text-end">
            <a href="{{ route('ajukan.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-s2">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Pengajuan Pembelian</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label"><strong>Tanggal</strong></label>
                            <input type="text" class="form-control"
                                value="{{ isset($data->Tanggal) ? $data->Tanggal : '-' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><strong>Jenis</strong></label>
                            <input type="text" class="form-control" value="{{ $data->getJenisPermintaan->Nama ?? '-' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label"><strong>Perkiraan Utilisasi Bulanan</strong></label>
                            <input type="text" class="form-control" value="{{ $data->PerkiraanUtilitasiBulanan ?? '-' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><strong>Perkiraan BEP Pada Tahun</strong></label>
                            <input type="text" class="form-control" value="{{ $data->PerkiraanBepPadaTahun ?? '-' }}"
                                readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label"><strong>RKAP</strong></label>
                            <input type="text" class="form-control" value="{{ $data->Rkap ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label"><strong>Nominal RKAP</strong></label>
                            <input type="text" class="form-control"
                                value="{{ number_format($data->NominalRkap ?? 0, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                    {{-- PERBANDINGAN VENDOR --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Perbandingan Vendor
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $vendorCount = isset($data->getVendor) ? count($data->getVendor) : 0;
                            @endphp

                            <ul class="nav nav-tabs d-sm-flex d-block" role="tablist">
                                @for ($vn = 0; $vn < $vendorCount; $vn++)
                                    <li class="nav-item">
                                        <a class="nav-link{{ $vn === 0 ? ' active' : '' }}" data-bs-toggle="tab"
                                            data-bs-target="#vendor_tab_{{ $vn }}"
                                            href="#vendor_tab_{{ $vn }}">
                                            Vendor {{ $vn + 1 }}
                                        </a>
                                    </li>
                                @endfor
                            </ul>

                            <div class="tab-content">
                                @for ($vnIdx = 0; $vnIdx < $vendorCount; $vnIdx++)
                                    @php
                                        $vendorList = $data->getVendor
                                            ? $data->getVendor
                                                ->map(function ($item) {
                                                    return $item;
                                                })
                                                ->values()
                                            : collect();
                                        $vendorData = $vendorList[$vnIdx] ?? null;
                                        $selectedVendor = null;
                                        if ($vendorData && isset($vendorData->NamaVendor)) {
                                            $selectedVendor = $vendor->firstWhere('id', $vendorData->NamaVendor);
                                        }

                                        $totalHargaSebelumDiskonAll = 0;
                                        $totalDiskonAll = 0;
                                        $totalHargaSetelahDiskonAll = 0;

                                        if (
                                            isset($vendorData) &&
                                            isset($vendorData->getVendorDetail) &&
                                            is_iterable($vendorData->getVendorDetail) &&
                                            count($vendorData->getVendorDetail)
                                        ) {
                                            foreach ($vendorData->getVendorDetail as $barang) {
                                                $jumlah = $barang->Jumlah ?? 0;
                                                $hargaSatuan = $barang->HargaSatuan ?? 0;
                                                $diskon = $barang->Diskon ?? 0;
                                                $jenisDiskon = $barang->JenisDiskon ?? null; // "persen" atau "nominal"

                                                $totalBarangHarga = $jumlah * $hargaSatuan;
                                                $nominalDiskon = 0;
                                                if ($diskon && $jenisDiskon) {
                                                    if (strtolower($jenisDiskon) == 'persen') {
                                                        $nominalDiskon = $totalBarangHarga * ($diskon / 100);
                                                    } else {
                                                        $nominalDiskon = $diskon;
                                                    }
                                                }
                                                $totalHargaSebelumDiskonAll += $totalBarangHarga;
                                                $totalDiskonAll += $nominalDiskon;
                                                $totalHargaSetelahDiskonAll += $totalBarangHarga - $nominalDiskon;
                                            }
                                        }
                                        $ppn = isset($vendorData->Ppn) ? floatval($vendorData->Ppn) : 0;
                                        $totalPpn = $ppn ? ($totalHargaSetelahDiskonAll * $ppn) / 100 : 0;
                                        $grandTotal = $totalHargaSetelahDiskonAll + $totalPpn;
                                    @endphp
                                    <div class="tab-pane{{ $vnIdx == 0 ? ' active' : '' }}"
                                        id="vendor_tab_{{ $vnIdx }}" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-xl-6">
                                                <div class="card">
                                                    <div class="row g-0">
                                                        <div class="col-md-8">
                                                            <div class="card-header">
                                                                <div
                                                                    class="card-title d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <label
                                                                            class="form-label mb-0"><strong>Vendor</strong></label>
                                                                        <div class="form-control-plaintext fw-bold">
                                                                            {{ $selectedVendor ? $selectedVendor->Nama : '-' }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- Button rekomendasikan vendor --}}
                                                                    @if ($selectedVendor)
                                                                        @php
                                                                            $accVendor = null;
                                                                            if (
                                                                                isset($data->getVendor) &&
                                                                                is_iterable($data->getVendor)
                                                                            ) {
                                                                                foreach ($data->getVendor as $gv) {
                                                                                    if (
                                                                                        (isset($gv->id) &&
                                                                                            $gv->id ==
                                                                                                $selectedVendor->id) ||
                                                                                        (isset($gv->IdVendor) &&
                                                                                            $gv->IdVendor ==
                                                                                                $selectedVendor->id)
                                                                                    ) {
                                                                                        $accVendor =
                                                                                            $gv->AccVendor ?? null;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp

                                                                        @if ($accVendor === 'Y')
                                                                            <span class="badge bg-success"
                                                                                style="margin-left: 10px;">
                                                                                <i class="fa fa-check"></i> Anda telah
                                                                                merekomendasikan vendor ini
                                                                            </span>
                                                                        @elseif (is_null($accVendor))
                                                                            <form
                                                                                action="{{ route('rekomendasi.update-rekomendasi', ['id' => $data->id, 'vendor' => $selectedVendor->id ?? '']) }}"
                                                                                method="POST" style="margin-left: 10px;">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm"
                                                                                    title="Rekomendasikan Vendor Ini">
                                                                                    <i class="fa fa-thumbs-up"></i>
                                                                                    Rekomendasikan Vendor Ini
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <h6 class="card-title fw-semibold mb-2">Informasi Vendor
                                                                </h6>
                                                                <table class="table table-bordered mb-0">
                                                                    <tr>
                                                                        <th>Nama PIC</th>
                                                                        <td>{{ $selectedVendor && $selectedVendor->NamaPic ? $selectedVendor->NamaPic : '-' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>No HP PIC</th>
                                                                        <td>{{ $selectedVendor && $selectedVendor->NoHpPic ? $selectedVendor->NoHpPic : '-' }}
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 d-flex align-items-center justify-content-center">
                                                            <img src="{{ asset('assets/img/ccp/vendor.png') }}"
                                                                class="img-fluid rounded-end object-fit-cover"
                                                                alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">

                                                <div class="col-m2 mt-2">
                                                    <label class="form-label"><strong>Surat Penawaran Vendor
                                                            {{ $vnIdx + 1 }}</strong></label>
                                                    @php
                                                        $penawaranFile = isset($vendorData)
                                                            ? $vendorData->SuratPenawaranVendor ?? null
                                                            : null;
                                                    @endphp
                                                    @if ($penawaranFile)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/penawaran_vendor/' . $penawaranFile) }}"
                                                                target="_blank" rel="noopener noreferrer"
                                                                class="btn btn-outline-secondary btn-sm">
                                                                <i class="fa fa-external-link-alt"></i> Preview Surat
                                                                Penawaran Vendor {{ $vnIdx + 1 }}
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="form-text text-muted">
                                                            Tidak ada file Surat Penawaran Vendor {{ $vnIdx + 1 }} yang
                                                            diupload.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table align-middle"
                                                id="table-detail-pengajuan-show-{{ $vnIdx }}">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Barang</th>
                                                        <th>Merek</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Satuan</th>
                                                        <th>Diskon</th>
                                                        <th>Jenis Diskon</th>
                                                        <th>Total Diskon</th>
                                                        <th>Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($vendorData) && isset($vendorData->getVendorDetail) && count($vendorData->getVendorDetail))
                                                        @foreach ($vendorData->getVendorDetail as $key => $barang)
                                                            @php
                                                                $barangMaster = $masterbarang->firstWhere(
                                                                    'id',
                                                                    $barang->NamaBarang,
                                                                );
                                                                $jumlah = $barang->Jumlah ?? 0;
                                                                $hargaSatuan = $barang->HargaSatuan ?? 0;
                                                                $diskon = $barang->Diskon ?? 0;
                                                                $jenisDiskon = $barang->JenisDiskon ?? null;
                                                                $totalBarangHarga = $jumlah * $hargaSatuan;
                                                                $nominalDiskon = 0;
                                                                if ($diskon && $jenisDiskon) {
                                                                    if (strtolower($jenisDiskon) == 'persen') {
                                                                        $nominalDiskon =
                                                                            $totalBarangHarga * ($diskon / 100);
                                                                    } else {
                                                                        $nominalDiskon = $diskon;
                                                                    }
                                                                }
                                                                $totalSetelahDiskon =
                                                                    $totalBarangHarga - $nominalDiskon;
                                                            @endphp
                                                            <tr>
                                                                <td width="5">{{ $key + 1 }}</td>
                                                                <td>
                                                                    <span>{{ $barangMaster ? $barangMaster->Nama : '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $barangMaster ? $barangMaster->getMerk->Nama : '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $jumlah }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>Rp
                                                                        {{ number_format($hargaSatuan, 0, ',', '.') }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        {{ $diskon !== null ? number_format($diskon, 0, ',', '.') : '-' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $jenisDiskon ?? '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        {{ $nominalDiskon ? number_format($nominalDiskon, 0, ',', '.') : '-' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        Rp
                                                                        {{ number_format($totalSetelahDiskon, 0, ',', '.') }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8" class="text-center">Tidak ada barang pada
                                                                vendor ini.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive mt-3">
                                            <table class="table align-middle">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-end" width="70%">Total Harga Sebelum Diskon:
                                                        </th>
                                                        <td width="10%">
                                                            Rp
                                                            {{ $totalHargaSebelumDiskonAll > 0 ? number_format($totalHargaSebelumDiskonAll, 0, ',', '.') : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Harga Setelah Diskon:</th>
                                                        <td>
                                                            Rp
                                                            {{ $totalHargaSetelahDiskonAll > 0 ? number_format($totalHargaSetelahDiskonAll, 0, ',', '.') : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Total Diskon:</th>
                                                        <td>
                                                            Rp
                                                            {{ $totalDiskonAll > 0 ? number_format($totalDiskonAll, 0, ',', '.') : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">PPN (%) :</th>
                                                        <td>
                                                            {{ $ppn > 0 ? $ppn : '-' }}%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Total PPN (All):</th>
                                                        <td>
                                                            Rp
                                                            {{ $totalPpn > 0 ? number_format($totalPpn, 0, ',', '.') : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Grand Total:</th>
                                                        <td>
                                                            Rp
                                                            {{ $grandTotal > 0 ? number_format($grandTotal, 0, ',', '.') : '-' }}
                                                        </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th class="text-end"></th>
                                                        <td>
                                                            {{ terbilang($grandTotal) }}
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- END PERBANDINGAN VENDOR --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                HTA (Health Technology Assesment)
            </div>
        </div>
        <div class="card-body">
            @php
                // AmgetHtabil data HTA dari $data->
                $listHta = $data->getHta ?? [];
                // dd($listHta);
            @endphp
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th width="10%" class="text-center">HTA / GPA</th>
                            <th width="10%" class="text-center">HTA / GPA</th>
                            <th width="10%" class="text-center">Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listHta as $key => $hta)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $hta->getNamaBarang->Nama ?? '-' }}</td>
                                <td>{{ $hta->getNamaBarang->getMerk->Nama ?? '-' }}</td>

                                @php
                                    $lastSegment = collect(request()->segments())->last();
                                    $idBarang = $hta->getNamaBarang->id ?? null;
                                @endphp

                                <td class="text-center">
                                    @if (empty($hta->getListVendorHta) || (is_countable($hta->getListVendorHta) && count($hta->getListVendorHta) == 0))
                                        <span class="badge bg-warning text-white ms-2" title="Tidak dapat mengisi HTA">
                                            <i class="fa fa-ban"></i> Belum Di Isi
                                        </span>
                                    @else
                                        <a href="{{ route($data->Jenis == '1' ? 'hta.show' : 'gpa.show', ['IdPengajuan' => $lastSegment, 'barang' => $idBarang]) }}"
                                            class="badge bg-info text-white ms-2" title="Lihat detail">
                                            <i class="fa fa-eye"></i> Lihat HTA
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $hasReview = false;
                                        if ($data->getReview && count($data->getReview) > 0) {
                                            foreach ($data->getReview as $review) {
                                                if ($review->NamaPermintaan == ($hta->IdBarang ?? null)) {
                                                    $hasReview = true;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    @if (!$hasReview)
                                        <a href="{{ route('rekomendasi.review', ['IdPengajuan' => $lastSegment, 'barang' => $idBarang]) }}"
                                            class="btn btn-primary btn-sm" title="Review">
                                            <i class="fa fa-eye"></i> Review
                                        </a>
                                    @else
                                        <a href="{{ route('rekomendasi.review', ['IdPengajuan' => $lastSegment, 'barang' => $idBarang]) }}"
                                            class="badge bg-success text-white ms-2" title="Lihat/Edit Review">
                                            <i class="fa fa-eye"></i> Lihat/Edit Review
                                        </a>
                                        <a href="{{ route('rekomendasi.cetak', ['IdPengajuan' => $lastSegment, 'barang' => $idBarang]) }}"
                                            class="badge bg-primary text-white ms-2" title="Cetak Review"
                                            target="_blank">
                                            <i class="fa fa-print"></i> Cetak
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data HTA/GPA.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                Form Usulan Investasi
            </div>
            <a href="{{ route('usulan-investasi.create', ['id' => $data->id]) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Buat Form Usulan Investasi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Departemen yang meminta/usulan investasi</th>
                            <th>Kategori usulan investasi (Pembelian)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->getFui->id ?? '-' }}</td>
                            <td>{{ $data->getFui->DepartemenMemintaId ?? '-' }}</td>
                            <td>{{ $data->getFui->KategoriUsulanPembelian ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-2">
                    <a href="{{ route('usulan-investasi.cetak', $data->id) }}" class="btn btn-info btn-sm"
                        target="_blank">
                        <i class="fa fa-print"></i> Cetak Usulan Investasi
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="co2 text-end mt-3">
        <a href="{{ route('ajukan.index') }}" class="btn btn-secondary me-2">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

        @if ($data->Status == 'Diajukan')
            <button type="button" class="btn btn-danger" id="btn-batalkan">
                <i class="fa fa-times"></i> Batalkan Pengajuan
            </button>
            <form id="form-batalkan" action="{{ route('ajukan.update-status', $data->id) }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="Status" value="Draft">
            </form>
        @elseif($data->Status == 'Draft')
            <button type="button" class="btn btn-success" id="btn-ajukan">
                <i class="fa fa-paper-plane"></i> Ajukan Ke CCP
            </button>
            <form id="form-ajukan" action="{{ route('ajukan.update-status', $data->id) }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="Status" value="Diajukan">
            </form>
            @push('js')
                <script>
                    document.getElementById('btn-ajukan').addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Konfirmasi Pengajuan',
                            text: 'Apakah Anda yakin ingin mengajukan permohonan ini? Pastikan semua dokumen tambahan telah lengkap.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, ajukan!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('form-ajukan').submit();
                            }
                        });
                    });
                </script>
            @endpush
        @endif

    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        document.getElementById('btn-batalkan').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Pembatalan',
                text: 'Apakah Anda yakin ingin membatalkan pengajuan ini? Tindakan ini dapat dikembalikan ke draft.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-batalkan').submit();
                }
            });
        });
    </script>
    @if (Session::get('success'))
        <script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    iconColor: '#4BCC1F',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#4BCC1F',
                });
            }, 500);
        </script>
    @endif
    @if (Session::get('error'))
        <script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ Session::get('error') }}',
                    iconColor: '#d33',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#d33',
                });
            }, 500);
        </script>
    @endif
@endpush
