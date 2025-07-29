<div class="card">
    <div class="card-body">
        <form id="formKeadaanIbu">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Keadaan Ibu</label>
                        <select class="form-control" id="keadaanIbu">
                            <option value="102514002">Sehat</option>
                            <option value="39104002">Sakit</option>
                            <option value="47821001">Perdarahan</option>
                            <option value="386661006">Demam</option>
                            <option value="386661006">Kejang</option>
                            <option value="249215002">Lokhia Berbau</option>
                            <option value="74964007">Lain - lain</option>
                        </select>
                        <label class="mt-2">Deskripsi (lainnya)</label>
                        <textarea class="form-control" id="deskripsiKeadaanIbu" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Penolong Persalinan</label>
                        <select class="form-control" id="penolongPersalinan">
                            <option value="303071001">Keluarga</option>
                            <option value="OV000012">Dukun</option>
                            <option value="309453006">Bidan</option>
                            <option value="309343006">Dokter</option>
                            <option value="11935004">Dokter Spesialis</option>
                            <option value="249215002">Lokhia Berbau</option>
                        </select>
                        <label class="mt-2">Deskripsi (lainnya)</label>
                        <textarea class="form-control" id="deskripsiPenolong" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="caraPersalinan" class="form-group">Cara Persalinan</label>
                        <select name="" id="caraPersalinan" class="form-control">
                            <option value="48782003">Normal</option>
                            <option value="200138003">Vakum</option>
                            <option value="200130005">Forceps</option>
                            <option value="200144004">Sectio caesaria</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block btn-sm" id="simpanButtonKeadaanIbu"
                            type="button">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    const formID = '#formKeadaanIbu';
    const storageKey = 'dataKeadaanIbu';
    const btnID = '#simpanButtonKeadaanIbu';

    // Mengambil data dari localStorage saat halaman dimuat
    const storedData = JSON.parse(localStorage.getItem(storageKey)) || {};
    console.log('data persalinan');
    console.log(storedData);

    if (Object.keys(storedData).length > 0) {
        // Isi data dari localStorage
        $(`${formID} #keadaanIbu`).val(storedData.keadaanIbu?.value || '1');
        $(`${formID} #deskripsiKeadaanIbu`).val(storedData.deskripsiKeadaanIbu?.value || '');
        $(`${formID} #penolongPersalinan`).val(storedData.penolongPersalinan?.value || '1');
        $(`${formID} #deskripsiPenolong`).val(storedData.deskripsiPenolong?.value || '');
        $(`${formID} #caraPersalinan`).val(storedData.caraPersalinan?.value || '1');

        // Ubah tombol menjadi Edit
        $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');

        // Nonaktifkan form
        disableForm();
    }

    // Menyimpan data atau mengaktifkan form untuk edit
    $(btnID).on('click', function(e) {
        e.preventDefault();
        if ($(this).text() === 'Edit') {
            $(this).text('Simpan').removeClass('btn-secondary').addClass('btn-success');
            enableForm();
        } else {
            const dataToSave = {
                keadaanIbu: $(`${formID} #keadaanIbu`).val(),
                deskripsiKeadaanIbu: $(`${formID} #deskripsiKeadaanIbu`).val(),
                penolongPersalinan: $(`${formID} #penolongPersalinan`).val(),
                deskripsiPenolong: $(`${formID} #deskripsiPenolong`).val(),
                caraPersalinan: $(`${formID} #caraPersalinan`).val()
            };

            for (const key in dataToSave) {
                if (storedData[key]) {
                    // Jika key sudah ada, perbarui value-nya saja
                    storedData[key].value = dataToSave[key];
                } else {
                    // Jika key belum ada, buat objek baru tanpa id
                    storedData[key] = {
                        value: dataToSave[key]
                    };
                }
            }


            localStorage.setItem(storageKey, JSON.stringify(storedData));
            swal('Simpan', 'Data berhasil disimpan', 'success');
            $(btnID).text('Edit').removeClass('btn-success').addClass('btn-secondary');
            disableForm();
        }
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