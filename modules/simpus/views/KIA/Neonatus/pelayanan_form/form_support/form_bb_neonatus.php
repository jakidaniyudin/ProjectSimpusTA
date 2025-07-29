 <form id="bbNeonatus">
     <div class="row">
         <!-- kolom kiri -->
         <div class="col-md-6">
             <div class="form-group">
                 <label for="ASI" class="form-label">Form Pemeriksaan Berat Badan dan Pemberian ASI</label>
                 <select id="ASI" class="form-control">
                     <option value="" selected>Select...</option>
                     <option value="ya">Ya</option>
                     <option value="tidak">Tidak</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiASI" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiASI" class="form-control"></textarea>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="BBU" class="form-label">BB/U</label>
                 <select id="BBU" class="form-control">
                     <option value="" selected>Select...</option>
                     <option value="sangatKurang">Berat badan Sangat Kurang</option>
                     <option value="underweight">Underweight</option>
                     <option value="normal">Normal weight</option>
                     <option value="resikoOverweigth">Resiko Berat Badan Lebih</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiBBU" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiBBU" class="form-control"></textarea>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="PBU" class="form-label">PB/U dan TB/U</label>
                 <select id="PBU" class="form-control">
                     <option value="" selected>Select...</option>
                     <option value="sangatPendek">Very Short</option>
                     <option value="pendekUntukUmur">Short Stature for Age</option>
                     <option value="normalHeight">Body Height Normal for Age</option>
                     <option value="tall">Tall for Age</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskripsiBBU" class="form-label">Deskripsi</label>
                 <textarea id="deskripsiBBU" class="form-control"></textarea>
             </div>
         </div>

         <!-- kolom kanan -->
         <div class="col-md-6">
             <div class="form-group">
                 <label for="BBPB" class="form-label">BB/PB dan BB/TB</label>
                 <select id="BBPB" class="form-control">
                     <option value="" selected>Select...</option>
                     <option value="GiziBuruk">Gizi Buruk</option>
                     <option value="Undernourished">Undernourished</option>
                     <option value="WellNourished">Well nourished</option>
                     <option value="RisikoGiziLebih">Risiko Gizi Lebih</option>
                     <option value="Overweight">Overweight</option>
                     <option value="Obese">Obese</option>
                 </select>
             </div>

             <div class="form-group" style="margin-top: 20px;">
                 <label for="deskrispBBPB" class="form-label">Deskripsi</label>
                 <textarea id="deskrispBBPB" class="form-control"></textarea>
             </div>
         </div>
     </div>
     <div class="row" style="display: flex; justify-content: end; margin-top: 20px;">
         <div class="col-md-3">
             <button type="button" id="bbNeoBtn" class="btn btn-success" style="width: 100%;">
                 <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
             </button>
         </div>
     </div>
 </form>
 <script>
    function BBNeo() {
    // Get the form element
    const $form = $('#bbNeonatus');
    
    // Get all values using the form as context
    const ASI = $form.find('#ASI').val();
    const deskripsiASI = $form.find('#deskripsiASI').val();
    const BBU = $form.find('#BBU').val();
    const deskripsiBBU = $form.find('#deskripsiBBU').val();
    const PBU = $form.find('#PBU').val();
    const deskripsiPBU = $form.find('#deskripsiBBU').val(); // Note: Same ID as deskripsiBBU
    const BBPB = $form.find('#BBPB').val();
    const deskrispBBPB = $form.find('#deskrispBBPB').val();

    // Validation - checking required fields
    if (ASI === '' || ASI === undefined || 
        BBU === '' || BBU === undefined || 
        PBU === '' || PBU === undefined || 
        BBPB === '' || BBPB === undefined) {
        showSwal('warning', 'Data tidak lengkap', 'Semua pemeriksaan berat badan wajib diisi!');
        return null;
    }

    return {
        ASI,
        deskripsiASI,
        BBU,
        deskripsiBBU,
        PBU,
        deskripsiPBU,
        BBPB,
        deskrispBBPB
    };
}

function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

$(document).ready(function(){
    let data = null;

    // Updated to use the correct button ID
    $('#bbNeoBtn').on('click', function(e) {
        e.preventDefault();

        const formData = BBNeo();
        if (!formData) return;

        const dataBayiBalitaBBNeo = {};
        const keys = Object.keys(formData);

        keys.forEach((key) => {
            if (data?.[key]) {
                dataBayiBalitaBBNeo[key] = {
                    value: formData[key],
                    id: data[key].id
                };
            } else {
                dataBayiBalitaBBNeo[key] = {
                    value: formData[key],
                    id: null
                };
            }
        });

        // Prepare data to send
        console.log(dataBayiBalitaBBNeo);
        // sendFormData(dataToSend);
    });
});
 </script>