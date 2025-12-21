          @push('css')
              <style>
                  /* Style untuk SweetAlert Loading */
                  .swal2-popup {
                      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                      z-index: 1000000 !important;
                  }

                  .swal2-container {
                      z-index: 1000000 !important;
                  }

                  .swal2-html-container b {
                      color: #3085d6;
                      font-weight: 600;
                  }

                  #loading-overlay {
                      position: fixed !important;
                      top: 0 !important;
                      left: 0 !important;
                      width: 100% !important;
                      height: 100% !important;
                      z-index: 999999 !important;
                      cursor: not-allowed !important;
                      background: rgba(0, 0, 0, 0.5) !important;
                      pointer-events: all !important;
                  }

                  body.loading-active {
                      user-select: none !important;
                      -webkit-user-select: none !important;
                      -moz-user-select: none !important;
                      -ms-user-select: none !important;
                      overflow: hidden !important;
                  }

                  .swal2-loading .swal2-icon {
                      animation: swal2-rotate-loading 1.5s linear infinite;
                  }

                  @keyframes swal2-rotate-loading {
                      0% {
                          transform: rotate(0deg);
                      }

                      100% {
                          transform: rotate(360deg);
                      }
                  }

                  .swal2-html-container strong {
                      font-size: 14px;
                      animation: blink-warning 1.5s infinite;
                  }

                  @keyframes blink-warning {

                      0%,
                      100% {
                          opacity: 1;
                      }

                      50% {
                          opacity: 0.5;
                      }
                  }

                  .swal2-html-container small {
                      display: block;
                      margin-top: 10px;
                      color: #666;
                      font-size: 13px;
                  }

                  #timer-counter {
                      color: #3085d6;
                      font-weight: bold;
                      font-size: 14px;
                  }
              </style>
          @endpush
          <div class="modal fade" id="modalPenilai" tabindex="-1" aria-labelledby="modalPenilaiLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="modalPenilaiLabel">Permintaan ini Akan dikirim Ke</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form id="formPenilai" method="POST" action="{{ route('pp.update', $data->id) }}">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="IdPengajuan" value="{{ $data->id }}">
                          <div class="modal-body">
                              <div class="alert alert-info mb-4" role="alert">
                                  <strong>Perhatian:</strong>
                                  <ol class="mb-0 ps-4">
                                      <li>Pastikan memilih user, jabatan, dan departemendengan benar.</li>
                                      <li>Email akan digunakan untuk pengiriman notifikasi ke pihak atau departemen
                                          terkait.</li>
                                  </ol>
                              </div>
                              <div class="table-responsive">
                                  <table class="table align-middle" style="width:100%;">
                                      <thead class="table-light">
                                          <tr>
                                              <th style="width:90px;">Urutan</th>
                                              <th>Nama</th>
                                              <th>Email</th>
                                              <th>Jabatan</th>
                                              <th>Departemen</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @php
                                              $approvalCount = count($approval);
                                              $userLogin = auth()->user();
                                          @endphp
                                          @forelse($approval as $key => $app)
                                              <tr>
                                                  <td>Urutan {{ $key + 1 }}</td>
                                                  <td>
                                                      @if ($key == 0)
                                                          <!-- Urutan 1 ambil dari session login, tidak readonly/disabled -->
                                                          <select class="form-control select2 user-penilai-select"
                                                              name="UserId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              @foreach ($user as $usr)
                                                                  <option
                                                                      value="{{ $usr->id }}|{{ $usr->name }}"
                                                                      data-email="{{ $usr->email }}"
                                                                      data-jabatanid="{{ $usr->jabatan ?? '' }}"
                                                                      data-departemenid="{{ $usr->departemen ?? '' }}"
                                                                      {{ $userLogin->id == $usr->id ? 'selected' : '' }}>
                                                                      {{ $usr->name }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @else
                                                          <select class="form-control select2 user-penilai-select"
                                                              name="UserId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              <option value="">Pilih User</option>
                                                              @foreach ($user as $usr)
                                                                  <option
                                                                      value="{{ $usr->id }}|{{ $usr->name }}"
                                                                      data-email="{{ $usr->email }}"
                                                                      data-jabatanid="{{ $usr->jabatan ?? '' }}"
                                                                      data-departemenid="{{ $usr->departemen ?? '' }}"
                                                                      {{ isset($app->UserId) && $app->UserId == $usr->id ? 'selected' : '' }}>
                                                                      {{ $usr->name }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if ($key == 0)
                                                          <input type="email" class="form-control email-penilai-input"
                                                              name="Email[]" value="{{ $userLogin->email }}"
                                                              data-row-index="{{ $key }}">
                                                      @else
                                                          <input type="email" class="form-control email-penilai-input"
                                                              name="Email[]"
                                                              value="{{ $app->Email ?? ($app->getUser->email ?? '') }}"
                                                              data-row-index="{{ $key }}">
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if ($key == 0)
                                                          <select class="form-control jabatan-penilai-select"
                                                              name="JabatanId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              @foreach ($jabatan as $jab)
                                                                  <option value="{{ $jab->id }}"
                                                                      {{ $userLogin->jabatan == $jab->id ? 'selected' : '' }}>
                                                                      {{ $jab->Nama }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @else
                                                          <select class="form-control jabatan-penilai-select"
                                                              name="JabatanId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              <option value="">Pilih Jabatan</option>
                                                              @foreach ($jabatan as $jab)
                                                                  <option value="{{ $jab->id }}"
                                                                      {{ isset($app->JabatanId) && $app->JabatanId == $jab->id ? 'selected' : '' }}>
                                                                      {{ $jab->Nama }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if ($key == 0)
                                                          <select class="form-control departemen-penilai-select"
                                                              name="DepartemenId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              @foreach ($departemen as $dept)
                                                                  <option value="{{ $dept->id }}"
                                                                      {{ $userLogin->departemen == $dept->id ? 'selected' : '' }}>
                                                                      {{ $dept->Nama }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @else
                                                          <select class="form-control select2 departemen-penilai-select"
                                                              name="DepartemenId[]" style="width: 100%;"
                                                              data-row-index="{{ $key }}">
                                                              <option value="">Pilih Departemen</option>
                                                              @foreach ($departemen as $dept)
                                                                  <option value="{{ $dept->id }}"
                                                                      {{ isset($app->DepartemenId) && $app->DepartemenId == $dept->id ? 'selected' : '' }}>
                                                                      {{ $dept->Nama }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      @endif
                                                  </td>
                                              </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="5" class="text-center text-muted">Tidak ada data
                                                      penilai</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                  <i class="fa fa-times me-1"></i> Tutup
                              </button>
                              <button type="submit" class="btn btn-primary" id="btnKonfirmasiAjukan">
                                  <i class="fa fa-paper-plane me-1"></i> Konfirmasi Ajukan
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

          {{-- Agar select2 search berjalan di dalam modal, pastikan jQuery & select2 sudah di-load, dan inisialisasi select2 dengan option dropdownParent di set ke modalnya --}}
          @push('js')
              <script>
                  $(document).ready(function() {
                      // Fix pencarian select2 di dalam modal Bootstrap
                      if ($.fn.select2) {
                          // Pastikan instance select2 dihapus dulu sebelum inisialisasi ulang (untuk kasus dynamic modal/bootstrap!)
                          $('.user-penilai-select').each(function() {
                              if ($(this).hasClass("select2-hidden-accessible")) {
                                  $(this).select2('destroy');
                              }
                          });
                          // Inisialisasi Select2 untuk setiap select dengan user-penilai-select di dalam modal
                          $('.user-penilai-select').select2({
                              dropdownParent: $(
                                  '#modalPenilai'), // INI PENTING SUPAYA pencarian (search) tidak error di modal
                              width: '100%',
                              placeholder: "Pilih User",
                              allowClear: true,
                              minimumResultsForSearch: 0
                          });
                          // Jangan disable select2 pada data-row-index="0"
                      } else {
                          console.warn("Plugin select2 belum dimuat.");
                      }

                      let isSubmitting = false;

                      function disableAllInteractions() {
                          isSubmitting = true;
                          $(document).on('contextmenu.loading', function(e) {
                              e.preventDefault();
                              return false;
                          });
                          $(document).on('keydown.loading', function(e) {
                              e.preventDefault();
                              return false;
                          });
                          $(document).on('mousewheel.loading DOMMouseScroll.loading', function(e) {
                              e.preventDefault();
                              return false;
                          });
                          $('body').css({
                              'user-select': 'none',
                              '-webkit-user-select': 'none',
                              '-moz-user-select': 'none',
                              '-ms-user-select': 'none'
                          });
                          if ($('#loading-overlay').length === 0) {
                              $('body').append(
                                  '<div id="loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:999999;cursor:not-allowed;background:rgba(0,0,0,0.3);"></div>'
                              );
                          }
                      }

                      function enableAllInteractions() {
                          isSubmitting = false;
                          $(document).off('.loading');
                          $('body').css({
                              'user-select': '',
                              '-webkit-user-select': '',
                              '-moz-user-select': '',
                              '-ms-user-select': ''
                          });
                          $('#loading-overlay').remove();
                      }

                      // User: set email, jabatanid, departemenid when user changed (tidak berlaku untuk urutan 1)
                      $('.user-penilai-select').on('change', function() {
                          var $select = $(this);
                          var rowIndex = $select.data('row-index');
                          if (rowIndex == 0) return; // urutan 1, skip
                          var selected = $select.find('option:selected');
                          var email = selected.data('email') || '';
                          var jabatanid = selected.data('jabatanid') || '';
                          var departemenid = selected.data('departemenid') || '';

                          $('input.email-penilai-input[data-row-index="' + rowIndex + '"]').val(email);
                          $('select.jabatan-penilai-select[data-row-index="' + rowIndex + '"]').val(jabatanid)
                              .trigger('change');
                          $('select.departemen-penilai-select[data-row-index="' + rowIndex + '"]').val(departemenid)
                              .trigger('change');
                      });

                      // On modal load, set email/jabatanid/departemenid if User selected (kecuali urutan 1)
                      $('.user-penilai-select').each(function() {
                          var $select = $(this);
                          var rowIndex = $select.data('row-index');
                          if (rowIndex == 0) return;
                          var selected = $select.find('option:selected');
                          if (selected.length && selected.val() !== '') {
                              var email = selected.data('email') || '';
                              var jabatanid = selected.data('jabatanid') || '';
                              var departemenid = selected.data('departemenid') || '';
                              $('input.email-penilai-input[data-row-index="' + rowIndex + '"]').val(email);
                              $('select.jabatan-penilai-select[data-row-index="' + rowIndex + '"]').val(jabatanid);
                              $('select.departemen-penilai-select[data-row-index="' + rowIndex + '"]').val(
                                  departemenid);
                          }
                      });

                      // SweetAlert submit protection
                      $('#formPenilai').on('submit', function(e) {
                          e.preventDefault();
                          if (isSubmitting) {
                              return false;
                          }

                          var form = this;
                          Swal.fire({
                              title: 'Konfirmasi Ajukan?',
                              text: 'Apakah Anda yakin data penilai sudah benar dan ingin mengirim email?',
                              icon: 'question',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Ya, ajukan!',
                              cancelButtonText: 'Batal'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  disableAllInteractions();
                                  Swal.fire({
                                      title: 'Mengirim Email...',
                                      html: '<div style="margin: 20px 0;"><i class="fa fa-envelope fa-3x" style="color: #3085d6;"></i></div>' +
                                          'Mohon tunggu, sedang mengirim email ke penilai.<br>' +
                                          '<strong style="color: #d33; margin-top: 15px; display: block;">JANGAN tutup atau refresh halaman ini!</strong><br>' +
                                          '<small>Waktu tunggu: <b id="timer-counter">0</b> detik</small>',
                                      icon: 'info',
                                      allowOutsideClick: false,
                                      allowEscapeKey: false,
                                      allowEnterKey: false,
                                      showConfirmButton: false,
                                      showCancelButton: false,
                                      didOpen: () => {
                                          Swal.showLoading();
                                          let seconds = 0;
                                          const timerInterval = setInterval(() => {
                                              seconds++;
                                              const counterEl = document.getElementById(
                                                  'timer-counter');
                                              if (counterEl) counterEl.textContent =
                                                  seconds;
                                          }, 1000);
                                          Swal.getPopup().timerInterval = timerInterval;
                                      },
                                      willClose: () => {
                                          if (Swal.getPopup().timerInterval)
                                              clearInterval(Swal.getPopup().timerInterval);
                                      }
                                  });
                                  setTimeout(function() {
                                      form.submit();
                                  }, 100);
                              }
                          });
                          return false;
                      });

                      // QUICK FIX: Re-initialize select2 after modal open, to ensure dropdownParent works properly every time
                      $('#modalPenilai').on('shown.bs.modal', function() {
                          $('.user-penilai-select').each(function() {
                              if (!$(this).hasClass("select2-hidden-accessible")) {
                                  $(this).select2({
                                      dropdownParent: $('#modalPenilai'),
                                      width: '100%',
                                      placeholder: "Pilih User",
                                      allowClear: true,
                                      minimumResultsForSearch: 0
                                  });
                              }
                          });
                      });
                  });
              </script>
          @endpush
