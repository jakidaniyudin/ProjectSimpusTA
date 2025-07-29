
<form action="" id="kunjunganPnc">

  <div id="form2" class="form-container">
    <div class="container-fluid mt-5">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #e1e1e1">
          <h4 class="panel-title">Form Data Persalinan dan Status Obstetri</h4>
        </div>
        <div class="panel-body">
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#custom-tabs-three-home" class="text-danger">
                Data Riwayat Persalinan yang Lalu >>
              </a>
            </li>
          </ul>

          <div class="tab-content" style="margin-top: 20px;">
            <div class="tab-pane fade in active" id="custom-tabs-three-home">
              <form id="FormRiwayatPersalinanPNC">
                <div class="form-group">
                  <label for="tanggalPersalinan">Tanggal Persalinan</label>
                  <input
                    type="date"
                    class="form-control"
                    id="tanggalPersalinan"
                    placeholder="Masukkan Tanggal Persalinan"
                  />
                </div>
                <div class="form-group">
                  <label for="penolongPersalinan">Penolong Persalinan</label>
                  <select class="form-control" id="penolongPersalinan">
                    <option selected>Select...</option>
                    <option value="1">Dr. Richard</option>
                    <option value="2">Dr. Vincent</option>
                    <option value="3">Lainya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="lokasiPersalinan">Lokasi Persalinan</label>
                  <select class="form-control" id="lokasiPersalinan">
                    <option selected>Select...</option>
                    <option value="1">Muncar</option>
                    <option value="2">Genteng</option>
                    <option value="3">Lainya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="gravida">Gravida</label>
                  <select class="form-control" id="gravida">
                    <option selected>Select...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="partus">Partus</label>
                  <select class="form-control" id="partus">
                    <option selected>Select...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="abortus">Abortus</label>
                  <select class="form-control" id="abortus">
                    <option selected>Select...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="form-group text-right">
                  <button type="button" class="btn btn-success" id="btnSimpanPersalinan">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    Simpan
                  </button>
                </div>
              </form>
            </div>
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
      const loadData = <?= json_encode($riwayat) ?? null ?>;
      console.log(loadData);
      if(loadData != null){
         data = synchronizeData(loadData); 
      }    
      console.log('anomali')
      if(data != null){
        isiFormPersalinan(data);
      }
      $('#btnSimpanPersalinan').on('click', function (e) {
        e.preventDefault();
        console.log('hallo');
        const formData = getFormData();
        if (!formData) return;
        const dataPersalinanPNC = {};
        const keys = [
          'abortus',
          'gravida',
          'partus',
          'penolongPersalinan',
          'lokasiPersalinan',
          'tanggalPersalinan',
          'pemeriksaanKe'
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
        id_dokter: '<?= $item['kdDokter'] ?? null ?>',
        start: '<?= $start ?>'
      }
      if (!formData) return;
      // Membungkus data dalam objek dataPersalinanPNC
      dataToSend.dataPersalinanPNC =  dataPersalinanPNC;
      sendFormData(dataToSend);
    });
  });

  function isiFormPersalinan(data) {
    // Helper function untuk set value aman
    const safeSetValue = (id, value) => {
      const el = document.getElementById(id);
      if (el && value !== undefined && value !== null) {
        el.value = value;
      }
    };

    // Isi input type date
    if (data.tanggalPersalinan && data.tanggalPersalinan.value) {
      safeSetValue('tanggalPersalinan', data.tanggalPersalinan.value);
    }

    // Isi select/select-like dengan id dan value
    if (data.penolongPersalinan && data.penolongPersalinan.value) {
      safeSetValue('penolongPersalinan', data.penolongPersalinan.value);
    }

    if (data.lokasiPersalinan && data.lokasiPersalinan.value) {
      safeSetValue('lokasiPersalinan', data.lokasiPersalinan.value);
    }

    if (data.gravida && data.gravida.value) {
      safeSetValue('gravida', data.gravida.value);
    }

    if (data.partus && data.partus.value) {
      safeSetValue('partus', data.partus.value);
    }

    if (data.abortus && data.abortus.value) {
      safeSetValue('abortus', data.abortus.value);
    }
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
    const tanggalPersalinan = $('#tanggalPersalinan').val();
    const penolongPersalinan = $('#penolongPersalinan').val();
    const lokasiPersalinan = $('#lokasiPersalinan').val();
    const gravida = $('#gravida').val();
    const partus = $('#partus').val();
    const abortus = $('#abortus').val();

    if (
      !tanggalPersalinan ||
      !penolongPersalinan ||
      !lokasiPersalinan ||
      !gravida ||
      !partus ||
      !abortus
    ) {
      showSwal('warning', 'Form belum lengkap', 'Harap isi semua field sebelum menyimpan.');
      return null;
    }

    return {
      pemeriksaanKe,
      tanggalPersalinan,
      penolongPersalinan,
      lokasiPersalinan,
      gravida,
      partus,
      abortus
    };
  }

  function sendFormData(data) {
    $.ajax({
      url: '<?= base_url('/simpus/PNC/setRiwayatPersalinan') ?>',
      method: 'POST',
      data: data,
      success: function (response) {
        showSwal('success', 'Berhasil', `Data pemeriksaan ke-${data.dataPersalinanPNC.pemeriksaanKe.value} berhasil disimpan.`);
        $('#FormRiwayatPersalinanPNC')[0].reset();
      },
      error: function (xhr) {
        showSwal('error', 'Gagal', 'Terjadi kesalahan saat menyimpan data.');
      }
    });
  }

  function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
  }
</script>