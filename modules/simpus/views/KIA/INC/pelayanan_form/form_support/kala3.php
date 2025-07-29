<div class="card">
    <div class="card-body">
        <form id="formkala3">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="plasenta">Plasenta</label>
                        <select class="form-control" id="plasenta">
                            <option>Lengkap</option>
                            <option>Tidak Lengkap</option>
                        </select>
                        <label class="mt-2" for="penangananPlasenta">Tindakan Penanganan</label>
                        <textarea class="form-control" id="penangananPlasenta" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="perdarahan">Perdarahan</label>
                        <select class="form-control" id="perdarahan">
                            <option>Ada</option>
                            <option>Tidak Ada</option>
                        </select>
                        <label class="mt-2" for="tindakanPerdarahan">Tindakan Yang Dilakukan</label>
                        <textarea class="form-control" id="tindakanPerdarahan" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="mt-2" for="masalahLainKala3">Masalah Lain</label>
                        <textarea class="form-control" id="masalahLainKala3" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2" for="penatalaksanaanKala3">Penatalaksanaan Masalah</label>
                        <textarea class="form-control" id="penatalaksanaanKala3" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2" for="hasilKala3">Hasilnya</label>
                        <textarea class="form-control" id="hasilKala3" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-sm btn-block">Data
                                    Bayi</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-sm btn-block" id="btn-apgar">Apgar
                                    Bayi</button>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm btn-block" id="simpanButtonKala3">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal" tabindex="-1" role="dialog" id="editModalKala3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengedit data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmEditKala3">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const formID = '#formkala3';
    const storageKey = 'dataKala3';
    const btnID = '#simpanButtonKala3';
    const modalID = '#editModalKala3';

    $('#btn-apgar').on('click', function () {
        $('#custom-tabs-three-messages-tab').tab('show');
    });

    // Mengambil data dari localStorage saat halaman dimuat
    const storedData = JSON.parse(localStorage.getItem(storageKey)) || {};
    console.log(storedData);
    if (Object.keys(storedData).length > 0) {
        // Isi data dari localStorage
        $(`${formID} #plasenta`).val(storedData.plasenta?.value || 'Lengkap');
        $(`${formID} #penangananPlasenta`).val(storedData.penangananPlasenta?.value || '');
        $(`${formID} #perdarahan`).val(storedData.perdarahan?.value || 'Tidak Ada');
        $(`${formID} #tindakanPerdarahan`).val(storedData.tindakanPerdarahan?.value || '');
        $(`${formID} #masalahLainKala3`).val(storedData.masalahLainKala3?.value || '');
        $(`${formID} #penatalaksanaanKala3`).val(storedData.penatalaksanaanKala3?.value || '');
        $(`${formID} #hasilKala3`).val(storedData.hasilKala3?.value || '');

        // Ubah tombol menjadi Edit
        $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');

        // Nonaktifkan form
        disableForm();
    }

    function validasiFormKala3() {
        const plasenta = document.getElementById('plasenta').value.trim();
        const penangananPlasenta = document.getElementById('penangananPlasenta').value.trim();
        const perdarahan = document.getElementById('perdarahan').value.trim();
        const tindakanPerdarahan = document.getElementById('tindakanPerdarahan').value.trim();
        const masalahLain = document.getElementById('masalahLainKala3').value.trim();
        const penatalaksanaan = document.getElementById('penatalaksanaanKala3').value.trim();
        const hasil = document.getElementById('hasilKala3').value.trim();

        let errors = [];

        // ✅ Validasi kosong
        if (!plasenta) errors.push("Plasenta harus dipilih.");
        if (!penangananPlasenta) errors.push("Tindakan penanganan plasenta harus diisi.");
        if (!perdarahan) errors.push("Status perdarahan harus dipilih.");
        if (!tindakanPerdarahan) errors.push("Tindakan perdarahan harus diisi.");
        if (!masalahLain) errors.push("Masalah lain harus diisi.");
        if (!penatalaksanaan) errors.push("Penatalaksanaan harus diisi.");
        if (!hasil) errors.push("Hasil harus diisi.");

        // ✅ Validasi anomali isi textarea
        const anomaliText = (val, name) => {
            if (val.length < 5) errors.push(`${name} terlalu pendek.`);
            if (/^[0-9\s!@#$%^&*()_+\-=\\[\]{};':"\\|,.<>/?]+$/.test(val)) {
                errors.push(`${name} tidak boleh hanya angka/simbol.`);
            }
            if (val.length > 500) errors.push(`${name} terlalu panjang (maks. 500 karakter).`);
        };

        anomaliText(penangananPlasenta, "Tindakan penanganan plasenta");
        anomaliText(tindakanPerdarahan, "Tindakan perdarahan");
        anomaliText(masalahLain, "Masalah lain");
        anomaliText(penatalaksanaan, "Penatalaksanaan");
        anomaliText(hasil, "Hasil");

        // ✅ Tampilkan error jika ada
        if (errors.length > 0) {
            swal("Validasi Gagal", errors.join("\n"), "error");
            return false;
        }

        return true;
    }


    // Menyimpan data atau membuka modal konfirmasi
    $(btnID).on('click', function(e) {
        e.preventDefault();
        if ($(this).text() === 'Edit') {
            $(modalID).modal('show');
        } else {
            if (validasiFormKala3()) {
                let dataSaveStore = JSON.parse(localStorage.getItem(storageKey)) || {};
                const dataToSave = {
                    plasenta: $(`${formID} #plasenta`).val(),
                    penangananPlasenta: $(`${formID} #penangananPlasenta`).val(),
                    perdarahan: $(`${formID} #perdarahan`).val(),
                    tindakanPerdarahan: $(`${formID} #tindakanPerdarahan`).val(),
                    masalahLainKala3: $(`${formID} #masalahLainKala3`).val(),
                    penatalaksanaanKala3: $(`${formID} #penatalaksanaanKala3`).val(),
                    hasilKala3: $(`${formID} #hasilKala3`).val()
                };

                for (const key in dataToSave) {
                    if (dataSaveStore[key]) {
                        // Jika key sudah ada, perbarui value-nya saja
                        dataSaveStore[key].value = dataToSave[key];
                    } else {
                        // Jika key belum ada, buat objek baru tanpa id
                        dataSaveStore[key] = {
                            value: dataToSave[key]
                        };
                    }
                }



                localStorage.setItem(storageKey, JSON.stringify(dataSaveStore));
                swal("Berhasil", "Data berhasil disimpan.", "success");
                $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');
                disableForm();
            }
            
        }
    });

    // Konfirmasi Edit
    $(`${modalID} #confirmEditKala3`).on('click', function() {
        $(modalID).modal('hide');
        $(btnID).text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        enableForm();
    });

    // Fungsi menonaktifkan form
    function disableForm() {
        $(`${formID} select, ${formID} textarea`).prop('disabled', true);
    }

    // Fungsi mengaktifkan form
    function enableForm() {
        $(`${formID} select, ${formID} textarea`).prop('disabled', false);
    }
});
</script>