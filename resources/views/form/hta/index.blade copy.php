@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xxl-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Tab Style-1
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs tab-style-1 d-sm-flex d-block" role="tablist">
                        @foreach ($data->getVendor as $key => $listvendor)
                            <li class="nav-item">
                                <a class="nav-link @if ($key == 0) active @endif" data-bs-toggle="tab"
                                    data-bs-target="#vendor{{ $key }}" href="#vendor{{ $key }}"
                                    role="tab"
                                    aria-selected="@if ($key == 0) true @else false @endif">
                                    Vendor {{ $key + 1 }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($data->getVendor as $key => $listvendor)
                            <div class="tab-pane fade @if ($key == 0) show active @endif"
                                id="vendor{{ $key }}" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border mb-3">
                                            <div class="card-header p-2 bg-light">
                                                <strong>Informasi Vendor</strong>
                                            </div>
                                            <div class="card-body p-2">
                                                <b>{{ $listvendor->NamaVendor ?? 'Vendor ' . ($key + 1) }}</b><br>
                                                Alamat: {{ $listvendor->AlamatVendor ?? '-' }} <br>
                                                PIC: {{ $listvendor->PIC ?? '-' }} <br>
                                                Telp: {{ $listvendor->Telp ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border mb-3">
                                            <div class="card-header p-2 bg-light">
                                                <strong>Informasi Barang</strong>
                                            </div>
                                            <div class="card-body p-2">
                                                <table class="table table-borderless mb-0">
                                                    <tr>
                                                        <th style="width:120px;">Nama Barang</th>
                                                        <td>: <span
                                                                class="fw-semibold">{{ $listvendor->NamaBarang ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Merk</th>
                                                        <td>: <span
                                                                class="fw-semibold">{{ $listvendor->Merk ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spesifikasi</th>
                                                        <td>: <span
                                                                class="fw-semibold">{{ $listvendor->Spesifikasi ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jumlah</th>
                                                        <td>: <span
                                                                class="fw-semibold">{{ $listvendor->Jumlah ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Analisa HTA - Kriteria Penilaian
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-4">
                                <div class="card border">
                                    <div class="card-header p-2 bg-light">
                                        <strong>Barang {{ $i }}</strong>
                                    </div>
                                    <div class="card-body p-2">
                                        <h6 class="mb-3"><i class="feather-box me-1"></i> Informasi Barang</h6>
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <th style="width:120px;">Nama Barang</th>
                                                <td>: <span class="fw-semibold">
                                                        @if ($i == 1)
                                                            Infusion Pump XYZ
                                                        @elseif($i == 2)
                                                            Infusion Pump ABC
                                                        @else
                                                            Infusion Pump DEF
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Merk</th>
                                                <td>: <span class="fw-semibold">
                                                        @if ($i == 1)
                                                            Meditech 1000
                                                        @elseif($i == 2)
                                                            HealthPro 500
                                                        @else
                                                            Lifetech X
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Vendor</th>
                                                <td>: <span class="fw-semibold">
                                                        @if ($i == 1)
                                                            PT Alpha Medika
                                                        @elseif($i == 2)
                                                            PT Beta Medis
                                                        @else
                                                            PT Gamma Health
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    @php
                        // Ambil last segment dari URL sebagai parameter id (misal hta/123 -> 123)
                        $id = request()->segment(count(request()->segments()));
                    @endphp
                    <form method="POST" action="{{ route('hta.store', $id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="IdPengajuanDetail">

                        @php
                            $aspects = [
                                'Supplier',
                                'Spesifikasi',
                                'Populasi',
                                'Keamanan Pasien',
                                'Keamanan Petugas',
                                'Mudah Digunakan',
                                'Laporan Insiden Re/Under Call',
                                'Rekom. Klinis',
                                'Perawatan Pasca Beli',
                                'Fitur Khusus Emergency',
                                'Harga',
                                'BHP',
                                'Garansi',
                            ];
                        @endphp
                        @foreach ($aspects as $idx => $aspect)
                            <input type="hidden" name="Parameter[{{ $idx }}]" value="{{ $aspect }}">
                        @endforeach

                        <table class="table table-striped table-sm align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:5%;">Perbandingan</th>
                                    <th style="width:100%;">Vendor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aspects as $key => $aspect)
                                    <tr>
                                        <td>
                                            <span class="form-label fw-bold mb-0 d-block">{{ $aspect }}</span>
                                        </td>
                                        <td>
                                            <div class="row">
                                                @for ($vendor = 1; $vendor <= 3; $vendor++)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="card border">
                                                            <div class="card-header py-2 bg-light">
                                                                <strong>Vendor {{ $vendor }}</strong>
                                                            </div>
                                                            <div class="card-body py-2">
                                                                <textarea class="form-control mb-2" id="param_{{ $key }}_vendor{{ $vendor }}"
                                                                    name="data[{{ $key }}][vendor{{ $vendor }}][desc]" rows="5"
                                                                    placeholder="Deskripsi Vendor {{ $vendor }}"></textarea>
                                                                <div class="alert alert-info py-1 px-2 mb-1"
                                                                    style="font-size: 0.9em;">
                                                                    <em>Isi dengan angka pada kolom score, hanya boleh angka
                                                                        1-5.</em>
                                                                </div>
                                                                <div class="mb-2">
                                                                    @for ($person = 1; $person <= 5; $person++)
                                                                        <input type="number"
                                                                            name="data[{{ $key }}][vendor{{ $vendor }}][person{{ $person }}]"
                                                                            id="param_{{ $key }}_vendor{{ $vendor }}_person{{ $person }}"
                                                                            min="1" max="5"
                                                                            class="form-control mb-1 score-input"
                                                                            placeholder="Nilai {{ $person }}"
                                                                            style="width: 75px; display: inline-block;">
                                                                    @endfor
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label
                                                                        for="Score_param_{{ $key }}_vendor{{ $vendor }}">Total
                                                                        Score:</label>
                                                                    <input type="number" readonly
                                                                        class="form-control mt-1 total-score"
                                                                        id="Score_param_{{ $key }}_vendor{{ $vendor }}"
                                                                        name="data[{{ $key }}][vendor{{ $vendor }}][score]"
                                                                        placeholder="Score Vendor {{ $vendor }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- Row Akumulasi Total Score Setiap Vendor --}}
                                <tr>
                                    <td>
                                        <span class="fw-bold">Akumulasi Total Score</span>
                                    </td>
                                    <td>
                                        <div class="row">
                                            @for ($vendor = 1; $vendor <= 3; $vendor++)
                                                <div class="col-md-4 mb-2">
                                                    <div class="card border">
                                                        <div class="card-header py-2 bg-secondary text-white">
                                                            <strong>Total Vendor {{ $vendor }}</strong>
                                                        </div>
                                                        <div class="card-body py-2">
                                                            <input type="number" readonly
                                                                class="form-control bg-light fw-bold total-vendor-score"
                                                                id="TotalScore_vendor{{ $vendor }}"
                                                                name="TotalScore_vendor{{ $vendor }}"
                                                                placeholder="Total Score Vendor {{ $vendor }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                @endsection
                @push('js')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Helper function to do slugify: matches your input IDs!
                            function slugify(str) {
                                return String(str)
                                    .toString()
                                    .replace(/\s+/g, '_')
                                    .replace(/[^\w\-]+/g, '')
                                    .replace(/\-\-+/g, '_')
                                    .replace(/^-+/, '')
                                    .replace(/-+$/, '');
                            }

                            // Build aspects variables
                            let aspects = @json($aspects);
                            let vendorMax = 3,
                                personMax = 5;

                            // For each input, handle keyup/change event, update total and akumulasi
                            aspects.forEach(function(aspect, aspectIdx) {
                                let aspectSlug = slugify(aspect);
                                for (let vendor = 1; vendor <= vendorMax; vendor++) {
                                    for (let person = 1; person <= personMax; person++) {
                                        let inpId = `param_${aspectIdx}_vendor${vendor}_person${person}`;
                                        let inp = document.getElementById(inpId);
                                        if (inp) {
                                            inp.addEventListener('input', function() {
                                                // Clean value
                                                let val = this.value.replace(/[^0-9]/g, '');
                                                let num = parseInt(val);
                                                if (isNaN(num) || num < 1) num = '';
                                                if (num > 5) num = 5;
                                                this.value = num;

                                                // Update total score for this aspect/vendor
                                                updateTotalScore(aspectIdx, vendor);

                                                // Update total akumulasi for all vendors
                                                for (let v = 1; v <= vendorMax; v++) {
                                                    updateVendorTotal(v);
                                                }
                                            });
                                        }
                                    }
                                }
                            });

                            function updateTotalScore(aspectIdx, vendor) {
                                let total = 0;
                                for (let person = 1; person <= personMax; person++) {
                                    let inp = document.getElementById(`param_${aspectIdx}_vendor${vendor}_person${person}`);
                                    let v = parseInt(inp && inp.value ? inp.value : 0, 10);
                                    if (!isNaN(v) && v >= 1 && v <= 5) {
                                        total += v;
                                    }
                                }
                                let totalScoreField = document.getElementById(`Score_param_${aspectIdx}_vendor${vendor}`);
                                if (totalScoreField) {
                                    totalScoreField.value = total;
                                }
                            }

                            function updateVendorTotal(vendor) {
                                let grandTotal = 0;
                                aspects.forEach(function(_aspect, aspectIdx) {
                                    let aspectTotalField = document.getElementById(
                                        `Score_param_${aspectIdx}_vendor${vendor}`);
                                    let t = parseInt(aspectTotalField && aspectTotalField.value ? aspectTotalField.value :
                                        0, 10);
                                    if (!isNaN(t)) {
                                        grandTotal += t;
                                    }
                                });
                                let vendorTotalField = document.getElementById(`TotalScore_vendor${vendor}`);
                                if (vendorTotalField) {
                                    vendorTotalField.value = grandTotal;
                                }
                            }

                            // Initialize all total scores & akumulasi in case of browser autofill or page reload
                            aspects.forEach(function(_aspect, aspectIdx) {
                                for (let vendor = 1; vendor <= vendorMax; vendor++) {
                                    updateTotalScore(aspectIdx, vendor);
                                }
                            });
                            for (let vendor = 1; vendor <= vendorMax; vendor++) {
                                updateVendorTotal(vendor);
                            }
                        });
                    </script>
                    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
                @endpush
