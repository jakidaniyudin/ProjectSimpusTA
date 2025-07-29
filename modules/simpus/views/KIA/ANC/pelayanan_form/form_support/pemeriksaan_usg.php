<form id="pemeriksaanUsg">
    <div class="row">
       
        <br>
        <div class="col-lg-6">   
            <div class="card">
            <p class="text-bold text-danger">Ingat untuk form yang di blok kuning wajib tidak diisi !!!</p>
                <div class="card-body">
                    <div class="form-group">
                        <label for="trimester">Trimester ke</label>
                        <select class="form-control" id="trimester">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <h5>Pemeriksaan USG</h5>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="gsDiameter">Gestational Sac (GS) Diameter</label>
                                <input type="number" class="form-control" id="gsDiameter" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="crl">Crown Rump Length (CRL)</label>
                                <input type="number" class="form-control" id="crl" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="djj">Denyut Jantung Janin (DJJ)</label>
                                <input type="number" class="form-control" id="djj" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">/min</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="usiaKehamilan">Usia Kehamilan (USG)</label>
                                <input type="number" class="form-control" id="usiaKehamilan" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">Week</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="perkiraanLahir">Perkiraan Lahir</label>
                        <input type="date" class="form-control" id="perkiraanLahir">
                    </div>

                    <div class="form-group">
                        <label for="letakJanin">Letak Janin</label>
                        <select class="form-control" id="letakJanin">
                            <option>Intrauteri</option>
                            <option>Ekstrauteri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Taksiran Persalinan</label>
                        <textarea class="form-control" id="taksiranPersalinan" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="bpd">Biparietal Diameter (BPD)</label>
                                <input type="number" class="form-control" id="bpd" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="hc">Head Circumference (HC)</label>
                                <input type="number" class="form-control" id="hc" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="ac">Abdominal Circumference (AC)</label>
                                <input type="number" class="form-control" id="ac" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="fl">Femur Length (FL)</label>
                                <input type="number" class="form-control" id="fl" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">cm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="beratJanin">Berat Janin (USG)</label>
                                <input type="number" class="form-control" id="beratJanin" placeholder="umur">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <label class="mt-3"></label>
                            <p class="text-left text-bold">g</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="statusJanin">Janin</label>
                        <select class="form-control" id="statusJanin">
                            <option>Normal</option>
                            <option>Tidak Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-2">Deskripsi Janin</label>
                        <textarea class="form-control" id="deskripsiJanin" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="saveButton">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    let isEditingUsg = false;
    const savedDataUsg = JSON.parse(localStorage.getItem('pemeriksaanUsg')) || {};

    const $form = $('#pemeriksaanUsg');

    function getInputValueOrNull(selector) {
        const input = $form.find(selector);
        const bgColor = input.css('background-color');

        if (bgColor === 'rgb(255, 243, 205)') {
            return null;
        }

        return input.val();
    }

    function updateFormVisibility() {
        const trimester = $form.find('#trimester').val();

        const formGroups = {
            trimester1: [
                $form.find('#gsDiameter'),
                $form.find('#crl'),
                $form.find('#djj'),
                $form.find('#letakJanin'),
                $form.find('#taksiranPersalinan')
            ],
            trimester3: [
                $form.find('#bpd'),
                $form.find('#hc'),
                $form.find('#ac'),
                $form.find('#fl'),
                $form.find('#beratJanin'),
                $form.find('#statusJanin'),
                $form.find('#deskripsiJanin')
            ],
            common: [
                $form.find('#perkiraanLahir')
            ]
        };

        $form.find(':input').prop('disabled', false).css('background-color', '').removeClass('force-disabled');

        if (trimester === '1' || trimester === '2') {
            formGroups.trimester3.forEach(input => {
                input.prop('disabled', true).css('background-color', '#fff3cd').addClass('force-disabled');
            });
        } else if (trimester === '3' || trimester === '4') {
            formGroups.trimester1.forEach(input => {
                input.prop('disabled', true).css('background-color', '#fff3cd').addClass('force-disabled');
            });
        }

        formGroups.common.forEach(input => {
            input.prop('disabled', false).css('background-color', '');
        });
    }

    $form.find('#trimester').change(updateFormVisibility);
    updateFormVisibility();

    function validateFormByTrimester() {
        const trimester = $form.find('#trimester').val();
        const usiaKehamilan = parseFloat($form.find('#usiaKehamilan').val());
        const beratJanin = parseFloat($form.find('#beratJanin').val());

        const fieldByTrimester = {
            '1': ['#gsDiameter', '#crl', '#djj', '#usiaKehamilan', '#perkiraanLahir'],
            '2': ['#bpd', '#hc', '#ac', '#fl', '#usiaKehamilan', '#beratJanin', '#perkiraanLahir'],
            '3': ['#bpd', '#hc', '#ac', '#fl', '#usiaKehamilan', '#beratJanin', '#perkiraanLahir', '#letakJanin', '#taksiranPersalinan', '#statusJanin', '#deskripsiJanin']
        };

        const fieldsToValidate = fieldByTrimester[trimester] || [];

        for (const field of fieldsToValidate) {
            const input = $form.find(field);
            const value = input.val();

            if (!input.is(':visible') || input.prop('disabled')) continue;

            if (value === null || value.trim() === '') {
                swal('Error', 'Field wajib tidak boleh kosong.', 'error');
                input.focus();
                return false;
            }

            const numericFields = ['#gsDiameter', '#crl', '#djj', '#usiaKehamilan', '#bpd', '#hc', '#ac', '#fl', '#beratJanin'];
            if (numericFields.includes(field)) {
                const num = parseFloat(value);
                if (isNaN(num) || num < 0) {
                    swal('Error', 'Angka tidak boleh negatif atau kosong.', 'error');
                    input.focus();
                    return false;
                }
            }
        }

        if (!isNaN(usiaKehamilan) && (usiaKehamilan < 4 || usiaKehamilan > 45)) {
            swal('Error', 'Usia kehamilan tidak masuk akal (4–45 minggu).', 'error');
            $form.find('#usiaKehamilan').focus();
            return false;
        }

        if (!isNaN(beratJanin) && (beratJanin < 50 || beratJanin > 5000)) {
            swal('Error', 'Berat janin tidak wajar (50–5000 gram).', 'error');
            $form.find('#beratJanin').focus();
            return false;
        }

        return true;
    }

    $form.find('#saveButton').click(function (event) {
        event.preventDefault();
        const $saveButton = $form.find('#saveButton');

        if ($saveButton.text() === 'Edit') {
            isEditingUsg = true;
        }

        if (!isEditingUsg) {
            if (validateFormByTrimester()) {
                const dataUsg = {
                    trimester: $form.find('#trimester').val(),
                    gsDiameter: getInputValueOrNull('#gsDiameter'),
                    crl: getInputValueOrNull('#crl'),
                    djj: getInputValueOrNull('#djj'),
                    usiaKehamilan: getInputValueOrNull('#usiaKehamilan'),
                    perkiraanLahir: getInputValueOrNull('#perkiraanLahir'),
                    letakJanin: getInputValueOrNull('#letakJanin'),
                    taksiranPersalinan: getInputValueOrNull('#taksiranPersalinan'),
                    bpd: getInputValueOrNull('#bpd'),
                    hc: getInputValueOrNull('#hc'),
                    ac: getInputValueOrNull('#ac'),
                    fl: getInputValueOrNull('#fl'),
                    beratJanin: getInputValueOrNull('#beratJanin'),
                    statusJanin: getInputValueOrNull('#statusJanin'),
                    deskripsiJanin: getInputValueOrNull('#deskripsiJanin')
                };

                for (const key in dataUsg) {
                    if (savedDataUsg[key]) {
                        savedDataUsg[key].value = dataUsg[key];
                    } else {
                        savedDataUsg[key] = { value: dataUsg[key] };
                    }
                }

                localStorage.setItem('pemeriksaanUsg', JSON.stringify(savedDataUsg));

                $saveButton.text('Edit').removeClass('btn-success').addClass('btn-secondary');
                $form.find('input, select, textarea').prop('disabled', true);

                swal('berhasil', 'data disimpan di local', 'success');
            }
        } else {
            $('#editModal').modal('show');
        }
    });

    function setInputValueIfNotYellow(selector, value) {
        const input = $form.find(selector);
        if (input.css('background-color') === 'rgb(255, 243, 205)') return;
        input.val(value || '');
    }

    if (savedDataUsg && Object.keys(savedDataUsg).length > 0) {
        $form.find('#trimester').val(savedDataUsg.trimester?.value || '');
        setInputValueIfNotYellow('#gsDiameter', savedDataUsg.gsDiameter?.value);
        setInputValueIfNotYellow('#crl', savedDataUsg.crl?.value);
        setInputValueIfNotYellow('#djj', savedDataUsg.djj?.value);
        setInputValueIfNotYellow('#usiaKehamilan', savedDataUsg.usiaKehamilan?.value);
        setInputValueIfNotYellow('#perkiraanLahir', savedDataUsg.perkiraanLahir?.value);
        setInputValueIfNotYellow('#letakJanin', savedDataUsg.letakJanin?.value);
        setInputValueIfNotYellow('#taksiranPersalinan', savedDataUsg.taksiranPersalinan?.value);
        setInputValueIfNotYellow('#bpd', savedDataUsg.bpd?.value);
        setInputValueIfNotYellow('#hc', savedDataUsg.hc?.value);
        setInputValueIfNotYellow('#ac', savedDataUsg.ac?.value);
        setInputValueIfNotYellow('#fl', savedDataUsg.fl?.value);
        setInputValueIfNotYellow('#beratJanin', savedDataUsg.beratJanin?.value);
        setInputValueIfNotYellow('#statusJanin', savedDataUsg.statusJanin?.value);
        setInputValueIfNotYellow('#deskripsiJanin', savedDataUsg.deskripsiJanin?.value);

        $form.find('input, select, textarea').prop('disabled', true);
        $form.find('#saveButton').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        isEditingUsg = true;
    }

    $('#confirmEdit').click(function () {
        $('#editModal').modal('hide');
        $form.find('input:not(.force-disabled), select:not(.force-disabled), textarea:not(.force-disabled)')
            .prop('disabled', false)
            .css('background-color', '');
        $form.find('#saveButton').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        isEditingUsg = false;
    });

    $('#cancelEdit').click(function () {
        $('#editModal').modal('hide');
    });
});

</script>