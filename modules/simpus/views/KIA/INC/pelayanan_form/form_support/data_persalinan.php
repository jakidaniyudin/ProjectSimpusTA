<div class="card">
    <div class="card-body">
        <p class="text-bold">Data Kunjungan Persalinan</p>
        <form id="formKunjunganPersalinan">
        <div class="row">
            <div class="col-lg-6">

                <div class="form-group">
                    <label for="usiaKehamilan">Usia Kehamilan</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" id="usiaKehamilan" type="number" placeholder="Default input">
                        </div>
                        <div class="col-sm-6">
                            <p class="text-bold text-start">Minggu</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="tanggalPersalinan">Tanggal Persalinan</label>
                            <input class="form-control" id="tanggalPersalinan" type="date" placeholder="Default input">
                        </div>
                        <div class="col-sm-6">
                            <label for="waktuPersalinan">Waktu</label>
                            <input class="form-control" id="waktuPersalinan" type="time" placeholder="Default input">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="gravida">Gravida</label>
                            <select name="gravida" id="gravida" class="form-control">
                                <?php for ($i = 0; $i <= 20; $i++) { ?>
                                <option><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="partus">Partus</label>
                            <select name="partus" id="partus" class="form-control">
                                <?php for ($i = 0; $i <= 20; $i++) { ?>
                                <option><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="abortus">Abortus</label>
                            <select name="abortus" id="abortus" class="form-control">
                                <?php for ($i = 0; $i <= 20; $i++) { ?>
                                <option><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn  btn-sm btn-block btn-success mt-2" type="button"
                        id="simpanButton">Simpan</button>
                </div>

            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal" tabindex="-1" role="dialog" id="editModal">
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
                <button type="button" class="btn btn-success" id="confirmEdit">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Mengambil data dari localStorage saat halaman dimuat
    let storedData = JSON.parse(localStorage.getItem('kunjunganPersalinan')) || {};
    if (Object.keys(storedData).length > 0) {
        $('#usiaKehamilan').val(storedData.usiaKehamilan?.value || 0);
        $('#tanggalPersalinan').val(storedData.tanggalPersalinan?.value || '');
        $('#waktuPersalinan').val(storedData.waktuPersalinan?.value || '');
        $('#gravida').val(storedData.gravida?.value || 1);
        $('#partus').val(storedData.partus?.value || 1);
        $('#abortus').val(storedData.abortus?.value || 1);

        // Ubah tombol menjadi Edit
        $('#simpanButton').text('Edit').removeClass('btn-success').addClass('btn-secondary');

        // Disable form elements
        disableForm();
    }

    function validasiFormKunjunganPersalinan() {
        const usiaKehamilan = parseInt(document.getElementById('usiaKehamilan').value.trim());
        const tanggalPersalinan = document.getElementById('tanggalPersalinan').value.trim();
        const waktuPersalinan = document.getElementById('waktuPersalinan').value.trim();
        const gravida = parseInt(document.getElementById('gravida').value);
        const partus = parseInt(document.getElementById('partus').value);
        const abortus = parseInt(document.getElementById('abortus').value);

        let errors = [];

        if (isNaN(usiaKehamilan) || usiaKehamilan < 0 || usiaKehamilan > 50) {
            errors.push("Usia kehamilan harus diisi dan antara 0–50 minggu.");
        }

        if (!tanggalPersalinan) {
            errors.push("Tanggal persalinan harus diisi.");
        }

        if (!waktuPersalinan) {
            errors.push("Waktu persalinan harus diisi.");
        }

        if (isNaN(gravida) || isNaN(partus) || isNaN(abortus)) {
            errors.push("Gravida, Partus, dan Abortus harus dipilih.");
        }

        if (gravida < 0 || partus < 0 || abortus < 0) {
            errors.push("Gravida, Partus, dan Abortus tidak boleh negatif.");
        }

        if (gravida < (partus + abortus)) {
            errors.push("Jumlah Partus + Abortus tidak boleh melebihi Gravida.");
        }

        if (errors.length > 0) {
            swal("Validasi Gagal", errors.join("\n"), "error");
            return false;
        }

        return true;
    }

    // Menyimpan data ke localStorage atau membuka modal konfirmasi
    $('#simpanButton').on('click', function() {
        if ($(this).text() === 'Edit') {
            $('#editModal').modal('show');
        } else {
            if (validasiFormKunjunganPersalinan()) {
                const dataToSave = {
                usiaKehamilan: $('#usiaKehamilan').val(),
                tanggalPersalinan: $('#tanggalPersalinan').val(),
                waktuPersalinan: $('#waktuPersalinan').val(),
                gravida: $('#gravida').val(),
                partus: $('#partus').val(),
                abortus: $('#abortus').val()
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

                localStorage.setItem('kunjunganPersalinan', JSON.stringify(storedData));
              
                // Ubah tombol menjadi Edit
                $('#simpanButton').text('Edit').removeClass('btn-success').addClass('btn-secondary');

                // Disable form elements
                disableForm();
                swal("Berhasil", "Data kunjungan persalinan berhasil disimpan di local.", "success");
            }
        }
    });

    // Konfirmasi Edit
    $('#confirmEdit').on('click', function() {
        $('#editModal').modal('hide');
        $('#simpanButton').text('Simpan').removeClass('btn-secondary').addClass('btn-success');

        // Enable form elements
        enableForm();
    });

    // Fungsi untuk menonaktifkan semua form elemen
    function disableForm() {
        $('#usiaKehamilan, #tanggalPersalinan, #waktuPersalinan, #gravida, #partus, #abortus').prop('disabled',
            true);
    }

    // Fungsi untuk mengaktifkan semua form elemen
    function enableForm() {
        $('#usiaKehamilan, #tanggalPersalinan, #waktuPersalinan, #gravida, #partus, #abortus').prop('disabled',
            false);
    }
});
</script>