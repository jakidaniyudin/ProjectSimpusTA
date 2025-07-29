<form id="form1">
    <div class="row">
        <br>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="denyutJantungJanin">Denyut Jantung Janin</label>
                                <input type="text" class="form-control" id="denyutJantungJanin" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">{beats}/min</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kendala Terhadap PAP</label>
                        <select class="form-control" id="kendalaPAP">
                            <option>Masuk Panggul</option>
                            <option>Belum Masuk Panggul</option>
                        </select>
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiKendalaPAP" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="taksiranBeratJanin">Taksiran Berat Janin</label>
                                <input type="text" class="form-control" id="taksiranBeratJanin" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">g</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Presentasi</label>
                        <select class="form-control" id="presentasi">
                            <option>Presentasi Kepala</option>
                            <option>Presentasi Bokong</option>
                            <option>Letak Lintang</option>
                        </select>
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiPresentasi" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="abdominalCircumference">Abdominal Circumference (AC)</label>
                        <input type="text" class="form-control" id="abdominalCircumference" placeholder="umur">
                    </div>
                    <div class="form-group mt-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="saveJanin">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    let isEditing = false;
    const savedData = JSON.parse(localStorage.getItem('form1')) || {};

    function validateJaninForm() {
        const denyut = $('#denyutJantungJanin').val().trim();
        const beratJanin = $('#taksiranBeratJanin').val().trim();
        const ac = $('#abdominalCircumference').val().trim();
        const deskripsiKendala = $('#deskripsiKendalaPAP').val().trim();
        const deskripsiPresentasi = $('#deskripsiPresentasi').val().trim();

        // Validasi kosong
        if (denyut === '' || beratJanin === '' || ac === '' || deskripsiKendala === '' || deskripsiPresentasi === '') {
            swal('Error', 'Semua input wajib diisi.', 'error');
            return false;
        }

        // Validasi numerik
        const denyutNum = parseFloat(denyut);
        const beratNum = parseFloat(beratJanin);
        const acNum = parseFloat(ac);

        if (isNaN(denyutNum) || isNaN(beratNum) || isNaN(acNum)) {
            swal('Error', 'Input angka tidak valid.', 'error');
            return false;
        }

        // Validasi denyut jantung janin: 100–180 bpm
        if (denyutNum < 100 || denyutNum > 180) {
            swal('Error', 'Denyut Jantung Janin tidak wajar (100–180 bpm).', 'error');
            return false;
        }

        // Validasi berat janin: 50–5000 gram
        if (beratNum < 50 || beratNum > 5000) {
            swal('Error', 'Taksiran Berat Janin tidak wajar (50–5000 gram).', 'error');
            return false;
        }

        // Validasi AC: 10–500 mm
        if (acNum < 10 || acNum > 500) {
            swal('Error', 'Lingkar Abdomen (AC) tidak wajar (10–500 mm).', 'error');
            return false;
        }

        return true;
    }


    // Event listener for the save button in form1
    $('#saveJanin').click(function(event) {
        event.preventDefault(); // Prevent form submission
        if ($('#saveJanin').text() == 'Edit') {
            isEditing = true;
        }

        if (!isEditing && !validateJaninForm()) {
            return; // Jika tidak valid, hentikan simpan
        }
        if (!isEditing) {
            // Collect data from the form
            const data = {
                denyutJantungJanin: $('#denyutJantungJanin').val(),
                kendalaPAP: $('#kendalaPAP').val(),
                deskripsiKendalaPAP: $('#deskripsiKendalaPAP').val(),
                taksiranBeratJanin: $('#taksiranBeratJanin').val(),
                presentasi: $('#presentasi').val(),
                deskripsiPresentasi: $('#deskripsiPresentasi').val(),
                abdominalCircumference: $('#abdominalCircumference').val(),
            };

            for (const key in data) {
                if (savedData[key]) {
                    // Jika key sudah ada, perbarui value-nya saja
                    savedData[key].value = data[key];
                } else {
                    // Jika key belum ada, buat objek baru tanpa id
                    savedData[key] = {
                        value: data[key]
                    };
                }
            }

            // Save data to Local Storage
            localStorage.setItem('form1', JSON.stringify(savedData));

            // Change button text to "Edit" and disable the form
            $('#saveJanin').text('Edit').removeClass('btn-success').addClass('btn-secondary');
            $('#form1 input, #form1 select, #form1 textarea').prop('disabled', true);

            // Show a success message
            swal('berhasil','data disimpan di local','success');
        } else {
            // Show modal confirmation for editing
            $('#editModal').modal('show');
        }
    });

    // Load data from Local Storage when the page is loaded

    if (savedData && Object.keys(savedData).length > 0) {
        // Fill the form with saved data
        $('#denyutJantungJanin').val(savedData.denyutJantungJanin?.value || '');
        $('#kendalaPAP').val(savedData.kendalaPAP?.value || '');
        $('#deskripsiKendalaPAP').val(savedData.deskripsiKendalaPAP?.value || '');
        $('#taksiranBeratJanin').val(savedData.taksiranBeratJanin?.value || '');
        $('#presentasi').val(savedData.presentasi?.value || '');
        $('#deskripsiPresentasi').val(savedData.deskripsiPresentasi?.value || '');
        $('#abdominalCircumference').val(savedData.abdominalCircumference?.value || '');

        // Disable the form by default
        $('#form1 input, #form1 select, #form1 textarea').prop('disabled', true);
        $('#saveJanin').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        isEditing = true; // Set isEditing to true since we have saved data
    }

    // Confirm edit action
    $('#confirmEdit').click(function() {
        $('#editModal').modal('hide');
        // Enable the form for editing
        $('#form1 input, #form1 select, #form1 textarea').prop('disabled', false);
        $('#saveJanin').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        isEditing = false; // Set isEditing to false to indicate we are now in edit mode
    });

    // Cancel edit action
    $('#cancelEdit').click(function() {
        $('#editModal').modal('hide');
    });
});
</script>