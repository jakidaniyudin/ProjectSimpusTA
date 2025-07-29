 <form id="form_kn0">
     <div class="row">
         <!-- Kolom Kiri -->
         <div class="col-md-6">
             <!-- Tanggal Lahir -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="nama">Tanggal Lahir</label>
                 <input
                     type="date"
                     class="form-control"
                     id="nama"
                     placeholder="Masukkan Nama Anda" />
             </div>

             <!-- Jam Lahir -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="jam">Jam Lahir</label>
                 <div class="panel panel-default">
                     <div class="panel-body">
                         <h6>Select Time</h6>
                         <div class="row">
                             <div class="col-xs-4">
                                 <label for="hours">Hour</label>
                                 <input
                                     type="number"
                                     class="form-control"
                                     id="hours"
                                     placeholder="00"
                                     min="0"
                                     max="23" />
                             </div>
                             <div class="col-xs-4">
                                 <label for="minutes">Minutes</label>
                                 <input
                                     type="number"
                                     class="form-control"
                                     id="minutes"
                                     placeholder="00"
                                     min="0"
                                     max="59" />
                             </div>
                             <div class="col-xs-4">
                                 <label for="seconds">Second</label>
                                 <input
                                     type="number"
                                     class="form-control"
                                     id="seconds"
                                     placeholder="00"
                                     min="0"
                                     max="59" />
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Berat Badan Bayi Saat Lahir -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="berat">Berat Badan Bayi Saat Lahir</label>
                 <div class="input-group">
                     <input
                         type="text"
                         class="form-control"
                         placeholder="12" />
                     <span class="input-group-addon">g</span>
                 </div>
             </div>

             <!-- Panjang Bayi Saat Lahir -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="panjang">Panjang Bayi Saat Lahir</label>
                 <div class="input-group">
                     <input
                         type="text"
                         class="form-control"
                         placeholder="12" />
                     <span class="input-group-addon">cm</span>
                 </div>
             </div>

             <!-- Lingkar Kepala Saat Lahir -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="lingkar">Lingkar Kepala Saat Lahir</label>
                 <div class="input-group">
                     <input
                         type="text"
                         class="form-control"
                         placeholder="12" />
                     <span class="input-group-addon">cm</span>
                 </div>
             </div>

             <!-- Imunisasi HBIG -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="imunisasi_hbig">Imunisasi HBIG</label>
                 <select class="form-control" id="imunisasi_hbig">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_imunisasi">Deskripsi</label>
                 <textarea id="deskripsi_imunisasi" class="form-control"></textarea>
             </div>

             <!-- Ibu Hepatitis -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="ibu_hepatitis">Ibu Hepatitis</label>
                 <select class="form-control" id="ibu_hepatitis">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_ibu_hepatitis">Deskripsi</label>
                 <textarea id="deskripsi_ibu_hepatitis" class="form-control"></textarea>
             </div>

             <div class="row" style="margin-bottom: 20px;">
                 <div class="col-md-8">
                     <!-- Tanggal Kena Hepatitis -->
                     <div class="form-group">
                         <label for="tanggal-kena-hepatitis">Tanggal Tekena Hepatitis</label>
                         <input type="date" id="tanggal-kena-hepatitis" class="form-control">
                     </div>
                 </div>
                 <div class="col-md-4">
                     <!-- jam -->
                     <div class="form-group">
                         <label for="jam">Jam</label>
                         <input type="time" id="jam" class="form-control">
                     </div>
                 </div>
             </div>

             <!-- Imunisasi Hepatitis -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="imunisasi_hepatitis">Imunisasi Hepatitis B</label>
                 <select class="form-control" id="imunisasi_hepatitis">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_imunisasi_hepatitis">Deskripsi</label>
                 <textarea id="deskripsi_imunisasi_hepatitis" class="form-control"></textarea>
             </div>
         </div>

         <!-- Kolom Kanan -->
         <div class="col-md-6">
             <!-- Inisiasi Menyusui Dini -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="menyusui">Inisiasi Menyusui Dini</label>
                 <select id="menyusui" class="form-control">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_menyusui">Deskripsi</label>
                 <textarea id="deskripsi_menyusui" class="form-control"></textarea>
             </div>

             <!-- Waktu Inisiasi Menyusui Dini -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="waktu_menyusui">Jika Ya, Waktu Inisiasi Menyusui Dini</label>
                 <select class="form-control" id="waktu_menyusui">
                     <option selected>Select...</option>
                     <option value="1">Kurang Dari 1 jam</option>
                     <option value="2">Lebih Dari 1 jam</option>
                 </select>
             </div>

             <!-- Vitamin K -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="vitamin_k">Apakah diberikan vitamin K</label>
                 <select class="form-control" id="vitamin_k">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_menyusui">Deskripsi</label>
                 <textarea id="deskripsi_menyusui" class="form-control"></textarea>
             </div>

             <!-- Antibiotik mata -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="vitamin_k">Salep Antibiotik Mata</label>
                 <select class="form-control" id="vitamin_k">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_vit_k">Deskripsi</label>
                 <textarea id="deskripsi_vit_k" class="form-control"></textarea>
             </div>


             <!-- Pemeriksaan Kesehatan -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="pemeriksaan">Apakah dilakukan pemeriksaan kesehatan dengan pendekatan MTBM</label>
                 <select class="form-control" id="pemeriksaan">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <!-- Deskripsi -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_mtbm">Deskripsi</label>
                 <textarea id="deskripsi_mtbm" class="form-control"></textarea>
             </div>

             <!-- PPA -->
             <div class="form-group" style="margin-bottom: 20px;">
                 <label for="deskripsi_ppa">PPA</label>
                 <textarea id="deskripsi_ppa" class="form-control"></textarea>
             </div>

             <!-- Submit -->
             <div class="form-group">
                  <button type="button" id="neonatusDataBayiBtn" class="btn btn-success" style="width: 100%;">
                    <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
                  </button>
             </div>
         </div>
     </div>
 </form>
 <script>
    function getFormDataKN0() {
        const tanggalLahir = $('#nama').val(); // <- 'nama' dipakai sebagai ID Tanggal Lahir
        const hours = $('#hours').val();
        const minutes = $('#minutes').val();
        const seconds = $('#seconds').val();
        const jamLahir = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        // Ambil seluruh input lain
        const beratLahir = $('[placeholder="12"]').eq(0).val(); // Berat Badan Bayi
        const panjangLahir = $('[placeholder="12"]').eq(1).val(); // Panjang Badan
        const lingkarKepala = $('[placeholder="12"]').eq(2).val(); // Lingkar Kepala

        const imunisasiHbig = $('#imunisasi_hbig').val();
        const deskripsiImunisasi = $('#deskripsi_imunisasi').val();

        const ibuHepatitis = $('#ibu_hepatitis').val();
        const deskripsiIbuHepatitis = $('#deskripsi_ibu_hepatitis').val();
        const tanggalKenaHepatitis = $('#tanggal-kena-hepatitis').val();
        const jamKenaHepatitis = $('#jam').val();

        const imunisasiHepatitis = $('#imunisasi_hepatitis').val();
        const deskripsiImunisasiHepatitis = $('#deskripsi_imunisasi_hepatitis').val();

        const menyusui = $('#menyusui').val();
        const deskripsiMenyusui = $('#deskripsi_menyusui').val();
        const waktuMenyusui = $('#waktu_menyusui').val();

        const vitaminK = $('#vitamin_k').val();
        const deskripsiVitK = $('#deskripsi_vit_k').val();

        const pemeriksaan = $('#pemeriksaan').val();
        const deskripsiMtbm = $('#deskripsi_mtbm').val();

        const deskripsiPpa = $('#deskripsi_ppa').val();

        // Validasi minimal
        if (!tanggalLahir || hours === "" || minutes === "" || seconds === "") {
            showSwal('warning', 'Data tidak lengkap', 'Tanggal & jam lahir wajib diisi!');
            return null;
        }

        return {
            tanggalLahir,
            jamLahir,
            beratLahir,
            panjangLahir,
            lingkarKepala,
            imunisasiHbig,
            deskripsiImunisasi,
            ibuHepatitis,
            deskripsiIbuHepatitis,
            tanggalKenaHepatitis,
            jamKenaHepatitis,
            imunisasiHepatitis,
            deskripsiImunisasiHepatitis,
            menyusui,
            deskripsiMenyusui,
            waktuMenyusui,
            vitaminK,
            deskripsiVitK,
            pemeriksaan,
            deskripsiMtbm,
            deskripsiPpa
        };
    }

function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

$(document).ready(function(){
  let data = null; // Jika ada data awal, bisa assign ke sini

  $('#neonatusDataBayiBtn').on('click', function (e) {
    e.preventDefault();

    const formData = getFormDataKN0(); // Ambil data dari form
    if (!formData) return;

    const dataBayiBalita = {};
    const keys = Object.keys(formData); // Ambil semua key dari formData

    keys.forEach((key) => {
      if (data?.[key]) {
        // Jika data lama sudah ada, update value, pertahankan id
        dataBayiBalita[key] = {
          value: formData[key],
          id: data[key].id
        };
      } else {
        // Data baru, assign id null
        dataBayiBalita[key] = {
          value: formData[key],
          id: null
        };
      }
    });

    // Kirim data jika diperlukan

    console.log('Data siap dikirim:', dataToSend);

    // Kirim ke server jika perlu
    // sendFormData(dataToSend);
  });
});

 </script>