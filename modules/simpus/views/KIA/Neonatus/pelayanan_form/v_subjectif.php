<form action="" id="dataBayiNeo">
  <div id="form1" class="form-container">
  <div class="container-fluid " style="margin-top: 20px;">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color: #e1e1e1">
        <h4 class="panel-title">Form Pengiriman Data Bayi/Balita</h4>
      </div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#custom-tabs-three-home" class="text-danger">Data Bayi/Balita >></a>
            </li>
          </ul>

        <div class="tab-content" style="margin-top: 10px;">
          <div id="custom-tabs-three-home" class="tab-pane fade in active">
            <form>
              <div class="row">
                <div class="col-lg-6">
                  <label for="tanggalLahir" class="control-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tanggalLahir" placeholder="Masukkan Tanggal Lahir" />

                  <label for="jam" style="margin-top: 10px;">Jam Lahir</label>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <h6>Select Time</h6>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-xs-4">
                            <label for="hours" class="control-label">Hour</label>
                            <input type="number" class="form-control" id="hours" placeholder="00" min="0" max="23" />
                          </div>
                          <div class="col-xs-4">
                            <label for="minutes" class="control-label">Minutes</label>
                            <input type="number" class="form-control" id="minutes" placeholder="00" min="0" max="59" />
                          </div>
                          <div class="col-xs-4">
                            <label for="seconds" class="control-label">Second</label>
                            <input type="number" class="form-control" id="seconds" placeholder="00" min="0" max="59" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <label for="kotaKelahiran" class="control-label">Kab/Kota Kelahiran</label>
                  <select class="form-control" id="kotaKelahiran">
                    <option selected>Select...</option>
                    <option value="1">Banyuwangi</option>
                    <option value="2">Denpasar</option>
                    <option value="3">Jember</option>
                  </select>
                </div>

                <div class="col-lg-6">
                  <label for="jenisKelamin" class="control-label">Jenis Kelamin</label>
                  <select class="form-control" id="jenisKelamin">
                    <option selected>Select...</option>
                    <option value="1">Laki-Laki</option>
                    <option value="2">Perempuan</option>
                    <option value="3">Lainya</option>
                  </select>

                  <label for="anakKe" class="control-label" style="margin-top: 20px;">Anak Ke-</label>
                  <input type="text" class="form-control mb-md-5" id="anakKe" placeholder="2" />

                  <label for="usiaGestasi" class="control-label" style="margin-top: 20px;">Usia Gestasi</label>
                  <div style="display: flex; align-items:center;">
                    <input type="text" class="form-control" id="usiaGestasi" placeholder="12" />
                    <label style="margin-left: 10px;">(Wk)</label>
                  </div>

                  <div class="col" style="margin-top: 50px;">
                    <div class="row">
                      <div class="col-md-6">
                        <button type="button" id="neonatusDataBayiBtn" class="btn btn-success btn-block">
                          <i class="glyphicon glyphicon-floppy-disk"></i>
                          Simpan
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
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
  function getFormDataBayi() {
  const tanggalLahir = $('#tanggalLahir').val();
  const hours = $('#hours').val();
  const minutes = $('#minutes').val();
  const seconds = $('#seconds').val();
  const kotaKelahiran = $('#kotaKelahiran').val();
  const jenisKelamin = $('#jenisKelamin').val();
  const anakKe = $('#anakKe').val();
  const usiaGestasi = $('#usiaGestasi').val();

  // Validasi: pastikan semua field terisi
  if (
    !tanggalLahir ||
    hours === "" ||
    minutes === "" ||
    seconds === "" ||
    !kotaKelahiran ||
    !jenisKelamin ||
    !anakKe ||
    !usiaGestasi
  ) {
    showSwal(
      'warning',
      'Form belum lengkap',
      'Harap isi semua field sebelum menyimpan.'
    );
    return null;
  }

  // Gabungkan jam lahir dalam format HH:mm:ss
  const jamLahir = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

  return {
    tanggalLahir,
    jamLahir,
    kotaKelahiran,
    jenisKelamin,
    anakKe,
    usiaGestasi
  };
}
function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

 function sendFormData(data) {
    $.ajax({
      url: '<?= base_url('/simpus/Neonatus/setDataBayi') ?>',
      method: 'POST',
      data: data,
      success: function (response) {
        showSwal('success', 'Berhasil', `Data pemeriksaan berhasil disimpan.`);
      },
      error: function (xhr) {
        showSwal('error', 'Gagal', 'Terjadi kesalahan saat menyimpan data.');
      }
    });
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

  function isiFormPersalinan(data) {
  const form = $('#dataBayiNeo'); // Batasi ke form data bayi/balita

  // Helper untuk set value dengan aman
  const safeSetValue = (selectorId, value) => {
    const el = form.find(`#${selectorId}`);
    if (el.length && value !== undefined && value !== null) {
      el.val(value);
    }
  };

  // Set tanggal lahir
  if (data.tanggalLahir && data.tanggalLahir.value) {
    safeSetValue('tanggalLahir', data.tanggalLahir.value);
  }

  // Set jam lahir (HH:mm:ss → hours, minutes, seconds)
  if (data.jamLahir && data.jamLahir.value) {
    const parts = data.jamLahir.value.split(':');
    if (parts.length === 3) {
      safeSetValue('hours', parts[0]);
      safeSetValue('minutes', parts[1]);
      safeSetValue('seconds', parts[2]);
    }
  }

  // Set kota kelahiran
  if (data.kotaKelahiran && data.kotaKelahiran.value) {
    safeSetValue('kotaKelahiran', data.kotaKelahiran.value);
  }

  // Set jenis kelamin
  if (data.jenisKelamin && data.jenisKelamin.value) {
    safeSetValue('jenisKelamin', data.jenisKelamin.value);
  }

  // Set anak ke
  if (data.anakKe && data.anakKe.value) {
    safeSetValue('anakKe', data.anakKe.value);
  }

  // Set usia gestasi
  if (data.usiaGestasi && data.usiaGestasi.value) {
    safeSetValue('usiaGestasi', data.usiaGestasi.value);
  }
}



$(document).ready(function(){
   let data = null;
   let dataToSend;
   const loadData = <?= json_encode($riwayat) ?? null ?>;
   if(loadData != null){
      data = synchronizeData(loadData);
   }

   if(data != null){
      isiFormPersalinan(data);
   }

  

  $('#neonatusDataBayiBtn').on('click', function (e) {
    e.preventDefault();
    const formData = getFormDataBayi(); // Fungsi ini hanya ambil data form bayi/balita
    if (!formData) return;

    const dataBayiBalita = {};
    const keys = [
      'tanggalLahir',
      'jamLahir',
      'kotaKelahiran',
      'jenisKelamin',
      'anakKe',
      'usiaGestasi'
    ];

    keys.forEach((key) => {
      if (data?.[key]) {
        // Data sudah ada, update value, pertahankan id
        dataBayiBalita[key] = {
          value: formData[key],
          id: data[key].id
        };
      } else {
        // Data baru, set id null
        dataBayiBalita[key] = {
          value: formData[key],
          id: null
        };
      }
    });

    dataToSend = {
      pasien_id : '<?= $pasien_id ?>',
      loket_id : '<?= $loket_id ?>',
      puskesmas : '<?= $puskesmas ?>',
      pasien:JSON.stringify(<?= json_encode($pasien) ?>),
      actv_service :actv_service,
      id_dokter: '<?= $item['kdDokter'] ?? null ?>',
      start: '<?= $start ?>'
    }

    if (!formData) return;

    dataToSend.dataBayiBalita = dataBayiBalita;
    sendFormData(dataToSend);
  //sendFormData(dataToSend); // Kirim data ke server
});

});


</script>
