<form id="permeriksaanIbu">
    <div class="row">
        <br>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="beratBadan">Berat Badan</label>
                                <input type="number" class="form-control" id="beratBadan" placeholder="Kg">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">Kg</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="lingkarLengan">Lingkar Lengan</label>
                                <input type="number" class="form-control" id="lingkarLengan" placeholder="Cm">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">Cm</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status Lingkar Lengan Atas</label>
                        <select class="form-control" id="statusLingkarLengan">
                            <option>Kurang Energi Kronis (KEK) / LiLA < 23 cm</option>
                            <option>Risiko Kurang Energi Kronis (KEK) / LiLA 23 - < 23,5 cm</option>
                            <option>Normal / LiLA ≥ 23,5 cm</option>
                        </select>
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiLingkarLengan" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="tinggiFundus">Tinggi Fundus</label>
                                <input type="number" class="form-control" id="tinggiFundus" placeholder="Cm">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">Cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="sistolik">Sistolik</label>
                                <input type="number" class="form-control" id="sistolik" placeholder="mmHg">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">mm[Hg]</p>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="diastolik">Diastolik</label>
                                <input type="number" class="form-control" id="diastolik" placeholder="mmHg">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">mm[Hg]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="nadi">Nadi</label>
                                <input type="number" class="form-control" id="nadi" placeholder="BPM">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">/min</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="suhu">Suhu</label>
                                <input type="number" class="form-control" id="suhu" placeholder="°C">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">°C</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="pernapasan">Pernapasan</label>
                                <input type="number" class="form-control" id="pernapasan" placeholder="BPM">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label for="TPHT" class="mt-3"></label>
                            <p class="text-left text-bold">/min</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="golonganDarah">Golongan Darah</label>
                                <select class="form-control" id="golonganDarah">
                                    <option>O</option>
                                    <option>A</option>
                                    <option>AB</option>
                                    <option>B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="rhesus">Rhesus</label>
                                <select class="form-control" id="rhesus">
                                    <option>+</option>
                                    <option>-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="mtconf" value="option1">
                            <label for="mtconf" class="custom-control-label">Pemberian
                                Makanan Tambahan (MT)</label>
                        </div>
                    </div>
                    <div id="mt-detail" style="display: none;">
                        <div class="form-group">
                            <label for="mtlilastatus">1.1 Jika LILA < 23,5, Apakah mendapatkan MT</label>
                                    <select class="form-control" id="mtlilastatus">
                                        <option>ya</option>
                                        <option>tidak</option>
                                    </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-2">Deskripsi Lainnya</label>
                            <textarea class="form-control" id="mtDeskripsi" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jenisMT">Jenis MT</label>
                            <select class="form-control" id="jenisMT">
                                <option>MT Lokal</option>
                                <option>MT Pabrikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="simpanButton">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>


