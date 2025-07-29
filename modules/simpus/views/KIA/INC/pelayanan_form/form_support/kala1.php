<div class="card">
    <div class="card-body">
        <form id="formkala1">
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Patogram Melalui Garis Waspada</label>
                        <select class="form-control" id="patogram">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <label class="mt-2">Deskripsi</label>
                        <textarea class="form-control" rows="3" id="deskripsi" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Masalah lain</label>
                        <textarea class="form-control" rows="3" id="masalahLain" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Penatalaksanaan Masalah</label>
                        <textarea class="form-control" rows="3" id="penatalaksanaan" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Hasilnya</label>
                        <textarea class="form-control" rows="3" id="hasil" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-success btn-sm btn-block" id="simpanKala1">Simpan</button>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </form>

    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal" tabindex="-1" role="dialog" id="editModalKala1">
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
                <button type="button" class="btn btn-primary" id="confirmEditKala1">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Mengambil data dari localStorage saat halaman dimuat
    const storedKala1 = JSON.parse(localStorage.getItem('dataKala1')) || {};
    console.log(storedKala1);
    if (Object.keys(storedKala1).length > 0) {
        // Disable semua elemen form
        $('#formkala1 select, #formkala1 textarea').prop('disabled', true);

        $('#patogram').val(storedKala1.patogram?.value || '');
        $('#deskripsi').val(storedKala1.deskripsi?.value || '');
        $('#masalahLain').val(storedKala1.masalahLain?.value || '');
        $('#penatalaksanaan').val(storedKala1.penatalaksanaan?.value || '');
        $('#hasil').val(storedKala1.hasil?.value || '');

        // Ubah tombol menjadi Edit
        $('#simpanKala1').text('Edit').removeClass('btn-success').addClass('btn-secondary');
    }
    function validasiFormKala1() {
        const patogram = document.getElementById('patogram').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();
        const masalahLain = document.getElementById('masalahLain').value.trim();
        const penatalaksanaan = document.getElementById('penatalaksanaan').value.trim();
        const hasil = document.getElementById('hasil').value.trim();

        let errors = [];

        // Validasi kosong
        if (!patogram) errors.push("Patogram harus dipilih.");
        if (!deskripsi) errors.push("Deskripsi harus diisi.");
        if (!masalahLain) errors.push("Masalah lain harus diisi.");
        if (!penatalaksanaan) errors.push("Penatalaksanaan harus diisi.");
        if (!hasil) errors.push("Hasil harus diisi.");

        // Validasi anomali input
        if (deskripsi.length < 5) errors.push("Deskripsi terlalu pendek, isi minimal 5 karakter.");
        if (/^[0-9\s!@#$%^&*()_+\-=\\[\]{};':"\\|,.<>/?]+$/.test(masalahLain)) {
            errors.push("Masalah lain tidak boleh hanya berisi angka/simbol.");
        }
        if (/^[0-9\s!@#$%^&*()_+\-=\\[\]{};':"\\|,.<>/?]+$/.test(penatalaksanaan)) {
            errors.push("Penatalaksanaan tidak boleh hanya berisi angka/simbol.");
        }
        if (hasil.length < 5) errors.push("Hasil terlalu pendek.");
        if (hasil.length > 500) errors.push("Hasil terlalu panjang (maksimal 500 karakter).");

        if (errors.length > 0) {
            swal("Validasi Gagal", errors.join("\n"), "error");
            return false;
        }

        return true;
    }

    // Menyimpan data ke localStorage atau membuka modal konfirmasi
    $('#simpanKala1').on('click', function(e) {
        e.preventDefault(); // Tambahkan untuk mencegah form submit

        if ($(this).text() === 'Edit') {
            $('#editModalKala1').modal('show');
        } else {

            if (validasiFormKala1()) {
                let storeDataSave = JSON.parse(localStorage.getItem('dataKala1')) || {};;
                const dataToSave = {
                    patogram: $('#patogram').val(),
                    deskripsi: $('#deskripsi').val(),
                    masalahLain: $('#masalahLain').val(),
                    penatalaksanaan: $('#penatalaksanaan').val(),
                    hasil: $('#hasil').val()
                };

                for (const key in dataToSave) {
                    if (storeDataSave[key]) {
                        // Jika key sudah ada, perbarui value-nya saja
                        storeDataSave[key].value = dataToSave[key];
                    } else {
                        // Jika key belum ada, buat objek baru tanpa id
                        storeDataSave[key] = {
                            value: dataToSave[key]
                        };
                    }
                }

                localStorage.setItem('dataKala1', JSON.stringify(storeDataSave));

                // Disable semua elemen form
                $('#formkala1 select, #formkala1 textarea').prop('disabled', true);

                // Ubah tombol menjadi Edit
                $('#simpanKala1').text('Edit').removeClass('btn-success').addClass('btn-secondary');
                swal("Berhasil", "Data berhasil disimpan ke localStorage!", "success");
            }
            
          
        }
    });

    // Konfirmasi Edit
    $('#confirmEditKala1').on('click', function() {

        $('#editModalKala1').modal('hide');

        // Enable semua elemen form
        $('#formkala1 select, #formkala1 textarea').prop('disabled', false);

        // Ubah tombol menjadi Simpan
        $('#simpanKala1').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
    });
});
</script>