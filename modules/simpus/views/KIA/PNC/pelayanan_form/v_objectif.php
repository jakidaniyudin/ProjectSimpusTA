<form action="" id="formPelayananNifas">
  <div id="form2" class="form-container">
    <div class="container-fluid mt-5">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #e1e1e1">
          <h4 class="panel-title">Form Pelayanan Nifas</h4>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label for="pemeriksaanKe" class="form-label">Pemeriksaan nifas ke-</label>
            <select id="pemeriksaanKe" class="form-control" name="pemeriksaanKe">
              <option value="1" selected>1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label class="form-label">Tekanan darah (mmHg)</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-5">
                          <label for="sistolik" class="control-label">Sistolik</label>
                        </div>
                        <div class="col-xs-7">
                          <input type="text" class="form-control input-sm" id="sistolik" name="sistolik" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-4">
                          <label for="diastolik" class="control-label">/Diastolik</label>
                        </div>
                        <div class="col-xs-6">
                          <input type="text" class="form-control input-sm" id="diastolik" name="diastolik" />
                        </div>
                        <div class="col-xs-2">
                          <label class="control-label">(mmHg)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="nadi">Nadi (Denyut per menit)</label>
                <div class="input-group">
                  <input type="number" id="nadi" class="form-control" name="nadi" placeholder="100"/>
                  <span class="input-group-addon">/min</span>
                </div>
              </div>

              <div class="form-group">
                <label for="suhu">Suhu</label>
                <div class="input-group">
                  <input type="number" id="suhu" class="form-control" name="suhu" placeholder="36.1"/>
                  <span class="input-group-addon">°C</span>
                </div>
              </div>

              <div class="form-group">
                <label for="pernafasan">Pernafasan</label>
                <div class="input-group">
                  <input type="number" id="pernafasan" class="form-control" name="pernafasan" placeholder="20"/>
                  <span class="input-group-addon">/min</span>
                </div>
              </div>

              <div class="form-group">
                <label for="pendarahan">Pendarahan Pervaginal</label>
                <input type="text" id="pendarahan" class="form-control" name="pendarahan">
              </div>

              <div class="form-group">
                <label for="jumlahPendarahan">Jumlah Pendarahan</label>
                <div class="input-group">
                  <input type="number" id="jumlahPendarahan" class="form-control" name="jumlahPendarahan" placeholder="200"/>
                  <span class="input-group-addon">mL</span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="kondisiPayudara">Kondisi Payudara</label>
                <select class="form-control" id="kondisiPayudara" name="kondisiPayudara">
                  <option value="" selected>Select...</option>
                  <option value="1">Sweelling breast</option>
                  <option value="2">Dischard from nipple</option>
                  <option value="3">Pain of brest</option>
                  <option value="4">Breast normal</option>
                </select>
              </div>

              <div class="form-group">
                <label for="kontraksiUteri">Kontraksi Uteri</label>
                <select class="form-control" id="kontraksiUteri" name="kontraksiUteri">
                  <option value="" selected>Select...</option>
                  <option value="ya">Ya</option>
                  <option value="tidak">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label for="warnaLokia">Warna Lokhia</label>
                <select class="form-control" id="warnaLokia" name="warnaLokia">
                  <option value="" selected>Select...</option>
                  <option value="1">Merah</option>
                  <option value="2">Kecoklatan</option>
                  <option value="3">Kuning</option>
                </select>
              </div>

              <div class="form-group">
                <label for="produksiAsi">Produksi ASI</label>
                <select class="form-control" id="produksiAsi" name="produksiAsi">
                  <option value="" selected>Select...</option>
                  <option value="1">Produksi ASI ada</option>
                  <option value="2">Produksi ASI ada tapi sedikit</option>
                  <option value="3">Produksi ASI tidak ada</option>
                </select>
              </div>

              <div class="form-group">
                <label for="konseling">Konseling Perawatan Bayi Baru Lahir</label>
                <select class="form-control" id="konseling" name="konseling">
                  <option value="" selected>Select...</option>
                  <option value="1">Completed</option>
                  <option value="2">not Done</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-success" id="btnSimpanPemeriksaan">
              <i class="glyphicon glyphicon-floppy-save"></i>
              Simpan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function () {
    let dataToSend;
    let data = null;
    const loadData =  <?= json_encode($riwayat) ?? null ?>;
    if(loadData != null){
        data = synchronizeData(loadData);
    }
    if(data != null){
        isiFormPersalinan(data);
    }
    // Handle form submission
    $('#formPelayananNifas').on('submit', function(e) {
      e.preventDefault();
        const formData = getFormData();
        if (!formData) return;
        const dataPersalinanPNC = {};
        const keys = [
            'pemeriksaanKe',
            'sistolik',
            'diastolik',
            'nadi',
            'suhu',
            'pernafasan',
            'kondisiPayudara',
            'pendarahan',
            'jumlahPendarahan',
            'kontraksiUteri',
            'warnaLokia',
            'produksiAsi',
            'konseling'
        ];

        keys.forEach((key) => {
          if (data?.[key]) {
            // Jika sudah ada, update value, pertahankan ID
            dataPersalinanPNC[key] = {
              value: formData[key],
              id: data[key].id
            };
          } else {
            // Jika belum ada, buat baru dengan ID null
            dataPersalinanPNC[key] = {
              value: formData[key],
              id: null
            };
          }
        });
       dataToSend = {
        pasien_id : '<?= $pasien_id?>',
        loket_id : '<?= $loket_id ?>',
        puskesmas :  '<?= $puskesmas ?>',
        pasien:JSON.stringify(<?= json_encode($pasien) ?>),
        actv_service :actv_service,
        id_dokter: '<?= $item['"kdDokter'] ?? null ?>',
        start: '<?= $start ?>'
      }
      if (!formData) return;
      // Membungkus data dalam objek dataPersalinanPNC
      dataToSend.dataPersalinanPNC =  dataPersalinanPNC;
      sendFormData(dataToSend);
    });
  });

    function isiFormPersalinan(data) {
        console.log('data saya');
        console.log(data);

        // Helper function untuk set value aman
        const safeSetValue = (id, obj) => {
            const el = document.getElementById(id);
            if (el && obj?.value !== undefined && obj?.value !== null) {
                el.value = obj.value;
            }
        };

        safeSetValue('pemeriksaanKe', data.pemeriksaanKe);
        safeSetValue('sistolik', data.sistolik);
        safeSetValue('diastolik', data.diastolik);
        safeSetValue('nadi', data.nadi);
        safeSetValue('suhu', data.suhu);
        safeSetValue('pernafasan', data.pernafasan);
        safeSetValue('kondisiPayudara', data.kondisiPayudara);
        safeSetValue('pendarahan', data.pendarahan);
        safeSetValue('jumlahPendarahan', data.jumlahPendarahan);
        safeSetValue('kontraksiUteri', data.kontraksiUteri);
        safeSetValue('warnaLokia', data.warnaLokia);
        safeSetValue('produksiAsi', data.produksiAsi);
        safeSetValue('konseling', data.konseling);
    }

   function synchronizeData(newData) {
      let updatedData = {};

      if (newData.length === 0) {
          // Jika data kosong, kembalikan null sebagai feedback
          return null;
      } else {
          newData.forEach(item => {
              const key = item.atribut;
              const value = JSON.parse(item.jawaban).value;
              updatedData[key] = {
                  value: value,           // Simpan nilai
                  id: item.id ?? null     // Tambahkan id jika ada
              };
          });

          // Return data sebagai hasil sinkronisasi
          return updatedData;
      }

  }


  function getFormData() {
    const pemeriksaanKe = $('#pemeriksaanKe').val();
    const sistolik = $('#sistolik').val();
    const diastolik = $('#diastolik').val();
    const nadi = $('#nadi').val();
    const suhu = $('#suhu').val();
    const pernafasan = $('#pernafasan').val();
    const kondisiPayudara = $('#kondisiPayudara').val();

    // Validate required fields
    if (!sistolik || !diastolik || !nadi || !suhu || !pernafasan || !kondisiPayudara) {
      showSwal('warning', 'Form belum lengkap', 'Harap isi semua field yang diperlukan sebelum menyimpan.');
      return null;
    }

    return {
      pemeriksaanKe,
      sistolik,
      diastolik,
      nadi,
      suhu,
      pernafasan,
      kondisiPayudara,
      pendarahan: $('#pendarahan').val(),
      jumlahPendarahan: $('#jumlahPendarahan').val(),
      kontraksiUteri: $('#kontraksiUteri').val(),
      warnaLokia: $('#warnaLokia').val(),
      produksiAsi: $('#produksiAsi').val(),
      konseling: $('#konseling').val()
    };
  }

  function sendFormData(data) {
    $.ajax({
      url: '<?= base_url('/simpus/PNC/setNifas') ?>', // Ganti dengan endpoint backend kamu
      method: 'POST',
      data: data,
      success: function() {
        showSwal('success', 'Berhasil', `Data pemeriksaan ke-${data.pemeriksaanKe} berhasil disimpan.`);
      },
      error: function(xhr) {
        showSwal('error', 'Gagal', 'Terjadi kesalahan saat menyimpan data.');
      }
    });
  }

  function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
  }
</script>