$(document).ready(function() {
    let isEditing = false;
    
    
    const savedData = JSON.parse(localStorage.getItem('pemeriksaanIbu')) || {};
    console.log(savedData);

    function updateStatusLingkarLengan() {
        const lingkarLengan = parseFloat($('#lingkarLengan').val());
        const statusSelect = $('#statusLingkarLengan');

        if (!isNaN(lingkarLengan)) {
            if (lingkarLengan < 23) {
                statusSelect.val('Kurang Energi Kronis (KEK) / LiLA < 23 cm');
            } else if (lingkarLengan >= 23 && lingkarLengan < 23.5) {
                statusSelect.val('Risiko Kurang Energi Kronis (KEK) / LiLA 23 - < 23,5 cm');
            } else if (lingkarLengan >= 23.5) {
                statusSelect.val('Normal / LiLA ≥ 23,5 cm');
            }
        } else {
            statusSelect.val(''); // Clear if input is not a number
        }
    }

    // Add event listener for lingkar lengan input
    $('#lingkarLengan').on('input', function() {
        updateStatusLingkarLengan();

        // Also update MT section visibility if needed
        const lingkarLengan = parseFloat($(this).val());
        if (!isNaN(lingkarLengan) && lingkarLengan < 23.5) {
            $('#mtconf').prop('checked', true).trigger('change');
        }
    });

    function validasiFormPemeriksaanIbu() {
        const form = $('#permeriksaanIbu');
        const requiredFields = [
            { id: 'beratBadan', label: 'Berat Badan', min: 30, max: 200 },
            { id: 'lingkarLengan', label: 'Lingkar Lengan', min: 11, max: 34 },
            { id: 'tinggiFundus', label: 'Tinggi Fundus', min: 5, max: 50 },
            { id: 'sistolik', label: 'Tekanan Sistolik', min: 60, max: 250 },
            { id: 'diastolik', label: 'Tekanan Diastolik', min: 40, max: 150 },
            { id: 'nadi', label: 'Nadi', min: 40, max: 200 },
            { id: 'suhu', label: 'Suhu Tubuh', min: 30, max: 45 },
            { id: 'pernapasan', label: 'Pernapasan', min: 10, max: 60 },
        ];

        for (let field of requiredFields) {
            const value = parseFloat($('#' + field.id).val());
            if (isNaN(value)) {
                swal("Input kosong!", `${field.label} harus diisi.`, "error");
                $('#' + field.id).focus();
                return false;
            }
            if (value < field.min || value > field.max) {
                swal("Nilai tidak valid!", `${field.label} harus di antara ${field.min} - ${field.max}.`, "error");
                $('#' + field.id).focus();
                return false;
            }
        }

        // Validasi select box
        const selectFields = [
            { id: 'statusLingkarLengan', label: 'Status Lingkar Lengan' },
            { id: 'golonganDarah', label: 'Golongan Darah' },
            { id: 'rhesus', label: 'Rhesus' },
        ];

        for (let field of selectFields) {
            const val = $('#' + field.id).val();
            if (!val || val === '') {
                swal("Pilih opsi!", `${field.label} harus dipilih.`, "error");
                $('#' + field.id).focus();
                return false;
            }
        }

        // Jika MT dicentang, wajib isi semua detail MT
        if ($('#mtconf').is(':checked')) {
            const mtRequired = [
                { id: 'mtlilastatus', label: 'Status MT LILA' },
                { id: 'mtDeskripsi', label: 'Deskripsi MT' },
                { id: 'jenisMT', label: 'Jenis MT' }
            ];
            for (let field of mtRequired) {
                const val = $('#' + field.id).val();
                if (!val || val.trim() === '') {
                    swal("Wajib diisi!", `${field.label} harus diisi jika MT dicentang.`, "error");
                    $('#' + field.id).focus();
                    return false;
                }
            }
        }

        return true;
    }


    // Event listener for the save button
    $('#simpanButton').click(function() {

        if ($('#simpanButton').text() == 'Edit') {
            isEditing = true;
        }
        if (!isEditing) {
            if (validasiFormPemeriksaanIbu()) {
                    // Collect data from the form
                const dataIbu = {
                    beratBadan: $('#beratBadan').val(),
                    lingkarLengan: $('#lingkarLengan').val(),
                    statusLingkarLengan: $('#statusLingkarLengan').val(),
                    deskripsiLingkarLengan: $('#deskripsiLingkarLengan').val(),
                    tinggiFundus: $('#tinggiFundus').val(),
                    sistolik: $('#sistolik').val(),
                    diastolik: $('#diastolik').val(),
                    nadi: $('#nadi').val(),
                    suhu: $('#suhu').val(),
                    pernapasan: $('#pernapasan').val(),
                    golonganDarah: $('#golonganDarah').val(),
                    rhesus: $('#rhesus').val(),
                    mtconf: $('#mtconf').is(':checked') ? 'true' : 'false'
                };

                //guna untuk ada makanan tambahan atau tidak

                if (dataIbu.mtconf == 'true') {
                    dataIbu.mtlilastatus = $('#mtlilastatus').val();
                    dataIbu.mtDeskripsi = $('#mtDeskripsi').val();
                    dataIbu.jenisMT = $('#jenisMT').val();
                } else {
                    dataIbu.mtlilastatus = null;
                    dataIbu.mtDeskripsi = null;
                    dataIbu.jenisMT = null;
                }




                for (const key in dataIbu) {
                    if (savedData[key]) {
                        // Jika key sudah ada, perbarui value-nya saja
                        savedData[key].value = dataIbu[key];
                    } else {
                        // Jika key belum ada, buat objek baru tanpa id
                        savedData[key] = {
                            value: dataIbu[key]
                        };
                    }
                }
                
                // Save data to Local Storage
                localStorage.setItem('pemeriksaanIbu', JSON.stringify(savedData));


                // Change button text to "Edit" and disable the form
                $('#simpanButton').text('Edit').removeClass('btn-success').addClass('btn-secondary');
                $('#permeriksaanIbu input, #permeriksaanIbu select, #permeriksaanIbu textarea').prop('disabled', true);
                // Optionally, you can show a success message
                swal("Berhasil!", "Semua data value telah disimpan di local.", "success");
            }
          
        } else {
            // Show modal confirmation for editing
            $('#editModal').modal('show');
        }
    });

    // Load data from Local Storage when the page is loaded
    if (savedData && Object.keys(savedData).length > 0) {
        // Fill the form with saved data
        $('#beratBadan').val(savedData.beratBadan?.value || '');
        $('#lingkarLengan').val(savedData.lingkarLengan?.value || '');
        $('#statusLingkarLengan').val(savedData.statusLingkarLengan?.value || '');
        $('#deskripsiLingkarLengan').val(savedData.deskripsiLingkarLengan?.value || '');
        $('#tinggiFundus').val(savedData.tinggiFundus?.value || '');
        $('#sistolik').val(savedData.sistolik?.value || '');
        $('#diastolik').val(savedData.diastolik?.value || '');
        $('#nadi').val(savedData.nadi?.value || '');
        $('#suhu').val(savedData.suhu?.value || '');
        $('#pernapasan').val(savedData.pernapasan?.value || '');
        $('#golonganDarah').val(savedData.golonganDarah?.value || '');
        $('#rhesus').val(savedData.rhesus?.value || '');
        $('#mtlilastatus').val(savedData.mtlilastatus?.value || '');
        $('#mtDeskripsi').val(savedData.mtDeskripsi?.value || '');
        $('#jenisMT').val(savedData.jenisMT?.value || '');

        // Untuk checkbox, gunakan .prop() dengan pengecekan
        $('#mtconf').prop('checked', savedData.mtconf?.value || false);

        // Show/hide MT details based on checkbox
        if (savedData.mtconf?.value === 'true' || savedData.mtconf?.value === 'ya') {
            $('#mtconf').prop('checked', true);
            $('#mt-detail').show();
        } else {
            $('#mtconf').prop('checked', false);
            $('#mt-detail').hide();
        }

        isEditing = true;

        // Disable the form by default
        setTimeout(() => {
            $('#permeriksaanIbu input, #permeriksaanIbu select, #permeriksaanIbu textarea').prop('disabled', true);
        }, 20);

        $('#simpanButton').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        // Set isEditing to true since we have saved data
    }
    
    // Confirm edit action
    $('#confirmEdit').click(function() {
        $('#editModal').modal('hide');
        // Enable the form for editing
       
        $('#permeriksaanIbu input, #permeriksaanIbu select, #permeriksaanIbu textarea').prop('disabled',
            false);
        $('#simpanButton').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        isEditing = false; // Set isEditing to false to indicate we are now in edit mode
    });

    // Cancel edit action
    $('#cancelEdit').click(function() {
        $('#editModal').modal('hide');
    });

    // Show/hide MT details based on checkbox
    $('#mtconf').change(function() {
        $('#mt-detail').toggle(this.checked);
    });

   

});
</script>