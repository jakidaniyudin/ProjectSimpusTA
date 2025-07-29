 <form id="form_kn3">
     <div class="row">
         <!-- kolom kiri -->
         <div class="col-md-6">
             <div class="form-group">
                 <label for="menyusui" class="form-label">Inisiasi Menyusui Dini</label>
                 <select id="menyusui" class="custom-select form-control">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiMenyusui" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiMenyusui" class="form-control"></textarea>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="inisiaiMenyusui" class="form-label">Jika Ya, Waktu Inisiasi Menyusui Dini</label>
                 <select id="inisiaiMenyusui" class="custom-select form-control">
                     <option selected>Select...</option>
                     <option value="1">Kurang dari 1 Jam</option>
                     <option value="2">Lebih dari 1 Jam</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="taliPusar" class="form-label">Perawatan Tali Pusat</label>
                 <select id="taliPusar" class="custom-select form-control">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiTaliPusar" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiTaliPusar" class="form-control"></textarea>
             </div>
         </div>

         <!-- kolom kanan -->
         <div class="col-md-6">
             <div class="form-group">
                 <label for="kuning" class="form-label">Identifikasi Kuning</label>
                 <select id="kuning" class="custom-select form-control">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiKuning" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiKuning" class="form-control"></textarea>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="MTBM" class="form-label">Apakah dilakukan pemeriksaan kesehatan dengan pendekatan MTBM</label>
                 <select id="MTBM" class="custom-select form-control">
                     <option selected>Select...</option>
                     <option value="1">Ya</option>
                     <option value="2">Tidak</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiMTBM" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiMTBM" class="form-control"></textarea>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="PPIA" class="form-label">PPIA</label>
                 <textarea id="PPIA" class="form-control"></textarea>
             </div>
         </div>
     </div>
     <div class="row" style="display: flex; justify-content: end; margin-top: 20px;">
         <div class="col-md-3">
             <button type="button" id="KN3Button" class="btn btn-success" style="width: 100%;">
                 <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
             </button>
         </div>
     </div>
 </form>
 <script>
function getFormDataKN3() {
    // Get the form element
    const $form = $('#form_kn3');
    
    // Get all values using the form as context
    const menyusui = $form.find('#menyusui').val();
    const deskripsiMenyusui = $form.find('#deskripsiMenyusui').val();
    const inisiaiMenyusui = $form.find('#inisiaiMenyusui').val();
    const taliPusar = $form.find('#taliPusar').val();
    const deskripsiTaliPusar = $form.find('#deskripsiTaliPusar').val();
    const kuning = $form.find('#kuning').val();
    const deskripsiKuning = $form.find('#deskripsiKuning').val();
    const MTBM = $form.find('#MTBM').val();
    const deskripsiMTBM = $form.find('#deskripsiMTBM').val();
    const PPIA = $form.find('#PPIA').val();

    // Validation
    if (menyusui == '' || !taliPusar == '' || !kuning == '' || !MTBM == '') {
        showSwal('warning', 'Data tidak lengkap', 'Data wajib diisi!');
        return null;
    }

    return {
        menyusui,
        deskripsiMenyusui,
        inisiaiMenyusui,
        taliPusar,
        deskripsiTaliPusar,
        kuning,
        deskripsiKuning,
        MTBM,
        deskripsiMTBM,
        PPIA
    };
}

function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

$(document).ready(function(){
    let data = null;

    // Updated to use the correct button ID from the form
    $('#form_kn3 #KN3Button').on('click', function(e) {
        e.preventDefault();

        const formData = getFormDataKN3();
        if (!formData) return;

        const dataBayiBalitaKN3 = {};
        const keys = Object.keys(formData);

        keys.forEach((key) => {
            if (data?.[key]) {
                dataBayiBalitaKN3[key] = {
                    value: formData[key],
                    id: data[key].id
                };
            } else {
                dataBayiBalitaKN3[key] = {
                    value: formData[key],
                    id: null
                };
            }
        });

        // Prepare data to send
        console.log(dataBayiBalitaKN3);
        // sendFormData(dataToSend);
    });
});
 </script>