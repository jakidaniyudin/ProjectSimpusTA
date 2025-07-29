<div class="card">
    <div class="card-body" id="dataBayi">
        <form id="formBayi">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text-bold">Berat Bayi</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="beratBayi"
                                    oninput="updateInterpretasiBeratBayi()">
                            </div>
                            <div class="col-sm-6">
                                <p class="text-start">g</p>
                            </div>
                        </div>
                        <label class="form-group">Interpretasi Berat Bayi</label>
                        <select class="form-control" id="interpretasiBeratBayi" disabled>
                            <option value="" disabled selected>Choose...</option>
                            <option value="276613009">BBLB (Bayi Berat Lahir Besar) [>=4000gr]</option>
                            <option value="276712009">BBLC (Bayi Berat Lahir Cukup) [2500gr s/d 3999gr]</option>
                            <option value="276610007">BBLR (Bayi Berat Lahir Rendah) [1500gr s/d 2499gr]</option>
                            <option value="276611006">BBLSR (Bayi Berat Lahir Sangat Rendah) [1000gr s/d 1499gr]</option>
                            <option value="276612004">BLASR (Bayi Berat Lahir Amat Sangat Rendah) [< 1000gr]</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-bold">Panjang Bayi lahir</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="panjangBayi">
                            </div>
                            <div class="col-sm-6">
                                <p class="text-start">cm</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group">Lokasi Persalinan</label>
                        <select class="form-control" id="lokasiPersalinan">
                            <option value="264362003">Rumah</option>
                            <option value="OT000001">Polindes</option>
                            <option value="OT000002">Pustu</option>
                            <option value="104">Rumah Sakit Ibu dan Anak</option>
                            <option value="102">Puskesmas</option>
                            <option value="103">Klinik</option>
                            <option value="OT000008">Rumah Bersalin</option>
                            <option value="82242000">Rumah Sakit Ibu dan Anak</option>
                            <option value="OT000003">RS ODHA</option>
                            <option value="OT000004">Bidan Praktek Mandiri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-group">Inisiasi Menyusui Dini</label>
                        <select class="form-control" id="inisiasiMenyusui">
                            <option value="ya">Ya</option>
                            <option value="tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-group">Jika Ya, Waktu Inisiasi Menyusui Dini</label>
                        <select class="form-control" id="waktuInisiasi">
                            <option value="OV000014">Kurang dari 1 Jam</option>
                            <option value="OV000015">Lebih dari 1 Jam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm btn-block" type="button" id="simpanData">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function updateInterpretasiBeratBayi() {
    const beratBayi = parseFloat(document.getElementById('beratBayi').value);
    //mengambil elemen klasifikasi
    const interpretasiSelect = document.getElementById('interpretasiBeratBayi');
    if (beratBayi >= 4000) {
        interpretasiSelect.value = "276613009"; // BBLB
    } else if (beratBayi >= 2500 && beratBayi < 4000) {
        interpretasiSelect.value = "276712009"; // BBLC
    } else if (beratBayi >= 1500 && beratBayi < 2500) {
        interpretasiSelect.value = "276610007"; // BBLR
    } else if (beratBayi >= 1000 && beratBayi < 1500) {
        interpretasiSelect.value = "276611006"; // BBLSR
    } else if (beratBayi < 1000) {
        interpretasiSelect.value = "276612004"; // BLASR
    } else {
        interpretasiSelect.value = ""; // Jika tidak ada nilai yang valid
    }
}


