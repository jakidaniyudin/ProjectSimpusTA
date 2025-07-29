<form id="form_kn1">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            <!-- Tanggal Lahir -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="nama">Tanggal Lahir</label>
                <input
                    type="date"
                    class="form-control"
                    id="nama"
                    placeholder="Masukkan Nama Anda" />
            </div>

            <!-- Jam Lahir -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="jam">Jam Lahir</label>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h6>Select Time</h6>
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="hours">Hour</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="hours"
                                    placeholder="00"
                                    min="0"
                                    max="23" />
                            </div>
                            <div class="col-xs-4">
                                <label for="minutes">Minutes</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="minutes"
                                    placeholder="00"
                                    min="0"
                                    max="59" />
                            </div>
                            <div class="col-xs-4">
                                <label for="seconds">Second</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="seconds"
                                    placeholder="00"
                                    min="0"
                                    max="59" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <label for="menyusui" class="control-label">Inisiasi Menyusui Dini</label>
            <select id="menyusui" class="custom-select form-control" style="margin-bottom: 20px;">
                <option selected>Select...</option>
                <option value="1">Ya</option>
                <option value="2">Tidak</option>
            </select>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_menyusui" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_menyusui" class="form-control"></textarea>
            </div>

            <label for="jikaya" class="control-label">Jika Ya, Waktu Inisiasi Menyusui Dini</label>
            <select class="custom-select form-control" id="jikaya" style="margin-bottom: 20px;">
                <option selected>Select...</option>
                <option value="1">Kurang Dari 1 jam</option>
                <option value="2">Lebih Dari 1 jam</option>
            </select>

            <label for="jikaya" class="control-label">Perawatan Tali Pusar</label>
            <select class="custom-select form-control" id="jikaya" style="margin-bottom: 20px;">
                <option selected>Select...</option>
                <option value="1">Ya</option>
                <option value="2">Tidak</option>
            </select>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_tali_pusar" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_tali_pusar" class="form-control"></textarea>
            </div>

            <label for="antibiotik-mata">Salep Antibiotik Mata</label>
            <select class="custom-select form-control" id="antibiotik-mata" style="margin-bottom: 20px;">
                <option selected>Select...</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_antibiotik_mata" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_antibiotik_mata" class="form-control"></textarea>
            </div>

            <!-- Imunisasi HBIG -->
            <label for="imunisasi_hbig">Imunisasi HBIG</label>
            <select class="form-control" id="imunisasi_hbig" style="margin-bottom: 20px;">
                <option selected>Select...</option>
                <option value="1">Ya</option>
                <option value="2">Tidak</option>
            </select>

            <!-- Deskripsi -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_imunisasi">Deskripsi</label>
                <textarea id="deskripsi_imunisasi" class="form-control"></textarea>
            </div>

            <!-- Ibu Hepatitis -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="ibu_hepatitis">Ibu Hepatitis</label>
                <select class="form-control" id="ibu_hepatitis">
                    <option selected>Select...</option>
                    <option value="1">Ya</option>
                    <option value="2">Tidak</option>
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_ibu_hepatitis">Deskripsi</label>
                <textarea id="deskripsi_ibu_hepatitis" class="form-control"></textarea>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-8">
                    <!-- Tanggal Kena Hepatitis -->
                    <div class="form-group">
                        <label for="tanggal-kena-hepatitis">Tanggal Tekena Hepatitis</label>
                        <input type="date" id="tanggal-kena-hepatitis" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- jam -->
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="time" id="jam" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Imunisasi Hepatitis -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="imunisasi_hepatitis">Imunisasi Hepatitis B</label>
                <select class="form-control" id="imunisasi_hepatitis">
                    <option selected>Select...</option>
                    <option value="1">Ya</option>
                    <option value="2">Tidak</option>
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_imunisasi_hepatitis">Deskripsi</label>
                <textarea id="deskripsi_imunisasi_hepatitis" class="form-control"></textarea>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            <!-- Berat Badan Bayi Saat Lahir -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="berat">Berat Badan Bayi Saat Lahir</label>
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="12" />
                    <span class="input-group-addon">g</span>
                </div>
            </div>

            <!-- Panjang Bayi Saat Lahir -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="panjang">Panjang Bayi Saat Lahir</label>
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="12" />
                    <span class="input-group-addon">cm</span>
                </div>
            </div>

            <!-- Lingkar Kepala Saat Lahir -->
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="lingkar" class="form-label">Lingkar Kepala Saat Lahir</label>
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="12" />
                    <span class="input-group-addon">cm</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="gol_darah" class="form-label">Golongan Darah</label>
                <select id="gol_darah" class="form-control">
                    <option value="select" selected>Select...</option>
                    <option value="O">O</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="rhesus" class="form-label">Rhesus</label>
                <select id="rhesus" class="form-control">
                    <option value="select" selected>Select...</option>
                    <option value="pos">pos</option>
                    <option value="neg">neg</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="resusitas" class="form-label">Apakah Diberikan Resusitas ?</label>
                <select id="resusitas" class="form-control">
                    <option value="select" selected>Select...</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="denyut" class="form-label">Frekuensi Denyut Nadi</label>
                <div class="input-group">
                    <input
                        type="number"
                        class="form-control"
                        placeholder="100/min"
                        id="denyut" />
                    <span class="input-group-addon">/min</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="Suhu" class="form-label">Suhu (C&deg;)</label>
                <div class="input-group">
                    <input
                        type="number"
                        class="form-control"
                        placeholder="36,1&deg;"
                        id="Suhu" />
                    <span class="input-group-addon">Cel</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="pernafasan" class="form-label">pernafasan</label>
                <div class="input-group">
                    <input
                        type="number"
                        class="form-control"
                        placeholder="100/min"
                        id="pernafasan" />
                    <span class="input-group-addon">/min</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="hipotioid" class="form-label">Skiring Hipotioid Kongenital (Bila belum diberkan)</label>
                <select id="hipotioid" class="form-control">
                    <option value="select" selected>Select...</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_hipotioid" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_hipotioid" class="form-control"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="MTBM" class="form-label">Apakah dilakukan pemeriksaan kesehatan dengan pendekatan MTBM</label>
                <select id="MTBM" class="form-control">
                    <option value="select" selected>Select...</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_MTBM" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_MTBM" class="form-control"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="deskripsi_PPIA" class="form-label">Deskripsi</label>
                <textarea id="deskripsi_PPIA" class="form-control"></textarea>
            </div>

            <!-- Submit -->
            <div class="form-group">
                <button type="button" id="KN1Button" class="btn btn-success" style="width: 100%;">
                  <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</form>
