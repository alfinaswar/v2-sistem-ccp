@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Permintaan Pembelian</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pp.index') }}">Permintaan Pembelian</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Permintaan Pembelian</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('pp.store') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-header bg-dark">
                        <h4 class="card-title mb-0">Formulir Permintaan Pembelian</h4>
                        <p class="card-text mb-0">
                            Silakan isi data permintaan pembelian di bawah ini.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="departemen" class="form-label"><strong>Departemen / Divisi</strong></label>
                                <select name="Departemen" id="departemen"
                                    class="form-control select2 @error('Departemen') is-invalid @enderror">
                                    <option value="">Pilih Departemen</option>
                                    @foreach ($departemen ?? [] as $d)
                                        <option value="{{ $d->id }}"
                                            {{ old('Departemen') == $d->id ? 'selected' : '' }}>
                                            {{ $d->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Departemen')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label"><strong>Tanggal</strong></label>
                                <input type="date" name="Tanggal" id="tanggal"
                                    class="form-control @error('Tanggal') is-invalid @enderror"
                                    value="{{ old('Tanggal', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                                @error('Tanggal')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jenis" class="form-label"><strong>Jenis Permintaan</strong></label>
                                <select name="Jenis" id="jenis"
                                    class="form-control @error('Jenis') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Permintaan</option>
                                    @foreach ($jenisPengajuan as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ old('Jenis') == $jenis->id ? 'selected' : '' }}>{{ $jenis->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Jenis')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tujuan" class="form-label"><strong>Tujuan</strong></label>
                                <select name="Tujuan" id="tujuan"
                                    class="form-control @error('Tujuan') is-invalid @enderror" required>
                                    <option value="">Pilih Tujuan</option>
                                    <option value="Pembelian Baru"
                                        {{ old('Tujuan') == 'Pembelian Baru' ? 'selected' : '' }}>Pembelian Baru</option>
                                    <option value="Penggantian" {{ old('Tujuan') == 'Penggantian' ? 'selected' : '' }}>
                                        Penggantian</option>
                                    <option value="Perbaikan" {{ old('Tujuan') == 'Perbaikan' ? 'selected' : '' }}>
                                        Perbaikan</option>
                                </select>
                                @error('Tujuan')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mb-3"><strong>Detail Permintaan Pembelian</strong></h5>
                        <p class="mb-3">
                            Tambahkan barang yang ingin diminta pembeliannya.
                        </p>
                        <div class="table-responsive">
                            <table class="table align-middle" id="table-detail-pembelian">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 25%">Nama Barang</th>
                                        <th style="width: 15%">Jumlah</th>
                                        <th style="width: 15%">Satuan</th>
                                        <th style="width: 25%">Rencana Penempatan</th>
                                        <th style="width: 20%">Keterangan</th>
                                        <th style="width: 8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Ambil old detail jika ada validasi gagal
                                        $oldBarang = old('NamaBarang', []);
                                        $oldJumlah = old('Jumlah', []);
                                        $oldSatuan = old('Satuan', []);
                                        $oldPenempatan = old('RencanaPenempatan', []);
                                        $oldKeterangan = old('Keterangan', []);
                                        $rows = max(
                                            1,
                                            max(
                                                count($oldBarang),
                                                count($oldJumlah),
                                                count($oldSatuan),
                                                count($oldPenempatan),
                                                count($oldKeterangan),
                                            ),
                                        );
                                    @endphp
                                    @for ($i = 0; $i < $rows; $i++)
                                        <tr>
                                            <td>
                                                <select name="NamaBarang[]" class="form-control select2" required>
                                                    <option value="">Pilih Barang</option>
                                                    @foreach ($barang ?? [] as $b)
                                                        <option value="{{ $b->id }}"
                                                            data-jenis="{{ $b->Jenis }}"
                                                            {{ isset($oldBarang[$i]) && $oldBarang[$i] == $b->id ? 'selected' : '' }}>
                                                            {{ $b->Nama }} - {{ $b->getMerk->Nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="Jumlah[]" class="form-control jumlah-input"
                                                    min="1" value="{{ isset($oldJumlah[$i]) ? $oldJumlah[$i] : 1 }}"
                                                    required>
                                            </td>
                                            <td>
                                                <select name="Satuan[]" class="select2" required>
                                                    <option value="">Pilih Satuan</option>
                                                    @foreach ($satuan ?? [] as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ isset($oldSatuan[$i]) && $oldSatuan[$i] == $s->id ? 'selected' : '' }}>
                                                            {{ $s->NamaSatuan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="RencanaPenempatan[]" class="form-control"
                                                    placeholder="Misal: Gudang A"
                                                    value="{{ isset($oldPenempatan[$i]) ? $oldPenempatan[$i] : '' }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="Keterangan[]" class="form-control"
                                                    placeholder="Keterangan tambahan"
                                                    value="{{ isset($oldKeterangan[$i]) ? $oldKeterangan[$i] : '' }}">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm btn-remove-row"
                                                    {{ $rows == 1 ? 'disabled' : '' }}>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-success btn-sm" id="btn-tambah-baris">
                                                <i class="fa fa-plus"></i> Tambah Baris
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <strong style="font-size: 1rem;">
                                                Total Jumlah: <span id="total-jumlah-view" style="font-size: 1rem;">
                                                    {{ array_sum(old('Jumlah', [1])) }}
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <a href="{{ route('pp.index') }}" class="btn btn-secondary me-2">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script>
        // Fungsi duplikasi baris dan hapus baris

        function updateTotalJumlah() {
            let total = 0;
            $('#table-detail-pembelian tbody .jumlah-input').each(function() {
                let val = parseInt($(this).val());
                if (!isNaN(val)) total += val;
            });
            $('#total-jumlah-view').text(total);
        }

        function getBarangOptions(filterJenis) {
            let barang = @json($barang ?? []);
            let html = `<option value="">Pilih Barang</option>`;
            barang.forEach(function(b) {
                // Field b.Jenis is now expected "MEDIS" or "UMUM"
                if (!filterJenis || b.Jenis === filterJenis) {
                    let merkNama = (b.get_merk && b.get_merk.Nama) ? b.get_merk.Nama : '';
                    html +=
                        `<option value="${b.id}" data-jenis="${b.Jenis}">${b.Nama} - ${merkNama}</option>`;
                }
            });
            return html;
        }

        $(document).ready(function() {
            // Fungsi untuk mengaktifkan/destroy select2 jika diperlukan
            function initSelect2(row) {
                if ($.fn.select2) {
                    $(row).find('select.select2').select2({
                        width: "100%"
                    });
                }
            }

            // Dapatkan id jenisPengajuan untuk MEDIS & UMUM
            let jenisPengajuanArr = @json($jenisPengajuan ?? []);
            let jenisMedisPengajuan = null;
            let jenisUmumPengajuan = null;
            jenisPengajuanArr.forEach(j => {
                const namaLower = (j.Nama || '').toLowerCase();
                if (namaLower.indexOf('medis') !== -1) jenisMedisPengajuan = j.id;
                if (namaLower.indexOf('umum') !== -1) jenisUmumPengajuan = j.id;
            });

            // Konstanta Jenis Barang
            const JENIS_MEDIS = "MEDIS";
            const JENIS_UMUM = "UMUM";

            // Fungsi untuk filter barang berdasarkan Jenis medis atau umum
            function filterBarangSelects(filterJenis) {
                $('#table-detail-pembelian tbody tr').each(function() {
                    let $select = $(this).find('select[name="NamaBarang[]"]');
                    let currentVal = $select.val();
                    let html = getBarangOptions(filterJenis);
                    $select.html(html);
                    if (currentVal && $select.find(`option[value="${currentVal}"]`).length) {
                        $select.val(currentVal).trigger('change');
                    } else {
                        $select.val('').trigger('change');
                    }
                });
            }

            // Siapkan template baris, delegasikan old[] agar default saat tambah baris
            function generateRowTemplate(filterJenis = null) {
                let options = getBarangOptions(filterJenis);
                let satuanOptions = `@foreach ($satuan ?? [] as $s)
                    <option value="{{ $s->id }}">{{ $s->NamaSatuan }}</option>
                @endforeach`;
                return `
                <tr>
                    <td>
                        <select name="NamaBarang[]" class="form-control select2" required>
                            ${options}
                        </select>
                    </td>
                    <td>
                        <input type="number" name="Jumlah[]" class="form-control jumlah-input" min="1" value="1" required>
                    </td>
                    <td>
                        <select name="Satuan[]" class="select2" required>
                            <option value="">Pilih Satuan</option>
                            ${satuanOptions}
                        </select>
                    </td>
                    <td>
                        <input type="text" name="RencanaPenempatan[]" class="form-control" placeholder="Misal: Gudang A" required>
                    </td>
                    <td>
                        <input type="text" name="Keterangan[]" class="form-control" placeholder="Keterangan tambahan">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                `;
            }

            // Inisialisasi filter awal
            let currentFilterJenis = null;

            // Saat Jenis diubah, filter dropdown barang
            $('#jenis').on('change', function() {
                let selectedJenis = $(this).val();
                if (
                    selectedJenis &&
                    typeof jenisMedisPengajuan !== 'undefined' && jenisMedisPengajuan &&
                    String(selectedJenis) === String(jenisMedisPengajuan)
                ) {
                    currentFilterJenis = JENIS_MEDIS;
                } else if (
                    selectedJenis &&
                    typeof jenisUmumPengajuan !== 'undefined' && jenisUmumPengajuan &&
                    String(selectedJenis) === String(jenisUmumPengajuan)
                ) {
                    currentFilterJenis = JENIS_UMUM;
                } else {
                    currentFilterJenis = null; // null = tampilkan semua
                }
                filterBarangSelects(currentFilterJenis);
            });

            // Initial load (jika old selected Jenis)
            if ($('#jenis').val()) {
                if (
                    typeof jenisMedisPengajuan !== 'undefined' && jenisMedisPengajuan &&
                    String($('#jenis').val()) === String(jenisMedisPengajuan)
                ) {
                    currentFilterJenis = JENIS_MEDIS;
                } else if (
                    typeof jenisUmumPengajuan !== 'undefined' && jenisUmumPengajuan &&
                    String($('#jenis').val()) === String(jenisUmumPengajuan)
                ) {
                    currentFilterJenis = JENIS_UMUM;
                } else {
                    currentFilterJenis = null;
                }
                filterBarangSelects(currentFilterJenis);
            }

            // Default template baris (nullable filter)
            let rowTemplate = generateRowTemplate(currentFilterJenis);

            // Tambah baris baru
            $('#btn-tambah-baris').on('click', function() {
                let $tbody = $('#table-detail-pembelian tbody');
                // Generate ulang row sesuai filter
                let row = $(generateRowTemplate(currentFilterJenis));
                $tbody.append(row);
                // Inisialisasi select2 jika digunakan
                initSelect2(row);

                // Pastikan tombol hapus di-enable jika lebih dari satu baris
                updateRemoveButtons();
                updateTotalJumlah();
            });

            // Hapus baris
            $('#table-detail-pembelian').on('click', '.btn-remove-row', function() {
                let rowCount = $('#table-detail-pembelian tbody tr').length;
                if (rowCount > 1) {
                    $(this).closest('tr').remove();
                    updateRemoveButtons();
                    updateTotalJumlah();
                }
            });

            // Disable tombol hapus jika hanya ada satu baris
            function updateRemoveButtons() {
                let $rows = $('#table-detail-pembelian tbody tr');
                if ($rows.length === 1) {
                    $rows.find('.btn-remove-row').attr('disabled', true);
                } else {
                    $rows.find('.btn-remove-row').removeAttr('disabled');
                }
            }

            // Jalankan saat load
            updateRemoveButtons();

            // Inisialisasi awal select2 jika ada
            initSelect2($('#table-detail-pembelian tbody tr'));

            // Filter barang kalau 'Jenis' sudah terisi saat reload
            filterBarangSelects(currentFilterJenis);

            // Recalculate total-jumlah jika ada perubahan pada input jumlah
            $('#table-detail-pembelian').on('input change', '.jumlah-input', function() {
                updateTotalJumlah();
            });

            // Hitung initial total jumlah saat reload
            updateTotalJumlah();
        });
    </script>
@endpush
