  <form id="kn_02">
      <div class="row">
          <div class="col-md-6">
              <label for="shk" class="form-label">Apakah Sudah SHK</label>
              <select id="shk" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
          <div class="col-md-6">
              <label for="hepatitis_b" class="form-label">Imunisasi Hepatitis B</label>
              <select id="hepatitis_b" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="inisiasi_menyusui_dini" class="form-label">Inisiasi Menyusui Dini</label>
              <select id="inisiasi_menyusui_dini" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
          <div class="col-md-6">
              <label for="deskripsi1" class="form-label">Deskripsi</label>
              <textarea id="deskripsi1" class="form-control"></textarea>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="deskripsi2" class="form-label">Deskripsi</label>
              <textarea id="deskripsi2" class="form-control"></textarea>
          </div>
          <div class="col-md-6">
              <label for="skiring_hipotioid_kongenital" class="form-label">Skiring Hipotioid Kongenital (Bila belum diberkan)</label>
              <select id="skiring_hipotioid_kongenital" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Kurang Dari 1 Jam</option>
                  <option value="2">Lebih Dari 1 Jam</option>
              </select>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="waktu_inisiasi_menyusui_dini" class="form-label">Jika Ya, Waktu Inisiasi Menyusui Dini</label>
              <select id="waktu_inisiasi_menyusui_dini" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
          <div class="col-md-6">
              <label for="deskripsi3" class="form-label">Deskripsi</label>
              <textarea id="deskripsi3" class="form-control"></textarea>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="perawatan_tali_pusar" class="form-label">Perawatan Tali Pusar</label>
              <select id="perawatan_tali_pusar" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
          <div class="col-md-6">
              <label for="pemeriksaan_kesehatan_mtbm" class="form-label">Apakah dilakukan pemeriksaan kesehatan dengan pendekatan MTBM</label>
              <select id="pemeriksaan_kesehatan_mtbm" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="deskripsi4" class="form-label">Deskripsi</label>
              <textarea id="deskripsi4" class="form-control"></textarea>
          </div>
          <div class="col-md-6">
              <label for=" deskripsi5" class="form-label">Deskripsi</label>
              <textarea id="deskripsi5" class="form-control"></textarea>
          </div>
      </div>
      <div class="row" style="margin-top:20px;">
          <div class="col-md-6">
              <label for="identifikasi_kuning" class="form-label">Identifikasi Kuning</label>
              <select id="identifikasi_kuning" class="form-control">
                  <option selected>Select...</option>
                  <option value="1">Ya</option>
                  <option value="2">Tidak</option>
              </select>
          </div>
          <div class="col-md-6">
              <label for="ppi_a" class="form-label">PPIA</label>
              <textarea id="ppi_a" class="form-control"></textarea>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
              <label for="deskripsi6" class="form-label">Deskripsi</label>
              <textarea id="deskripsi6" class="form-control"></textarea>
          </div>

          <div class="col-md-6" style="margin-top: 20px;">
                <button type="button" id="KN2Button" class="btn btn-success" style="width: 100%;">
                  <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
                </button>
          </div>
      </div>
</form>
<script>

function getFormDataKN2() {
    // Get the form element
    const $form = $('#kn_02');
    
    // Get all values using the form as context
    const shk = $form.find('#shk').val();
    const hepatitisB = $form.find('#hepatitis_b').val();
    const inisiasiMenyusuiDini = $form.find('#inisiasi_menyusui_dini').val();
    const deskripsi1 = $form.find('#deskripsi1').val();
    const deskripsi2 = $form.find('#deskripsi2').val();
    const skiringHipotioidKongenital = $form.find('#skiring_hipotioid_kongenital').val();
    const waktuInisiasiMenyusuiDini = $form.find('#waktu_inisiasi_menyusui_dini').val();
    const deskripsi3 = $form.find('#deskripsi3').val();
    const perawatanTaliPusar = $form.find('#perawatan_tali_pusar').val();
    const pemeriksaanKesehatanMtbm = $form.find('#pemeriksaan_kesehatan_mtbm').val();
    const deskripsi4 = $form.find('#deskripsi4').val();
    const deskripsi5 = $form.find('#deskripsi5').val();
    const identifikasiKuning = $form.find('#identifikasi_kuning').val();
    const ppiA = $form.find('#ppi_a').val();
    const deskripsi6 = $form.find('#deskripsi6').val();

    // Validation
    if (shk == '' || !hepatitisB == '' || !inisiasiMenyusuiDini == '') {
        showSwal('warning', 'Data tidak lengkap', 'Data wajib diisi!');
        return null;
    }

    return {
        shk,
        hepatitisB,
        inisiasiMenyusuiDini,
        deskripsi1,
        deskripsi2,
        skiringHipotioidKongenital,
        waktuInisiasiMenyusuiDini,
        deskripsi3,
        perawatanTaliPusar,
        pemeriksaanKesehatanMtbm,
        deskripsi4,
        deskripsi5,
        identifikasiKuning,
        ppiA,
        deskripsi6
    };
}

function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

$(document).ready(function(){
    let data = null;

    // Updated to use the correct button ID from the form
    $('#kn_02 #KN2Button').on('click', function(e) {
        e.preventDefault();

        const formData = getFormDataKN2();
        if (!formData) return;

        const dataBayiBalitaKN2 = {};
        const keys = Object.keys(formData);

        keys.forEach((key) => {
            if (data?.[key]) {
                dataBayiBalitaKN2[key] = {
                    value: formData[key],
                    id: data[key].id
                };
            } else {
                dataBayiBalitaKN2[key] = {
                    value: formData[key],
                    id: null
                };
            }
        });

        // Prepare data to send
        console.log(dataBayiBalitaKN2);
        // sendFormData(dataToSend);
    });
});
</script>