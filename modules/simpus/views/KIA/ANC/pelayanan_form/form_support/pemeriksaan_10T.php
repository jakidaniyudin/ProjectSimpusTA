<h4>Pemeriksaan 10T</h4>
<div class="row">
    <br>
    <div class="col-md-6">
        <div class="card card-primary">
            <form id="formPemeriksaan10T">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="hemoglobin">Pemeriksaan Hemoglobin</label>
                                <input type="text" class="form-control" id="hemoglobin" placeholder="Masukkan nilai">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">g/dl</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>HIV Test</label>
                        <select class="form-control" id="hivTest">
                            <option>Reaktif</option>
                            <option>Non Reaktif</option>
                        </select>
                        <label class="mt-2">Deskripsi Reaktif</label>
                        <textarea class="form-control" id="deskripsiHIVTest" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Syphilis Test</label>
                        <select class="form-control" id="syphilisTest">
                            <option>Reaktif</option>
                            <option>Non Reaktif</option>
                        </select>
                        <label class="mt-2">Deskripsi Reaktif</label>
                        <textarea class="form-control" id="deskripsiSyphilisTest" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hepatitis B Test</label>
                        <select class="form-control" id="hepatitisBTest">
                            <option>Reaktif</option>
                            <option>Non Reaktif</option>
                        </select>
                        <label class="mt-2">Deskripsi Reaktif</label>
                        <textarea class="form-control" id="deskripsiHepatitisBTest" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="gulaDarah">Pemeriksaan Gula Darah</label>
                                <input type="text" class="form-control" id="gulaDarah" placeholder="Masukkan nilai">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">mg/dl</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="proteinUrin">Pemeriksaan Protein Urin</label>
                                <input type="text" class="form-control" id="proteinUrin" placeholder="Masukkan nilai">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">mg/dl</p>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="save10T">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    let isEditing = false;
    const savedData10T = JSON.parse(localStorage.getItem('pemeriksaan10T')) || {};
    
    function validatePemeriksaan10T() {
            const hemoglobin = $('#hemoglobin').val().trim();
            const hivTest = $('#hivTest').val();
            const deskripsiHIVTest = $('#deskripsiHIVTest').val().trim();
            const syphilisTest = $('#syphilisTest').val();
            const deskripsiSyphilisTest = $('#deskripsiSyphilisTest').val().trim();
            const hepatitisBTest = $('#hepatitisBTest').val();
            const deskripsiHepatitisBTest = $('#deskripsiHepatitisBTest').val().trim();
            const gulaDarah = $('#gulaDarah').val().trim();
            const proteinUrin = $('#proteinUrin').val().trim();

            // Validasi hemoglobin
            if (hemoglobin === '' || isNaN(hemoglobin) || hemoglobin <= 0 || hemoglobin > 25) {
                swal('Error', 'Masukkan nilai hemoglobin yang valid (0–25 g/dl)', 'error');
                return false;
            }

            // Deskripsi HIV wajib jika reaktif
            if (hivTest === 'Reaktif' && deskripsiHIVTest === '') {
                swal('Error', 'Deskripsi HIV harus diisi jika hasil tes Reaktif', 'error');
                return false;
            }

            // Deskripsi Syphilis wajib jika reaktif
            if (syphilisTest === 'Reaktif' && deskripsiSyphilisTest === '') {
                swal('Error', 'Deskripsi Syphilis harus diisi jika hasil tes Reaktif', 'error');
                return false;
            }

            // Deskripsi Hepatitis B wajib jika reaktif
            if (hepatitisBTest === 'Reaktif' && deskripsiHepatitisBTest === '') {
                swal('Error', 'Deskripsi Hepatitis B harus diisi jika hasil tes Reaktif', 'error');
                return false;
            }

            // Validasi gula darah
            if (gulaDarah === '' || isNaN(gulaDarah) || gulaDarah <= 0 || gulaDarah > 400) {
                swal('Error', 'Masukkan nilai gula darah yang valid (0–400 mg/dl)', 'error');
                return false;
            }

            // Validasi protein urin
            if (proteinUrin === '' || isNaN(proteinUrin) || proteinUrin < 0 || proteinUrin > 500) {
                swal('Error', 'Masukkan nilai protein urin yang valid (0–500 mg/dl)', 'error');
                return false;
            }

            return true;
        }
    // Event listener for the save button in formPemeriksaan10T
    $('#save10T').click(function(event) {
        event.preventDefault();
        if ($('#save10T').text() == 'Edit') {
            isEditing = true;
        }
        if (!validatePemeriksaan10T()) {
                return;
        }
        if (!isEditing) {
            // Collect data from the form
            const data10T = {
                hemoglobin: $('#hemoglobin').val(),
                hivTest: $('#hivTest').val(),
                deskripsiHIVTest: $('#deskripsiHIVTest').val(),
                syphilisTest: $('#syphilisTest').val(),
                deskripsiSyphilisTest: $('#deskripsiSyphilisTest').val(),
                hepatitisBTest: $('#hepatitisBTest').val(),
                deskripsiHepatitisBTest: $('#deskripsiHepatitisBTest').val(),
                gulaDarah: $('#gulaDarah').val(),
                proteinUrin: $('#proteinUrin').val(),
            };


            for (const key in data10T) {
                if (savedData10T[key]) {
                    // Jika key sudah ada, perbarui value-nya saja
                    savedData10T[key].value = data10T[key];
                } else {
                    // Jika key belum ada, buat objek baru tanpa id
                    savedData10T[key] = {
                        value: data10T[key]
                    };
                }
            }
            console.log(savedData10T);

            // Save data to Local Storage
            localStorage.setItem('pemeriksaan10T', JSON.stringify(savedData10T));

            // Disable the form and update the button
            $('#save10T').text('Edit').removeClass('btn-success').addClass('btn-secondary');
            $('#formPemeriksaan10T input, #formPemeriksaan10T select, #formPemeriksaan10T textarea')
                .prop('disabled', true);

           swal('berhasil !','data berhasil disimpan dilocal','success');
        } else {
            $('#editModal').modal('show');
        }
    });

    // Load data from Local Storage on page load

    if (savedData10T && Object.keys(savedData10T).length > 0) {
        // Populate the form with saved data
        $('#hemoglobin').val(savedData10T.hemoglobin?.value || '');
        $('#hivTest').val(savedData10T.hivTest?.value || '');
        $('#deskripsiHIVTest').val(savedData10T.deskripsiHIVTest?.value || '');
        $('#syphilisTest').val(savedData10T.syphilisTest?.value || '');
        $('#deskripsiSyphilisTest').val(savedData10T.deskripsiSyphilisTest?.value || '');
        $('#hepatitisBTest').val(savedData10T.hepatitisBTest?.value || '');
        $('#deskripsiHepatitisBTest').val(savedData10T.deskripsiHepatitisBTest?.value || '');
        $('#gulaDarah').val(savedData10T.gulaDarah?.value || '');
        $('#proteinUrin').val(savedData10T.proteinUrin?.value || '');

        $('#formPemeriksaan10T input, #formPemeriksaan10T select, #formPemeriksaan10T textarea').prop(
            'disabled', true);
        $('#save10T').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        isEditing = true;
    }

    // Confirm edit action
    $('#confirmEdit').click(function() {
        $('#editModal').modal('hide');
        $('#formPemeriksaan10T input, #formPemeriksaan10T select, #formPemeriksaan10T textarea').prop(
            'disabled', false);
        $('#save10T').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        isEditing = false;
    });

    // Cancel edit action
    $('#cancelEdit').click(function() {
        $('#editModal').modal('hide');
    });
});
</script>