<form id="pemeriksaanFisikIbu">
    <div class="row">
        <br>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="konjungtiva">Konjungtiva</label>
                        <select class="form-control" id="konjungtiva">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiKonjungtiva" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="sklera">Sklera</label>
                        <select class="form-control" id="sklera">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiSklera" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="leher">Leher</label>
                        <select class="form-control" id="leher">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiLeher" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gigiMulut">Gigi dan Mulut</label>
                        <select class="form-control" id="gigiMulut">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiGigiMulut" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tungkai">Tungkai</label>
                        <select class="form-control" id="tungkai">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiTungkai" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tht">THT</label>
                        <select class="form-control" id="tht">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiTHT" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dadaJantung">Dada Jantung</label>
                        <select class="form-control" id="dadaJantung">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiDadaJantung" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dadaParu">Dada Paru - Paru</label>
                        <select class="form-control" id="dada Paru">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiDadaParu" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="perut">Perut</label>
                        <select class="form-control" id="perut">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiPerut" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <button type="button" id="FisikIbuButton"
                            class="btn btn-success btn-sm btn-block">simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    ///BATAS UNUTK LANJUTANYA
    let isEditingFisik = false;
    const savedDataFisik = JSON.parse(localStorage.getItem('pemeriksaanFisikIbu')) || {};
    console.log(savedDataFisik);

    // Event listener for the save button in pemeriksaanFisikIbu
    $('#FisikIbuButton').click(function(event) {
        event.preventDefault(); // Prevent form submission
        if ($('#FisikIbuButton').text() == 'Edit') {
            isEditingFisik = true;
        }
        if (!isEditingFisik) {
            // Collect data from the form
            const dataFisik = {
                konjungtiva: $('#konjungtiva').val(),
                deskripsiKonjungtiva: $('#deskripsiKonjungtiva').val(),
                sklera: $('#sklera').val(),
                deskripsiSklera: $('#deskripsiSklera').val(),
                leher: $('#leher').val(),
                deskripsiLeher: $('#deskripsiLeher').val(),
                gigiMulut: $('#gigiMulut').val(),
                deskripsiGigiMulut: $('#deskripsiGigiMulut').val(),
                tungkai: $('#tungkai').val(),
                deskripsiTungkai: $('#deskripsiTungkai').val(),
                tht: $('#tht').val(),
                deskripsiTHT: $('#deskripsiTHT').val(),
                dadaJantung: $('#dadaJantung').val(),
                deskripsiDadaJantung: $('#deskripsiDadaJantung').val(),
                dadaParu: $('#dadaParu').val(),
                deskripsiDadaParu: $('#deskripsiDadaParu').val(),
                perut: $('#perut').val(),
                deskripsiPerut: $('#deskripsiPerut').val(),
            };


            for (const key in dataFisik) {
                if (savedDataFisik[key]) {
                    // Jika key sudah ada, perbarui value-nya saja
                    savedDataFisik[key].value = dataFisik[key];
                } else {
                    // Jika key belum ada, buat objek baru tanpa id
                    savedDataFisik[key] = {
                        value: dataFisik[key]
                    };
                }
            }

            // Save data to Local Storage
            localStorage.setItem('pemeriksaanFisikIbu', JSON.stringify(savedDataFisik));

            // Change button text to "Edit" and disable the form
            $('#pemeriksaanFisikIbu .btn-success').text('Edit').removeClass('btn-success').addClass(
                'btn-secondary');
            $('#pemeriksaanFisikIbu input, #pemeriksaanFisikIbu select, #pemeriksaanFisikIbu textarea')
                .prop('disabled', true);

            // Optionally, you can show a success message
            swal('berhasil','data disimpan di local','success');
        } else {
            // Show modal confirmation for editing
            $('#editModal').modal('show');
        }
    });

    // Load data from Local Storage when the page is loaded

    if (savedDataFisik && Object.keys(savedDataFisik).length > 0) {
        isEditingFisik = true;
        // Fill the form with saved data
        $('#konjungtiva').val(savedDataFisik.konjungtiva?.value || '');
        $('#deskripsiKonjungtiva').val(savedDataFisik.deskripsiKonjungtiva?.value || '');
        $('#sklera').val(savedDataFisik.sklera?.value || '');
        $('#deskripsiSklera').val(savedDataFisik.deskripsiSklera?.value || '');
        $('#leher').val(savedDataFisik.leher?.value || '');
        $('#deskripsiLeher').val(savedDataFisik.deskripsiLeher?.value || '');
        $('#gigiMulut').val(savedDataFisik.gigiMulut?.value || '');
        $('#deskripsiGigiMulut').val(savedDataFisik.deskripsiGigiMulut?.value || '');
        $('#tungkai').val(savedDataFisik.tungkai?.value || '');
        $('#deskripsiTungkai').val(savedDataFisik.deskripsiTungkai?.value || '');
        $('#tht').val(savedDataFisik.tht?.value || '');
        $('#deskripsiTHT').val(savedDataFisik.deskripsiTHT?.value || '');
        $('#dadaJantung').val(savedDataFisik.dadaJantung?.value || '');
        $('#deskripsiDadaJantung').val(savedDataFisik.deskripsiDadaJantung?.value || '');
        $('#dadaParu').val(savedDataFisik.dadaParu?.value || '');
        $('#deskripsiDadaParu').val(savedDataFisik.deskripsiDadaParu?.value || '');
        $('#perut').val(savedDataFisik.perut?.value || '');
        $('#deskripsiPerut').val(savedDataFisik.deskripsiPerut?.value || '');
        // Disable the form by default
        setTimeout(function() {
            $('#pemeriksaanFisikIbu input, #pemeriksaanFisikIbu select, #pemeriksaanFisikIbu textarea')
            .removeAttr('readonly')
            .removeAttr('data-readonly')
            .prop('disabled', true);
        },20)
       


        $('#pemeriksaanFisikIbu .btn-success').text('Edit').removeClass('btn-success').addClass(
            'btn-secondary');
        // Set isEditingFisik to true since we have saved data
    }

    // Confirm edit action
    $('#confirmEdit').click(function() {
        $('#editModal').modal('hide');
        // Enable the form for editing
        $('#pemeriksaanFisikIbu input, #pemeriksaanFisikIbu select, #pemeriksaanFisikIbu textarea')
            .prop('disabled', false);
        $('#FisikIbuButton').text('Simpan').removeClass('btn-secondary').addClass(
            'btn-success');
        isEditingFisik = false; // Set isEditingFisik to false to indicate we are now in edit mode
    });

    // Cancel edit action
    $('#cancelEdit').click(function() {
        $('#editModal').modal('hide');
    });
});
</script>