<br>
<div class="card">
    <div class="card-body">
        <form id="formkala2">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="patogramGaris">Patogram Melalui Garis Waspada</label>
                        <select class="form-control" id="patogramGaris">
                            <option>Ya</option>
                            <option>Tidak</option>
                        </select>
                        <label class="mt-2" for="indikasiPatogram">Indikasi (Ya)</label>
                        <textarea class="form-control" id="indikasiPatogram" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gawatJanin">Gawat Janin</label>
                        <select class="form-control" id="gawatJanin">
                            <option>Ya</option>
                            <option>Tidak</option>
                        </select>
                        <label class="mt-2" for="tindakanGawat">Tindakan Yang Dilakukan (Ya)</label>
                        <textarea class="form-control" id="tindakanGawat" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="distosiaBahu">Distosia Bahu</label>
                        <select class="form-control" id="distosiaBahu">
                            <option>Ya</option>
                            <option>Tidak</option>
                        </select>
                        <label class="mt-2" for="tindakanDistosia">Tindakan Yang Dilakukan (Ya)</label>
                        <textarea class="form-control" id="tindakanDistosia" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="mt-2" for="masalahLain">Masalah Lain</label>
                        <textarea class="form-control" id="masalahLain" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2" for="penatalaksanaan">Penatalaksanaan Masalah</label>
                        <textarea class="form-control" id="penatalaksanaan" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2" for="hasilMasalah">Hasilnya</label>
                        <textarea class="form-control" id="hasilMasalah" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm btn-block" id="simpanButtonKala2">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal" tabindex="-1" role="dialog" id="editModalKala2">
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
                <button type="button" class="btn btn-primary" id="confirmEditKala2">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const formID = '#formkala2';
    const storageKey = 'dataKala2';
    const btnID = '#simpanButtonKala2';
    const modalID = '#editModalKala2';

    // Mengambil data dari localStorage saat halaman dimuat
    const storedData = JSON.parse(localStorage.getItem(storageKey)) || {};
    console.log(storedData);
    if (Object.keys(storedData).length > 0) {
        // Isi data dari localStorage
        $(`${formID} #patogramGaris`).val(storedData.patogramGaris?.value || 'Ya');
        $(`${formID} #indikasiPatogram`).val(storedData.indikasiPatogram?.value || '');
        $(`${formID} #gawatJanin`).val(storedData.gawatJanin?.value || 'Ya');
        $(`${formID} #tindakanGawat`).val(storedData.tindakanGawat?.value || '');
        $(`${formID} #distosiaBahu`).val(storedData.distosiaBahu?.value || 'Ya');
        $(`${formID} #tindakanDistosia`).val(storedData.tindakanDistosia?.value || '');
        $(`${formID} #masalahLain`).val(storedData.masalahLain?.value || '');
        $(`${formID} #penatalaksanaan`).val(storedData.penatalaksanaan?.value || '');
        $(`${formID} #hasilMasalah`).val(storedData.hasilMasalah?.value || '');

        // Ubah tombol menjadi Edit
        $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');

        // Nonaktifkan form
        disableForm();
    }

    function validasiFormKala2() {
        const patogramGaris = document.getElementById('patogramGaris').value.trim();
        const indikasiPatogram = document.getElementById('indikasiPatogram').value.trim();
        const gawatJanin = document.getElementById('gawatJanin').value.trim();
        const tindakanGawat = document.getElementById('tindakanGawat').value.trim();
        const distosiaBahu = document.getElementById('distosiaBahu').value.trim();
        const tindakanDistosia = document.getElementById('tindakanDistosia').value.trim();
        const masalahLain = document.getElementById('masalahLain').value.trim();
        const penatalaksanaan = document.getElementById('penatalaksanaan').value.trim();
        const hasilMasalah = document.getElementById('hasilMasalah').value.trim();

        let errors = [];

        // ✅ Validasi kosong
        if (!patogramGaris) errors.push("Patogram harus dipilih.");
        if (!indikasiPatogram) errors.push("Indikasi patogram harus diisi.");
        if (!gawatJanin) errors.push("Gawat janin harus dipilih.");
        if (!tindakanGawat) errors.push("Tindakan gawat janin harus diisi.");
        if (!distosiaBahu) errors.push("Distosia bahu harus dipilih.");
        if (!tindakanDistosia) errors.push("Tindakan distosia harus diisi.");
        if (!masalahLain) errors.push("Masalah lain harus diisi.");
        if (!penatalaksanaan) errors.push("Penatalaksanaan harus diisi.");
        if (!hasilMasalah) errors.push("Hasil harus diisi.");

        // ✅ Validasi anomali input teks
        const anomaliText = (val, name) => {
            if (val.length < 5) errors.push(`${name} terlalu pendek.`);
            if (/^[0-9\s!@#$%^&*()_+\-=\\[\]{};':"\\|,.<>/?]+$/.test(val)) {
                errors.push(`${name} tidak boleh hanya berisi angka/simbol.`);
            }
            if (val.length > 500) errors.push(`${name} terlalu panjang (maks. 500 karakter).`);
        };

        anomaliText(indikasiPatogram, "Indikasi patogram");
        anomaliText(tindakanGawat, "Tindakan gawat janin");
        anomaliText(tindakanDistosia, "Tindakan distosia");
        anomaliText(masalahLain, "Masalah lain");
        anomaliText(penatalaksanaan, "Penatalaksanaan");
        anomaliText(hasilMasalah, "Hasil");

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
            if (validasiFormKala2()) {
                let dataSaveStore = JSON.parse(localStorage.getItem(storageKey)) || {};;
                const dataToSave = {
                    patogramGaris: $(`${formID} #patogramGaris`).val(),
                    indikasiPatogram: $(`${formID} #indikasiPatogram`).val(),
                    gawatJanin: $(`${formID} #gawatJanin`).val(),
                    tindakanGawat: $(`${formID} #tindakanGawat`).val(),
                    distosiaBahu: $(`${formID} #distosiaBahu`).val(),
                    tindakanDistosia: $(`${formID} #tindakanDistosia`).val(),
                    masalahLain: $(`${formID} #masalahLain`).val(),
                    penatalaksanaan: $(`${formID} #penatalaksanaan`).val(),
                    hasilMasalah: $(`${formID} #hasilMasalah`).val()
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
                $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');
                disableForm();
                swal("Berhasil", "Data berhasil disimpan ke localStorage!", "success");
            }
           
        }
    });

    // Konfirmasi Edit
    $(`${modalID} #confirmEditKala2`).on('click', function() {
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