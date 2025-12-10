@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Detail Penilaian HTA</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">HTA</a></li>
                    <li class="breadcrumb-item active">Detail Penilaian HTA</li>
                </ul>
            </div>
        </div>
        <div class="col text-end">
            <a href="javascript:window.history.back();" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Informasi Barang</h4>
                </div>
                <div class="card-body pb-2">
                    <div class="row mb-2">
                        <div class="col-md-2 fw-bold">Kode Barang</div>
                        <div class="col-md-4">: {{ $dataBarang?->KodeBarang ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2 fw-bold">Nama Barang</div>
                        <div class="col-md-4">: {{ $dataBarang?->Nama ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2 fw-bold">Merek</div>
                        <div class="col-md-2">: {{ $dataBarang?->getMerk?->Nama ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        HTA (Health Technology Assessment)
                    </div>
                </div>
                <div class="card-body">
                    <!-- Card informasi simpan sementara rekomendasi vendor -->
                    <div class="alert alert-warning mb-4">
                        <strong>Informasi:</strong> Silakan klik <span class="fw-bold">"Simpan Rekomendasi"</span> setelah
                        mengisi data setiap vendor. Data yang sudah disimpan akan tetap tersimpan dan dapat diedit kembali
                        sebelum proses finalisasi. Pastikan Anda menekan tombol simpan untuk setiap vendor <span
                            class="text-primary">sebelum meninggalkan halaman ini atau beralih ke vendor lain</span> agar
                        data tidak hilang.
                    </div>
                    <ul class="nav nav-tabs tab-style-1 d-sm-flex d-block mb-3" id="vendorTab" role="tablist">
                        @foreach ($data->getListVendorHta as $vnIdx => $listVendorHta)
                            <li class="nav-item">
                                <a class="nav-link @if ($loop->first) active @endif"
                                    id="vendor{{ $vnIdx }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#vendor{{ $vnIdx }}" href="#vendor{{ $vnIdx }}"
                                    role="tab" aria-controls="vendor{{ $vnIdx }}"
                                    @if ($loop->first) aria-selected="true" @else aria-selected="false" @endif>
                                    {{ $listVendorHta->getNamaVendor->Nama ?? 'Vendor' . ($vnIdx + 1) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="vendorTabContent">
                        @foreach ($data->getListVendorHta as $vnIdx => $listVendorHta)
                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                id="vendor{{ $vnIdx }}" role="tabpanel"
                                aria-labelledby="vendor{{ $vnIdx }}-tab">
                                <div class="mb-3">
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-md-2 fw-bold">Nama Vendor</div>
                                        <div class="col-md-10">
                                            : {{ $listVendorHta->getNamaVendor->Nama ?? '-' }}
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-md-2 fw-bold">Alamat</div>
                                        <div class="col-md-10">
                                            : {{ $listVendorHta->getNamaVendor->Alamat ?? '-' }}
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-md-2 fw-bold">Email</div>
                                        <div class="col-md-10">
                                            : {{ $listVendorHta->getNamaVendor->Email ?? '-' }}
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-md-2 fw-bold">Telepon</div>
                                        <div class="col-md-10">
                                            : {{ $listVendorHta->getNamaVendor->Telepon ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                                {{-- Form store per-tab --}}
                                <form action="{{ route('rekomendasi.store') }}" method="POST"
                                    enctype="multipart/form-data" class="form-store-rekomendasi">
                                    @csrf
                                    <input type="hidden" name="IdVendor" value="{{ $listVendorHta->IdVendor ?? '' }}">
                                    <input type="hidden" name="IdHtaGpa" value="{{ $listVendorHta->IdHtaGpa ?? '' }}">
                                    <input type="hidden" name="IdPengajuan" value="{{ $IdPengajuanBarang ?? '' }}">
                                    <table class="table align-middle" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:18%;">Kriteria / Parameter</th>
                                                <th>Deskripsi Penilaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Rekomendasi</td>
                                                <td>
                                                    <select class="form-control" name="Rekomendasi">
                                                        <option value="">-- Pilih Rekomendasi --</option>
                                                        <option value="1"
                                                            {{ old('Rekomendasi', $listVendorHta->Rekomendasi ?? '') == '1' ? 'selected' : '' }}>
                                                            Rekomendasi 1</option>
                                                        <option value="2"
                                                            {{ old('Rekomendasi', $listVendorHta->Rekomendasi ?? '') == '2' ? 'selected' : '' }}>
                                                            Rekomendasi 2</option>
                                                        <option value="3"
                                                            {{ old('Rekomendasi', $listVendorHta->Rekomendasi ?? '') == '3' ? 'selected' : '' }}>
                                                            Rekomendasi 3</option>
                                                    </select>
                                                    @error('Rekomendasi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Permintaan</td>
                                                <td>
                                                    <select class="form-control" name="NamaPermintaan">
                                                        <option value="{{ $dataBarang?->id ?? '-' }}">
                                                            {{ $dataBarang?->Nama ?? '-' }}
                                                        </option>
                                                    </select>
                                                    @error('NamaPermintaan')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Awal</td>
                                                <td>
                                                    @php
                                                        $hargaAwal = old('HargaAwal');

                                                        // Ambil harga dari HTA, parameter == 3
                                                        if ($hargaAwal === null) {
                                                            $hargaAwal = '';
                                                            if (
                                                                isset($listVendorHta->getDetailListVendorHtaGpa) &&
                                                                is_iterable($listVendorHta->getDetailListVendorHtaGpa)
                                                            ) {
                                                                foreach (
                                                                    $listVendorHta->getDetailListVendorHtaGpa
                                                                    as $detail
                                                                ) {
                                                                    if (
                                                                        isset($detail->Parameter) &&
                                                                        $detail->Parameter == 3
                                                                    ) {
                                                                        // diasumsikan field harga berada di Deskripsi
                                                                        $hargaAwal = $detail->Deskripsi ?? '';
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <input type="text" class="form-control rupiah" name="HargaAwal"
                                                        placeholder="Masukkan Harga Awal"
                                                        value="{{ old('HargaAwal', is_numeric($hargaAwal) ? number_format($hargaAwal, 0, ',', '.') : $hargaAwal) }}">
                                                    @error('HargaAwal')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Negosiasi</td>
                                                <td>
                                                    <input type="text" class="form-control rupiah" name="HargaNego"
                                                        placeholder="Masukkan Harga Nego"
                                                        value="{{ old('HargaNego', isset($listVendorHta->HargaNego) ? number_format($listVendorHta->HargaNego, 0, ',', '.') : '') }}">
                                                    @error('HargaNego')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Spesifikasi</td>
                                                <td>
                                                    @php
                                                        $spesifikasi = old('Spesifikasi');

                                                        if ($spesifikasi === null) {
                                                            $spesifikasi = '';
                                                            if (
                                                                isset($listVendorHta->getDetailListVendorHtaGpa) &&
                                                                is_iterable($listVendorHta->getDetailListVendorHtaGpa)
                                                            ) {
                                                                foreach (
                                                                    $listVendorHta->getDetailListVendorHtaGpa
                                                                    as $detail
                                                                ) {
                                                                    if (
                                                                        isset($detail->Parameter) &&
                                                                        $detail->Parameter == 2
                                                                    ) {
                                                                        $spesifikasi = $detail->Deskripsi ?? '';
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <textarea class="form-control" name="Spesifikasi" rows="4"
                                                        style="background-color: #ffffff; min-height:500px;">{{ strip_tags(old('Spesifikasi', $spesifikasi)) }}</textarea>
                                                    @error('Spesifikasi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Negara Produksi</td>
                                                <td>
                                                    <input type="text" class="form-control" name="NegaraProduksi"
                                                        placeholder="Masukkan Negara Produksi"
                                                        value="{{ old('NegaraProduksi', $listVendorHta->NegaraProduksi ?? '') }}">
                                                    @error('NegaraProduksi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Garansi</td>
                                                <td>
                                                    <input type="text" class="form-control" name="Garansi"
                                                        placeholder="Masukkan Garansi"
                                                        value="{{ old('Garansi', $listVendorHta->Garansi ?? '') }}">
                                                    @error('Garansi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Teknisi</td>
                                                <td>
                                                    <input type="text" class="form-control" name="Teknisi"
                                                        placeholder="Masukkan Teknisi"
                                                        value="{{ old('Teknisi', $listVendorHta->Teknisi ?? '') }}">
                                                    @error('Teknisi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>BMHP</td>
                                                <td>
                                                    <input type="text" class="form-control" name="Bmhp"
                                                        placeholder="Masukkan BMHP"
                                                        value="{{ old('Bmhp', $listVendorHta->Bmhp ?? '') }}">
                                                    @error('Bmhp')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Spare Part</td>
                                                <td>
                                                    <input type="text" class="form-control" name="SparePart"
                                                        placeholder="Masukkan Spare Part"
                                                        value="{{ old('SparePart', $listVendorHta->SparePart ?? '') }}">
                                                    @error('SparePart')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Backup Unit</td>
                                                <td>
                                                    <input type="text" class="form-control" name="BackupUnit"
                                                        placeholder="Masukkan Backup Unit"
                                                        value="{{ old('BackupUnit', $listVendorHta->BackupUnit ?? '') }}">
                                                    @error('BackupUnit')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TOP</td>
                                                <td>
                                                    <input type="text" class="form-control" name="Top"
                                                        placeholder="Masukkan TOP"
                                                        value="{{ old('Top', $listVendorHta->Top ?? '') }}">
                                                    @error('Top')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            {{-- Catatan: Kolom "Rekomendasi" sudah ada di atas --}}
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>
                                                    <textarea class="form-control" name="Keterangan" placeholder="Masukkan Keterangan">{{ old('Keterangan', $listVendorHta->Keterangan ?? '') }}</textarea>
                                                    @error('Keterangan')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Presentasi</td>
                                                <td>
                                                    <input type="date" class="form-control" name="TanggalPresentasi"
                                                        value="{{ old('TanggalPresentasi', isset($listVendorHta->TanggalPresentasi) ? \Carbon\Carbon::parse($listVendorHta->TanggalPresentasi)->format('Y-m-d') : '') }}"
                                                        placeholder="Pilih Tanggal Presentasi">
                                                    @error('TanggalPresentasi')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan Rekomendasi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @if (Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get('success') }}',
                iconColor: '#4BCC1F',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#4BCC1F',
            });
        </script>
    @endif
    @if (Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get('success') }}',
                iconColor: '#4BCC1F',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#4BCC1F',
            });
        </script>
    @endif

    @if (Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ Session::get('error') }}',
                iconColor: '#F44336',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#F44336',
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? prefix + ' ' + rupiah : '');
            }

            document.querySelectorAll('.rupiah').forEach(function(input) {
                input.addEventListener('input', function(e) {
                    let caret = input.selectionStart;
                    let value = input.value;
                    let plainNumber = value.replace(/[^,\d]/g, '');

                    // format and set value
                    input.value = formatRupiah(plainNumber, 'Rp');

                    // attempt to restore cursor position
                    setTimeout(() => {
                        input.setSelectionRange(input.value.length, input.value.length);
                    }, 0);
                });

                // On focus, remove 'Rp ' prefix for easier editing. Optional.
                input.addEventListener('focus', function(e) {
                    input.value = input.value.replace(/^Rp\s?/, '');
                });

                // On blur, re-add 'Rp ' prefix
                input.addEventListener('blur', function(e) {
                    if (input.value !== '') {
                        let plainNumber = input.value.replace(/[^,\d]/g, '');
                        input.value = formatRupiah(plainNumber, 'Rp');
                    }
                });
            });
        });
    </script>
@endpush
