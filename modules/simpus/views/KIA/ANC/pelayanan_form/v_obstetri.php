<div id="form1" class="form-container mt-4" style="display: block;">
    <h3>Pemeriksaan Obstetri</h3>
    <div class="row">
        <form id="pemeriksaanForm">
            <div class="col-md-6">
                <div class="card card-white">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Gravida</label>
                                    <select name="gravida" class="form-control">
                                        <?php for ($i = 0; $i <= 20; $i++) { ?>
                                        <option><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Partus</label>
                                    <select name="partus" class="form-control">
                                        <?php for ($i = 0; $i <= 20; $i++) { ?>
                                        <option><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Abortus</label>
                                    <select name="abortus" class="form-control">
                                        <?php for ($i = 0; $i <= 20; $i++) { ?>
                                        <option><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="TPHT">Tanggal TPHT</label>
                            <input type="date" class="form-control" id="TPHT" name="tanggal_tpht">
                        </div>
                        <div class="form-group">
                            <label for="beratBadan">Berat Badan Sebelum Hamil</label>
                            <input type="number" class="form-control" id="beratBadan" name="berat_badan"
                                placeholder="Masukkan berat badan">
                        </div>
                        <div class="form-group">
                            <label for="tinggiBadan">Tinggi Badan</label>
                            <input type="number" class="form-control" id="tinggiBadan" name="tinggi_badan"
                                placeholder="Masukkan tinggi badan">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="targetKenaikan">Target Kenaikan Berat Badan</label>
                                    <input type="text" class="form-control" id="targetKenaikan" name="target_kenaikan"
                                        placeholder="Masukkan target kenaikan" readonly>
                                </div>
                                <div class="col-lg-6 col-sm-6 d-flex align-items-end">
                                    <p class="mb-0 ml-3" style="margin-top: 30px;">Kg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="imt">IMT</label>
                                    <input name="imt" type="text" class="form-control" readonly id="imt">
                                </div>
                                <div class="col-sm-6">
                                    <label for="status">Status</label>
                                    <input name="status" type="text" class="form-control" readonly id="status">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputHamil">Jarak Kehamilan Saat ini dengan Sebelumnya</label>
                            <input type="text" class="form-control" id="inputHamil" name="jarak_kehamilan"
                                placeholder="Jarak hamil">
                        </div>
                        <div class="form-group">
                            <label>Status Imunisasi Tetanus</label>
                            <select name="statusImunisasi" id="imunisasiStatus" class="form-control">
                                <option value="belum pernah">Belum Pernah</option>
                                <option value="sudah pernah">Sudah Pernah</option>
                            </select>
                        </div>
                        <div id="imunisasiDetails" class="form-group" style="display: none;">
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="tanggalImunisasi<?= $i ?>">Tanggal Imunisasi <?= $i ?></label>
                                    <input type="date" class="form-control imunisasiDetails"
                                        id="tanggalImunisasi<?= $i ?>" name="tanggal_imunisasi_<?= $i ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label for="noBatch<?= $i ?>">No Batch</label>
                                    <input type="text" class="form-control imunisasiDetails" id="noBatch<?= $i ?>"
                                        name="no_batch_<?= $i ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label for="namaVaksin<?= $i ?>">Nama Vaksin</label>
                                    <input type="text" class="form-control imunisasiDetails" id="namaVaksin<?= $i ?>"
                                        name="nama_vaksin_<?= $i ?>">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" id="simpanButton" class="btn btn-success btn-sm btn-block"
                                data-mode="simpan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModalObstetri" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin membuka form untuk diedit?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="confirmEditButton" class="btn btn-primary">Ya, Edit</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var obstetri = <?= json_encode($obstetri); ?>;
    console.log(obstetri);

    // Fungsi untuk set semua input menjadi readonly
    function setFormReadonly(readonly) {
        $('#pemeriksaanForm input, #pemeriksaanForm select').prop('disabled', readonly);
        if (readonly) {
            $('#simpanButton')
                .removeClass('btn-success')
                .addClass('btn-secondary')
                .text('Edit')
                .data('mode', 'readonly'); // Gunakan .data() untuk mengatur mode
        } else {
            $('#simpanButton')
                .removeClass('btn-secondary')
                .addClass('btn-success')
                .text('Simpan')
                .data('mode', 'edit'); // Gunakan .data() untuk mengatur mode
        }
    }


    function getDataImunisasi(sourceData, parseJson = true) {
        const imunisasi = {};

        Object.entries(sourceData).forEach(([key, value]) => {
            if (key.startsWith("imunisasi_doss_") && value) {
                imunisasi[key] = parseJson ? JSON.parse(value) : value;
            }
        });

        return imunisasi;
    }

    // mengambil data imunisasi


    function isiFormImunisasi(imunisasiData) {
        if (typeof imunisasiData !== 'object' || imunisasiData === null) {
            console.warn("Data imunisasi tidak valid:", imunisasiData);
            return;
        }
        let check;
        for (let i = 1; i <= 5; i++) {
            const data = imunisasiData[`imunisasi_doss_${i}`];

            if (data && typeof data === 'object') {
                $(`#tanggalImunisasi${i}`).val(data.tanggal || "");
                $(`#noBatch${i}`).val(data.no_batch || "");
                $(`#namaVaksin${i}`).val(data.nama_vaksin || "");
                check = true;
            } else {
                $(`#tanggalImunisasi${i}`).val("");
                $(`#noBatch${i}`).val("");
                $(`#namaVaksin${i}`).val("");
                check = false;
            }
        }

        if(!check){
            swal("Pemberitahuan", "Pemberitahuan Imunisasi Belum Lengkap!", "warning");
        }
    }


    // Isi data ke dalam form jika obstetri ada
    if (obstetri) {
        const dataImunisasi = getDataImunisasi(obstetri);
        console.log(dataImunisasi);
        isiFormImunisasi(dataImunisasi);

        isiFormImunisasi()
        $('select[name="gravida"]').val(obstetri.gravida || '0'); // Default '0'
        $('select[name="partus"]').val(obstetri.partus || '0'); // Default '0'
        $('select[name="abortus"]').val(obstetri.abortus || '0'); // Default '0'
        $('#TPHT').val((obstetri.tphtDate ? obstetri.tphtDate.split(' ')[0] :
            '0000-00-00')); // Default '0000-00-00'
        $('#beratBadan').val(obstetri.bbSebelumHamil || '0'); // Default '0'
        $('#tinggiBadan').val(obstetri.tinggiBadan || '0'); // Default '0'
        $('#targetKenaikan').val(obstetri.bb_target || '0'); // Default '0'
        $('#imt').val(obstetri.imt || '0'); // Default '0'
        $('#status').val(obstetri.status_imt || 'Tidak Diketahui'); // Default 'Tidak Diketahui'
        $('#inputHamil').val(obstetri.jarak_hamil || '0'); // Default '0'
        $('#imunisasiStatus').val(obstetri.imunisasiTtStatus === "1" ? "sudah pernah" :
            "belum pernah"); // Default 'belum pernah'
        $('#imunisasiDetails').toggle(obstetri.imunisasiTtStatus === "1");
        // Set form readonly
        setFormReadonly(true);
    }
    $('#imunisasiStatus').change(function() {
        $('#imunisasiDetails').toggle($(this).val() === 'sudah pernah');
    });

    function setTargetKenaikanBerdasarkanIMT(imt) {

        var targetKenaikan = $('#targetKenaikan');
        console.log('imt adalah' + imt);
        if (!isNaN(imt)) {
            if (imt < 18.5) {
                // Underweight: 12-18 kg
                targetKenaikan.val('12,5-18');
            } else if (imt >= 18.5 && imt <= 22.9) {
                // Normal: 11-16 kg
                targetKenaikan.val('11,5-16');
            } else if (imt >= 23 && imt <= 24.9) {
                // Overweight: 7-11 kg
                targetKenaikan.val('7-11,5');
            } else if (imt >= 25) {
                // Obese: 5-9 kg
                targetKenaikan.val('5-9');
            }
        } else {
            targetKenaikan.val('');
        }
    }

    // Fungsi menghitung IMT
    function hitungIMT() {
        var beratBadan = parseFloat($('#beratBadan').val());
        var tinggiBadan = parseFloat($('#tinggiBadan').val());

        if (!isNaN(beratBadan) && !isNaN(tinggiBadan) && tinggiBadan > 0) {
            var tinggiBadanM = tinggiBadan / 100;
            var imt = beratBadan / (tinggiBadanM * tinggiBadanM);
            $('#imt').val(imt.toFixed(2));

            var status = imt < 18.5 ? "Kekurangan Berat Badan" :
                imt < 24.9 ? "Normal" :
                imt < 29.9 ? "Kelebihan Berat Badan" : "Obesitas";
            $('#status').val(status);
            // call the function to set target weight gain
            setTargetKenaikanBerdasarkanIMT(imt);
        } else {
            $('#imt').val('');
            $('#status').val('');
        }
    }
    $('#beratBadan, #tinggiBadan').on('input', hitungIMT);



    //validation #
    function validatePemeriksaanForm() {
        const form = document.getElementById('pemeriksaanForm');

        const gravida = parseInt(form.gravida.value);
        const partus = parseInt(form.partus.value);
        const abortus = parseInt(form.abortus.value);
        const tanggalTPHT = form.tanggal_tpht.value;
        const beratBadan = parseFloat(form.berat_badan.value);
        const tinggiBadan = parseFloat(form.tinggi_badan.value);
        const jarakKehamilan = form.jarak_kehamilan.value;

        // Validasi logis dasar
        if (gravida < (partus + abortus)) {
            swal("Error", "Jumlah Gravida tidak boleh lebih kecil dari jumlah Partus + Abortus.", "error");
            return false;
        }

        if (!tanggalTPHT) {
            swal("Error", "Tanggal TPHT harus diisi.", "error");
            return false;
        }

        if (new Date(tanggalTPHT) > new Date()) {
            swal("Error", "Tanggal TPHT tidak boleh di masa depan.", "error");
            return false;
        }

        if (beratBadan <= 0 || isNaN(beratBadan)) {
            swal("Error", "Berat badan harus diisi dengan angka lebih dari 0.", "error");
            return false;
        }

        if (tinggiBadan <= 0 || isNaN(tinggiBadan)) {
            swal("Error", "Tinggi badan harus diisi dengan angka lebih dari 0.", "error");
            return false;
        }

        if (jarakKehamilan && isNaN(parseInt(jarakKehamilan))) {
            swal("Error", "Jarak kehamilan harus berupa angka.", "error");
            return false;
        }

        // Validasi imunisasi
        const statusImunisasi = form.statusImunisasi.value;
        if (statusImunisasi === "sudah pernah") {
            const rows = document.querySelectorAll('.imunisasiDetails');
            for (let i = 1; i <= 5; i++) {
                const tanggal = document.getElementById(`tanggalImunisasi${i}`).value;
                const batch = document.getElementById(`noBatch${i}`).value;
                const vaksin = document.getElementById(`namaVaksin${i}`).value;

                const isAnyFilled = tanggal || batch || vaksin;
                const isAllFilled = tanggal && batch && vaksin;

                if (isAnyFilled && !isAllFilled) {
                    swal("Error", `Data imunisasi ${i} belum lengkap. Isi tanggal, batch, dan nama vaksin.`, "error");
                    return false;
                }

                if (tanggal && new Date(tanggal) > new Date()) {
                    swal("Error", `Tanggal imunisasi ${i} tidak boleh di masa depan.`, "error");
                    return false;
                }
            }
        }

        return true;
    }
    // Event untuk tombol edit/simpan
    $('#simpanButton').on('click', function() {

        var mode = $(this).data('mode'); // Ambil mode menggunakan .data()
        console.log('Mode saat ini:', mode);
        // Serialize data form

        var formInputs = $('#pemeriksaanForm :input');
        

        // Filter: ambil yang bukan bagian dari imunisasiDetails
        var dataUtama = formInputs.filter(function() {
            return $(this).closest('#imunisasiDetails').length === 0;
        }).serializeArray();
        dataUtama.push({
            name: 'pasien_id',
            value: '<?= $pasien_id ?>'
        }, {
            name: 'loket_id',
            value: '<?= $loket_id ?>'
        }, {
            name: 'actv_service',
            value: actv_service
        }, {
            name: 'id_dokter',
            value: '<?= $item["kdDokter"] ?>'
        }, {
            name: 'start',
            value: '<?= $start ?>'
        });
        // Ambil data imunisasi secara terpisah
        var dataImunisasi = $('#imunisasiDetails :input').serializeArray();

        var formData = {
            pemeriksaan: BatchDataObsetri(dataUtama),
            imunisasi: BatchDataObsetri(dataImunisasi)
        }
        console.log(formData);

        // Logika berdasarkan mode
        if (mode === 'readonly') {
            // Tampilkan modal konfirmasi untuk mengubah ke mode edit
            $('#editModalObstetri').modal('show');
        } else if (mode === 'edit' || mode === 'simpan') {
            if (!validatePemeriksaanForm()) {
                return;
            }
            // Kirim data melalui AJAX untuk mode edit atau simpan
            $.ajax({
                url: '<?= base_url('/simpus/ANC/setObsetri') ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    swal('Berhasil', 'Data berhasil disimpan', 'success');
                    setFormReadonly(true);
                    if (mode === 'simpan') {
                        $('#simpanButton').data('mode', 'edit');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi error:', error);

                    let errorMessage = "Terjadi kesalahan saat mengirim data.";

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        const messages = Object.values(errors).map(msg => `• ${msg}`);
                        errorMessage = messages.join('\n'); // Pakai newline karena swal v1 tidak support HTML
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    swal("Validasi Gagal", errorMessage, "error");
                }
            });

        } else {
            console.warn('Mode tidak dikenali:', mode);
        }
    });


    function BatchDataObsetri(array) {
        const result = {};
        array.forEach(function(item) {
            result[item.name] = item.value;
        });
        return result;
    }

    function barchDataImunisasiStatus(array) {
        return arr.map(item => {
            return {
                [item.name]: {
                    value: item.value
                }
            };
        });
    }
    // Event konfirmasi di modal
    $('#confirmEditButton').on('click', function() {
        setFormReadonly(false); // Set form menjadi bisa diedit
        $('#editModalObstetri').modal('hide'); // Tutup modal
    });
});
</script>