<script>
function getFormDataKN0() {
    // Get the form element
    const $form = $('#form_kn1');
    
    // Get all values using the form as context
    const tanggalLahir = $form.find('#nama').val();
    const hours = $form.find('#hours').val();
    const minutes = $form.find('#minutes').val();
    const seconds = $form.find('#seconds').val();
    const jamLahir = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

    // Get measurements - now scoped to the form
    const beratLahir = $form.find('[placeholder="12"]').eq(0).val();
    const panjangLahir = $form.find('[placeholder="12"]').eq(1).val();
    const lingkarKepala = $form.find('[placeholder="12"]').eq(2).val();

    // Get all other inputs scoped to the form
    const imunisasiHbig = $form.find('#imunisasi_hbig').val();
    const deskripsiImunisasi = $form.find('#deskripsi_imunisasi').val();
    const ibuHepatitis = $form.find('#ibu_hepatitis').val();
    const deskripsiIbuHepatitis = $form.find('#deskripsi_ibu_hepatitis').val();
    const tanggalKenaHepatitis = $form.find('#tanggal-kena-hepatitis').val();
    const jamKenaHepatitis = $form.find('#jam').val();
    const imunisasiHepatitis = $form.find('#imunisasi_hepatitis').val();
    const deskripsiImunisasiHepatitis = $form.find('#deskripsi_imunisasi_hepatitis').val();
    const menyusui = $form.find('#menyusui').val();
    const deskripsiMenyusui = $form.find('#deskripsi_menyusui').val();
    const waktuMenyusui = $form.find('#jikaya').val(); // Note: Duplicate ID in form
    const perawatanTaliPusar = $form.find('#jikaya').val(); // Same duplicate ID issue
    const deskripsiTaliPusar = $form.find('#deskripsi_tali_pusar').val();
    const antibiotikMata = $form.find('#antibiotik-mata').val();
    const deskripsiAntibiotikMata = $form.find('#deskripsi_antibiotik_mata').val();
    const vitaminK = $form.find('#vitamin_k').val();
    const deskripsiVitK = $form.find('#deskripsi_vit_k').val();
    const pemeriksaan = $form.find('#pemeriksaan').val();
    const deskripsiMtbm = $form.find('#deskripsi_mtbm').val();
    const deskripsiPpa = $form.find('#deskripsi_ppa').val();
    const golDarah = $form.find('#gol_darah').val();
    const rhesus = $form.find('#rhesus').val();
    const resusitas = $form.find('#resusitas').val();
    const denyut = $form.find('#denyut').val();
    const suhu = $form.find('#Suhu').val();
    const pernafasan = $form.find('#pernafasan').val();
    const hipotioid = $form.find('#hipotioid').val();
    const deskripsiHipotioid = $form.find('#deskripsi_hipotioid').val();
    const mtbm = $form.find('#MTBM').val();
    const deskripsiMTBM = $form.find('#deskripsi_MTBM').val();
    const deskripsiPPIA = $form.find('#deskripsi_PPIA').val();

    // Validation
    if (!tanggalLahir || hours === "" || minutes === "" || seconds === "") {
        showSwal('warning', 'Data tidak lengkap', 'Tanggal & jam lahir wajib diisi!');
        return null;
    }

    return {
        tanggalLahir,
        jamLahir,
        beratLahir,
        panjangLahir,
        lingkarKepala,
        imunisasiHbig,
        deskripsiImunisasi,
        ibuHepatitis,
        deskripsiIbuHepatitis,
        tanggalKenaHepatitis,
        jamKenaHepatitis,
        imunisasiHepatitis,
        deskripsiImunisasiHepatitis,
        menyusui,
        deskripsiMenyusui,
        waktuMenyusui,
        perawatanTaliPusar,
        deskripsiTaliPusar,
        antibiotikMata,
        deskripsiAntibiotikMata,
        vitaminK,
        deskripsiVitK,
        pemeriksaan,
        deskripsiMtbm,
        deskripsiPpa,
        golDarah,
        rhesus,
        resusitas,
        denyut,
        suhu,
        pernafasan,
        hipotioid,
        deskripsiHipotioid,
        mtbm,
        deskripsiMTBM,
        deskripsiPPIA
    };
}

function showSwal(type, title, text) {
    const icon = (['success', 'error', 'warning', 'info'].includes(type)) ? type : 'info';
    swal(title, text, icon);
}

$(document).ready(function(){
    let data = null;

    // Updated to use the correct button ID from the form
    $('#form_kn1 #KN1Button').on('click', function(e) {
        e.preventDefault();

        const formData = getFormDataKN0();
        if (!formData) return;

        const dataBayiBalitaKN1 = {};
        const keys = Object.keys(formData);

        keys.forEach((key) => {
            if (data?.[key]) {
                dataBayiBalitaKN1[key] = {
                    value: formData[key],
                    id: data[key].id
                };
            } else {
                dataBayiBalitaKN1[key] = {
                    value: formData[key],
                    id: null
                };
            }
        });

        // Prepare data to send

        console.log(dataBayiBalitaKN1);
        // sendFormData(dataToSend);
    });
});
</script>