$(document).ready(function() {
    const formId = 'formBayi'; // ID unik untuk menyimpan data form bayi ini
    // Fungsi untuk menyimpan data form ke localStorage


    function validateFormBayi() {
        const beratBayi = parseInt(document.getElementById("beratBayi").value);
        const panjangBayi = parseFloat(document.getElementById("panjangBayi").value);
        const interpretasiBerat = document.getElementById("interpretasiBeratBayi").value;
        const lokasiPersalinan = document.getElementById("lokasiPersalinan").value;
        const inisiasiMenyusui = document.getElementById("inisiasiMenyusui").value;
        const waktuInisiasi = document.getElementById("waktuInisiasi").value;

        // Validasi berat bayi
        if (isNaN(beratBayi)) {
            swal("Error", "Berat bayi harus diisi dan berupa angka.", "error");
            return false;
        }
        if (beratBayi < 300 || beratBayi > 6000) {
            swal("Error", "Berat bayi harus antara 300 - 6000 gram.", "error");
            return false;
        }

        // Validasi panjang bayi
        if (isNaN(panjangBayi)) {
            swal("Error", "Panjang bayi harus diisi dan berupa angka.", "error");
            return false;
        }
        if (panjangBayi < 30 || panjangBayi > 70) {
            swal("Error", "Panjang bayi harus antara 30 - 70 cm.", "error");
            return false;
        }

        // Validasi interpretasi berat
        if (!interpretasiBerat) {
            swal("Error", "Interpretasi berat bayi tidak valid. Harap isi berat dengan benar.", "error");
            return false;
        }

        // Validasi lokasi persalinan
        if (!lokasiPersalinan) {
            swal("Error", "Lokasi persalinan harus dipilih.", "error");
            return false;
        }

        // Validasi IMD
        if (!inisiasiMenyusui) {
            swal("Error", "Status inisiasi menyusui dini harus dipilih.", "error");
            return false;
        }

        // Validasi waktu IMD jika inisiasi = ya
        if (inisiasiMenyusui === "ya" && !waktuInisiasi) {
            swal("Error", "Waktu inisiasi menyusui dini harus dipilih jika dilakukan.", "error");
            return false;
        }

        return true;
    }
    function saveFormData() {
        let storeDataSaved = JSON.parse(localStorage.getItem(formId)) || {};

        const formData = {
            beratBayi: $('#beratBayi').val(),
            interpretasiBeratBayi: $('#interpretasiBeratBayi').val(),
            panjangBayi: $('#panjangBayi').val(),
            lokasiPersalinan: $('#lokasiPersalinan').val(),
            inisiasiMenyusui: $('#inisiasiMenyusui').val(),
            waktuInisiasi: $('#waktuInisiasi').val()
        };

        for (const key in formData) {
            if (storeDataSaved[key]) {
                // Jika key sudah ada, perbarui value-nya dan pertahankan id-nya
                storeDataSaved[key].value = formData[key];
            } else {
                // Jika key belum ada, buat objek baru tanpa id
                storeDataSaved[key] = {
                    value: formData[key]
                };
            }
        }

        localStorage.setItem(formId, JSON.stringify(storeDataSaved));
    }


    // Fungsi untuk memuat data dari localStorage
    function loadFormData() {
        const savedData = localStorage.getItem(formId);
        console.log('Data bayi dari localStorage:', savedData);

        if (savedData && savedData !== 'undefined') {
            try {
                const formData = JSON.parse(savedData);

                if (formData && typeof formData === 'object') {
                    editButtonChange('Edit');

                    $('#beratBayi').val(formData.beratBayi?.value || '');
                    $('#interpretasiBeratBayi').val(formData.interpretasiBeratBayi?.value || '');
                    $('#panjangBayi').val(formData.panjangBayi?.value || '');
                    $('#lokasiPersalinan').val(formData.lokasiPersalinan?.value || '');
                    $('#inisiasiMenyusui').val(formData.inisiasiMenyusui?.value || '');
                    $('#waktuInisiasi').val(formData.waktuInisiasi?.value || '');
                    return;
                }
            } catch (e) {
                console.warn('Gagal parse data dari localStorage:', e);
            }
        }

        // Data tidak ditemukan atau tidak valid
        editButtonChange(); // mode default

        const defaultValues = {
            beratBayi: '3000',
            interpretasiBeratBayi: 'Normal',
            panjangBayi: '48',
            lokasiPersalinan: 'Rumah Sakit',
            inisiasiMenyusui: 'Ya',
            waktuInisiasi: '30'
        };

        $('#beratBayi').val(defaultValues.beratBayi);
        $('#interpretasiBeratBayi').val(defaultValues.interpretasiBeratBayi);
        $('#panjangBayi').val(defaultValues.panjangBayi);
        $('#lokasiPersalinan').val(defaultValues.lokasiPersalinan);
        $('#inisiasiMenyusui').val(defaultValues.inisiasiMenyusui);
        $('#waktuInisiasi').val(defaultValues.waktuInisiasi);
    }
    $('#inisiasiMenyusui').on('change', function () {
        if ($(this).val() === 'ya') {
            $('#waktuInisiasi').closest('.form-group').slideDown();
        } else {
            $('#waktuInisiasi').closest('.form-group').slideUp();
            $('#waktuInisiasi').val('');
        }
    });

    // Sembunyikan di awal (jika belum diatur)
    if ($('#inisiasiMenyusui').val() !== 'ya') {
        $('#waktuInisiasi').closest('.form-group').hide();
    }


    // Panggil loadFormData untuk memuat data yang ada di localStorage saat halaman dimuat
    loadFormData();

    // Event listener untuk tombol simpan
    $('#simpanData').click(function (e) {
          e.preventDefault(); 
        if ($('#simpanData').text() === 'Simpan') {
            if (validateFormBayi()) {
                saveFormData(); // Simpan data saat tombol diklik
                editButtonChange('Edit');
                swal("Berhasil", "Data berhasil disimpan.", "success");
            }
        } else {
            // Tampilkan konfirmasi sebelum mengubah ke mode edit
            swal({
                title: "Aktifkan Form Edit?",
                text: "Data akan bisa diubah kembali. Lanjutkan?",
                icon: "warning",
                buttons: ["Batal", "Ya, Edit"],
                dangerMode: false,
            }).then((willEdit) => {
                if (willEdit) {
                    editButtonChange(); // masuk mode edit
                    swal("Form aktif", "Silakan ubah data.", "success");
                }
            });
        }
    });


    function editButtonChange(condition = null) {
        if (condition == 'Edit') {
            disableApgarForm(true);
            $('#simpanData').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        } else {
            disableApgarForm(false);
            $('#simpanData').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        }
    }

    function disableApgarForm(disable) {
        $('#dataBayi').find('input, select, textarea').prop('disabled',
            disable); // Menonaktifkan atau mengaktifkan berdasarkan parameter
    }
});
</script>