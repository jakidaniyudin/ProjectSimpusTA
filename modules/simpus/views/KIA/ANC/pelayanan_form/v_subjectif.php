<div id="form2" class="form-container">
    <h3>Pemeriksaan Pasien / Subjektif <?= $pasien_id ?></h3>

    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-danger" id="custom-tabs-three-home-tab" data-toggle="pill"
                        href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                        aria-selected="true">Data Kunjungan ANC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Pemantauan dan Riwayat >></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <!-- Tab 1: Data Kunjungan ANC -->
                <div class="tab-pane fade in active" id="custom-tabs-three-home" role="tabpanel"
                    aria-labelledby="custom-tabs-three-home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <form id="KunjunganAnc">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                            <input name="tanggal_kunjungan" type="date" class="form-control"
                                                id="tanggal_kunjungan">
                                        </div>
                                        <div class="form-group">
                                            <label>Usia Kehamilan</label>
                                            <input name="usia_kehamilan" type="text" class="form-control"
                                                id="usia_kehamilan">
                                        </div>
                                        <div class="form-group">
                                            <label>Trimester Ke</label>
                                            <select name="trimester" class="form-control" id="trimester">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <button id="buttonKunjungan" type="button"
                                                class="btn btn-success btn-sm btn-block">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Pemantauan dan Riwayat -->
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">
                    <form id="pemantauan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <h5 class="title">Pemantauan dan Pendampingan</h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>1. Terlalu muda usia melahirkan dibawah 20 tahun</label>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="terlalu_mudah" value="ya">
                                                                <label class="form-check-label">Ya</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="terlalu_mudah" value="tidak">
                                                                <label class="form-check-label">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>2. Terlalu rapat jarak kelahiran (< 2 tahun)</label>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="terlalu_rapat" value="ya">
                                                                        <label class="form-check-label">Ya</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="terlalu_rapat" value="tidak">
                                                                        <label class="form-check-label">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>3. Terlalu tua (kehamilan di atas 35 tahun)</label>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="terlalu_tua" value="ya">
                                                                <label class="form-check-label">Ya</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="terlalu_tua" value="tidak">
                                                                <label class="form-check-label">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>4. Terlalu sering melahirkan (anak > 3)</label>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sering_melahirkan" value="ya">
                                                                <label class="form-check-label">Ya</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sering_melahirkan" value="tidak">
                                                                <label class="form-check-label">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="title text-bold">A. Komplikasi dan Penyulit Kehamilan</h4>
                                        <div class="form-group" id="code-komplikasi">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Code Komplikasi</label>
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <?php
                                                            print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                            print form_input('kdDiagnosa', '', 'class="form-control input-sm" required readonly="readonly"');
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-sm">
                                                                <?php
                                                                print form_input('nmDiagnosa', '', 'class="form-control input-sm" readonly="readonly"');
                                                                ?>
                                                                <div class="input-group-btn">
                                                                    <button type="button" id='cari_diagnosa'
                                                                        class="btn btn-info btn-flat">Cari</button>
                                                                    <button type="button" id='del_diagnosa'
                                                                        class="btn btn-danger btn-flat">Del</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Deskripsi Komplikasi</label>
                                                    <textarea class="form-control" name="komplikasi" rows="3"
                                                        placeholder="Masukkan deskripsi..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="riwayat-pribadi">
                                            <label>B. Riwayat Penyakit Menular Pribadi</label>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <?php
                                                    print form_hidden('codeSystemPribadi', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    print form_hidden('sourceOfCodePribadi', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    print form_input('codePribadi', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    ?>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-sm">
                                                        <?php
                                                        print form_input('valueSetPribadi', '', 'class="form-control input-sm" readonly="readonly"');
                                                        ?>
                                                        <div class="input-group-btn">
                                                            <button type="button" id='cari_riwayat_pribadi'
                                                                class="btn btn-info btn-flat">Cari</button>
                                                            <button type="button" id='del_riwayat_pribadi'
                                                                class="btn btn-danger btn-flat">Del</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber</label>
                                            <select class="form-control" name="sumber_penyakit_menular">
                                                <option>Non Clinic</option>
                                                <option>Clinic</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_penyakit_menular" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                        <div class="form-group" id="riwayat-keluarga">
                                            <label>C. Riwayat Penyakit Keluarga</label>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <?php
                                                    print form_hidden('codeSystemKeluarga', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    print form_hidden('sourceOfCodeKeluarga', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    print form_input('codeKeluarga', '', 'class="form-control input-sm" required readonly="readonly"');
                                                    ?>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-sm">
                                                        <?php
                                                        print form_input('valueSetKeluarga', '', 'class="form-control input-sm" readonly="readonly"');
                                                        ?>
                                                        <div class="input-group-btn">
                                                            <button type="button" id='cari_riwayat_keluarga'
                                                                class="btn btn-info btn-flat">Cari</button>
                                                            <button type="button" id='del_riwayat_Keluarga'
                                                                class="btn btn-danger btn-flat">Del</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber</label>
                                            <select class="form-control" name="sumber_penyakit_keluarga">
                                                <option>Non Clinic</option>
                                                <option>Clinic</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_penyakit_keluarga" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Status Merokok</label>
                                            <select class="form-control" name="status_merokok">
                                                <option>Aktif</option>
                                                <option>Pasif</option>
                                                <option>Tidak Merokok</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_merokok" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Alkohol</label>
                                            <select class="form-control" name="status_alkohol">
                                                <option>Aktif</option>
                                                <option>Tidak Aktif</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_alkohol" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Apakah Disabilitas</label>
                                            <select class="form-control" name="status_disabilitas">
                                                <option>Aktif</option>
                                                <option>Tidak</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_disabilitas" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Apakah Mengikuti Kelas Ibu Hamil</label>
                                            <select class="form-control" name="kelas_ibu_hamil">
                                                <option>Ya</option>
                                                <option>Tidak</option>
                                            </select>
                                            <label class="mt-2">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_kelas_ibu_hamil" rows="3"
                                                placeholder="Masukkan deskripsi..."></textarea>
                                        </div>
                                        <div class="form-group mt-2">
                                            <button type="button" class="btn btn-success btn-sm btn-block"
                                                id="saveButton">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmEditModal" tabindex="-1" role="dialog" aria-labelledby="confirmEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmEditModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengedit data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class=" modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengedit data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmEditPemantauan">Ya, Edit</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function disablePemantauanFormInputs() {
  // Dapatkan form dengan ID 'pemantauan'
  const $form = $('#pemantauan');

  if ($form.length) {
    // List section ID di dalam form yang ingin kita disable
    const sections = ['#code-komplikasi', '#riwayat-pribadi', '#riwayat-keluarga'];

    sections.forEach(function(sectionId) {
      const $section = $form.find(sectionId);

      if ($section.length) {
        // Nonaktifkan input, select, textarea, button
        $section.find('input, select').prop('disabled', true);

        // Warnai input yang terlihat (bukan hidden), select, textarea
        $section.find('input:not([type="hidden"]), select').css({
          'background-color': '#fff3cd',
          'border-color': '#ffeeba'
        });
      }
    });
  }
}


$(document).ready(function() {
    const form = $('#pemantauan');
    const saveButton = $('#saveButton');
    let data = null;

    disablePemantauanFormInputs();
    $('#cari_diagnosa').on('click', function(event) {
        event.preventDefault();
        cari_diagnosa('1');
    })
    $('#cari_riwayat_pribadi').on('click', function(event) {
        event.preventDefault();
        cari_riwayat_penyakit_pribadi('1');
    })
    $('#del_riwayat_pribadi').on('click', function(event) {
        event.preventDefault();
        del_riwayat_penyakit_pribadi();
    })

    $('#cari_riwayat_keluarga').on('click', function(event) {
        event.preventDefault();
        cari_riwayat_keluarga('1');
    })
    $('#del_riwayat_Keluarga').on('click', function(event) {
        event.preventDefault();
        del_riwayat_penyakit_keluarga('1');
    })

    $('#del_diagnosa').on('click', function(event) {
        event.preventDefault();
        del_diagnosa('1');
    })

    function cari_diagnosa(n) {

        ajaxmodal('<?php echo base_url() ?>simpus/diagnosa/pop/' + n);

    }

    function del_diagnosa(n) {

        $('input[name=kdDiagnosa]').val('');
        $('input[name=nmDiagnosa]').val('');

    }

    function cari_riwayat_penyakit_pribadi(n) {
        ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/popUpRiwayatPribadi/' + n);
    }

    function del_riwayat_penyakit_pribadi() {
        $('input[name=codePribadi]').val('');
        $('input[name=valueSetPribadi]').val('');
        $('input[name=codeSystemPribadi]').val('');
        $('input[name=sourceOfCodePribadi]').val('');
    }

    function cari_riwayat_keluarga(n) {
        ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/popUpRiwayatKeluarga/' + n);
    }

    function del_riwayat_penyakit_keluarga() {
        $('input[name=codeKeluarga]').val('');
        $('input[name=valueSetKeluarga]').val('');
        $('input[name=codeSystemKeluarga').val('');
        $('input[name=sourceOfCodeKeluarga]').val('');
    }

    // Cek Local Storage saat halaman dimuat
    if (localStorage.getItem('kunjunganData')) {
        data = JSON.parse(localStorage.getItem('kunjunganData'));
        $('#tanggal_kunjungan').val(data.tanggal_kunjungan.value);
        $('#usia_kehamilan').val(data.usia_kehamilan.value);
        $('#trimester').val(data.trimester.value);
        $('#buttonKunjungan').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        $('#KunjunganAnc input, #KunjunganAnc select').prop('disabled', true);
    }

    // set tanggal kunjunganData
    function validateKunjunganAnc() {
        const form = document.getElementById('KunjunganAnc');
        if (!form) {
            console.error('Form #KunjunganAnc tidak ditemukan!');
            return false;
        }

        const tanggal = form.querySelector('#tanggal_kunjungan').value.trim();
        const usia = form.querySelector('#usia_kehamilan').value.trim();
        const trimester = form.querySelector('#trimester').value.trim();

        // ---------- Validasi Tanggal ----------
        if (!tanggal) {
            swal("Error", "Tanggal Kunjungan harus diisi", "error");
            return false;
        }

        const tanggalRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!tanggalRegex.test(tanggal)) {
            swal("Error", "Format Tanggal Kunjungan tidak valid (yyyy-mm-dd)", "error");
            return false;
        }

        const inputDate = new Date(tanggal + 'T00:00:00'); // Pakai waktu lokal 00:00
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set jam ke 00:00 juga

        if (isNaN(inputDate.getTime())) {
            swal("Error", "Tanggal Kunjungan tidak valid", "error");
            return false;
        }

        if (inputDate > today) {
            swal("Error", "Tanggal Kunjungan tidak boleh lebih dari hari ini", "error");
            return false;
        }

        // ---------- Validasi Usia Kehamilan ----------
        if (!usia) {
            swal("Error", "Usia Kehamilan harus diisi", "error");
            return false;
        }

        const angkaBulatRegex = /^\d+$/;
        if (!angkaBulatRegex.test(usia)) {
            swal("Error", "Usia Kehamilan harus berupa angka bulat positif", "error");
            return false;
        }

        if (Number(usia) <= 0) {
            swal("Error", "Usia Kehamilan harus lebih dari 0", "error");
            return false;
        }

        // ---------- Validasi Trimester ----------
        if (!["1", "2", "3"].includes(trimester)) {
            swal("Error", "Trimester harus dipilih dengan benar (1, 2, atau 3)", "error");
            return false;
        }

        // ✅ Semua validasi lolos
        return true;
    }



    // Simpan data ke Local Storage
    $('#buttonKunjungan').on('click', function(event) {
        event.preventDefault(); // Mencegah form dari pengiriman default
        if ($(this).text() === 'Simpan') {
            if (validateKunjunganAnc()) {
                    const formData = {
                    tanggal_kunjungan: $('#tanggal_kunjungan').val(),
                    usia_kehamilan: $('#usia_kehamilan').val(),
                    trimester: $('#trimester').val()
                };

                let data =  JSON.parse(localStorage.getItem('kunjunganData')) || {};
                for (const key in formData) {

                    if (data[key]) {
                        // Jika key sudah ada, perbarui value-nya saja
                        data[key].value = formData[key];
                    } else {
                        // Jika key belum ada, buat objek baru tanpa id
                        data[key] = {
                            value: formData[key]
                        };
                    }
                }

                console.log('ini datanya');
                console.log(data);


                // Simpan ke Local Storage
                localStorage.setItem('kunjunganData', JSON.stringify(data));
                console.log(JSON.parse(localStorage.getItem('kunjunganData')));

                // Ubah tombol menjadi "Edit" dan ubah warnanya
                $(this).text('Edit').removeClass('btn-success').addClass('btn-secondary');
                $('#KunjunganAnc input, #KunjunganAnc select').prop('disabled', true);
            }
          
        } else {
            $('#confirmEditModal').modal('show');
        }
    });

    // Jika konfirmasi ditekan
    $('#confirmEdit').on(' click', function() {
        $('#KunjunganAnc input, #KunjunganAnc select').prop('disabled', false);
        $('#confirmEditModal').modal('hide');
        $('#buttonKunjungan').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
    });



    // Load saved data from Local Storage
    function loadData() {
        const savedData = JSON.parse(localStorage.getItem('pemantauanData'));
        console.log(savedData);
        if (savedData) {
            for (const key in savedData) {
                if (savedData.hasOwnProperty(key)) {
                    const element = form.find(`[name="${key}"]`);
                    if (element.length) {
                        if (element.is(':radio')) {
                            element.filter(`[value="${(savedData[key]).value}"]`).prop('checked', true);
                        } else {
                            element.val((savedData[key]).value);
                        }
                    }
                }
            }
            saveButton.text('Edit').addClass('btn-secondary').removeClass(
                'btn-success'); // Change button text and color
            form.find('input, select, textarea').prop('readonly', true).prop('disabled',
                true); // Set form to readonly
        }
    }

    function validatePemantauanForm() {
        const form = document.getElementById('pemantauan');

        // Helper untuk cek radio button
        function isRadioChecked(name) {
            const radios = form.querySelectorAll(`input[name="${name}"]`);
            return Array.from(radios).some(radio => radio.checked);
        }

        // Helper cek input text (harus ada value & bukan readonly kosong)
        function isInputFilled(name) {
            const input = form.querySelector(`[name="${name}"]`);
            return input && input.value.trim() !== '';
        }

        // Helper cek textarea
        function isTextareaFilled(name) {
            const textarea = form.querySelector(`[name="${name}"]`);
            return textarea && textarea.value.trim() !== '';
        }

        // Helper cek select (pastikan ada value)
        function isSelectValid(name) {
            const select = form.querySelector(`[name="${name}"]`);
            return select && select.value.trim() !== '';
        }

        // Validasi 1-4 radio button
        if (!isRadioChecked('terlalu_mudah')) {
            swal('Error', 'Silakan pilih jawaban untuk "Terlalu muda usia melahirkan dibawah 20 tahun".', 'error');
            return false;
        }
        if (!isRadioChecked('terlalu_rapat')) {
            swal('Error', 'Silakan pilih jawaban untuk "Terlalu rapat jarak kelahiran (< 2 tahun)".', 'error');
            return false;
        }
        if (!isRadioChecked('terlalu_tua')) {
            swal('Error', 'Silakan pilih jawaban untuk "Terlalu tua (kehamilan di atas 35 tahun)".', 'error');
            return false;
        }
        if (!isRadioChecked('sering_melahirkan')) {
            swal('Error', 'Silakan pilih jawaban untuk "Terlalu sering melahirkan (anak > 3)".', 'error');
            return false;
        }

        // Validasi kode & nama diagnosa (harus ada)
        if (!isInputFilled('kdDiagnosa')) {
            swal('Error', 'Kode Diagnosa tidak boleh kosong.', 'error');
            return false;
        }
        if (!isInputFilled('nmDiagnosa')) {
            swal('Error', 'Nama Diagnosa tidak boleh kosong.', 'error');
            return false;
        }

        // Validasi deskripsi komplikasi wajib isi
        if (!isTextareaFilled('komplikasi')) {
            swal('Error', 'Deskripsi Komplikasi harus diisi.', 'error');
            return false;
        }

        // Validasi Riwayat Penyakit Menular Pribadi
        if (!isInputFilled('codePribadi')) {
            swal('Error', 'Kode Riwayat Penyakit Menular Pribadi tidak boleh kosong.', 'error');
            return false;
        }
        if (!isInputFilled('valueSetPribadi')) {
            swal('Error', 'Nama Riwayat Penyakit Menular Pribadi tidak boleh kosong.', 'error');
            return false;
        }
        if (!isSelectValid('sumber_penyakit_menular')) {
            swal('Error', 'Silakan pilih sumber Penyakit Menular.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_penyakit_menular')) {
            swal('Error', 'Deskripsi Penyakit Menular harus diisi.', 'error');
            return false;
        }

        // Validasi Riwayat Penyakit Keluarga
        if (!isInputFilled('codeKeluarga')) {
            swal('Error', 'Kode Riwayat Penyakit Keluarga tidak boleh kosong.', 'error');
            return false;
        }
        if (!isInputFilled('valueSetKeluarga')) {
            swal('Error', 'Nama Riwayat Penyakit Keluarga tidak boleh kosong.', 'error');
            return false;
        }
        if (!isSelectValid('sumber_penyakit_keluarga')) {
            swal('Error', 'Silakan pilih sumber Penyakit Keluarga.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_penyakit_keluarga')) {
            swal('Error', 'Deskripsi Penyakit Keluarga harus diisi.', 'error');
            return false;
        }

        // Validasi status merokok & deskripsi
        if (!isSelectValid('status_merokok')) {
            swal('Error', 'Silakan pilih Status Merokok.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_merokok')) {
            swal('Error', 'Deskripsi Status Merokok harus diisi.', 'error');
            return false;
        }

        // Validasi status alkohol & deskripsi
        if (!isSelectValid('status_alkohol')) {
            swal('Error', 'Silakan pilih Status Alkohol.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_alkohol')) {
            swal('Error', 'Deskripsi Status Alkohol harus diisi.', 'error');
            return false;
        }

        // Validasi status disabilitas & deskripsi
        if (!isSelectValid('status_disabilitas')) {
            swal('Error', 'Silakan pilih Status Disabilitas.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_disabilitas')) {
            swal('Error', 'Deskripsi Status Disabilitas harus diisi.', 'error');
            return false;
        }

        // Validasi kelas ibu hamil & deskripsi
        if (!isSelectValid('kelas_ibu_hamil')) {
            swal('Error', 'Silakan pilih Apakah Mengikuti Kelas Ibu Hamil.', 'error');
            return false;
        }
        if (!isTextareaFilled('deskripsi_kelas_ibu_hamil')) {
            swal('Error', 'Deskripsi Kelas Ibu Hamil harus diisi.', 'error');
            return false;
        }

        // Semua validasi lolos
        return true;
    }

    // Save data to Local Storage
    saveButton.on('click', function() {
        if (saveButton.text() === 'Simpan') {
            if (validatePemantauanForm()) {
                form.find(':disabled').prop('disabled', false);
                const formData = form.serializeArray();
                let existingData = JSON.parse(localStorage.getItem('pemantauanData')) || {};

                formData.forEach(item => {
                // Cek apakah data dengan key ini sudah ada di localStorage
                    if (existingData[item.name]) {
                        // Kalau sudah ada, update hanya 'value', biarkan 'id' tetap sama
                        existingData[item.name].value = item.value;
                    } else {
                        // Kalau belum ada, buat objek baru dengan value dan ambil id dari form input
                        const inputElement = form.find(`[name="${item.name}"]`);
                        existingData[item.name] = {
                            value: item.value,
                        };
                    }
                });
                form.find('[readonly]').prop('disabled', true);


                // Save to Local Storage
                localStorage.setItem('pemantauanData', JSON.stringify(existingData));

                // Change button to Edit mode
                saveButton.text('Edit').addClass('btn-secondary').removeClass(
                    'btn-success'); // Change button text and color
                form.find('input, select, textarea').prop('readonly', true).prop('disabled',
                    true); // Set form to readonly
                swal('Berhasil', 'Data berhasil disimpan local', 'success');
            }
           
        } else {
            $('#editModal').modal('show'); // Show confirmation modal
        }
    });

    // Confirm edit action
    $('#confirmEditPemantauan').on('click', function () {
        const form = $('#pemantauan');

        // Enable all inputs inside form
        form.find('input, select, textarea').prop('readonly', false).prop('disabled', false).css('background-color', '');

        // Tambahkan pengecualian: tetap disabled dan kuning untuk form tertentu
        const sections = ['#code-komplikasi', '#riwayat-pribadi', '#riwayat-keluarga'];

        sections.forEach(function (selector) {
            const $section = form.find(selector);
            if ($section.length) {
                $section.find('input, select').each(function () {
                    const $el = $(this);
                    if ($el.attr('type') !== 'hidden') {
                        $el.css({
                            'background-color': '#fff3cd',
                            'border-color': '#ffeeba'
                        });
                    }
                    $el.prop('disabled', true);
                });

                // Re-enable tombol "Cari" dan "Del" di dalam section ini
                $section.find('button').each(function () {
                    const $btn = $(this);
                    const btnText = $btn.text().trim().toLowerCase();
                    if (btnText === 'cari' || btnText === 'del') {
                        $btn.prop('disabled', false);
                    }
                });
            }
        });


        // Ubah tombol
        saveButton.text('Simpan').addClass('btn-success').removeClass('btn-secondary');

        // Sembunyikan modal
        $('#editModal').modal('hide');
    });


    loadData();
});
</script>