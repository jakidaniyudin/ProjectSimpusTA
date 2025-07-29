<div class="card">
    <div class="card-body">
        <div class="row" id="apgarForm">
            <div id="apgar-container-parent"></div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <button class="btn btn-success btn-block btn-sm" id="simpanButtonApgar"
                        type="button">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let dataToSend = {};
    const apgarDataFromPHP = {
        1: synchronizeDataApgar(<?= json_encode($apgar1) ?? null ?>),
        5: synchronizeDataApgar(<?= json_encode($apgar5) ?? null ?>),
        10: synchronizeDataApgar(<?= json_encode($apgar10) ?? null ?>)
    };

    // Fungsi untuk menghitung skor APGAR


    // Fungsi untuk membangun container APGAR
    function buildAPGARContainer(timePoint) {
        // Membuat container utama
        const $container = $('<div>')
            .addClass('col-lg-4')
            .attr('id', `apgar-${timePoint}-container`);

        // Membuat card
        const $card = $('<div>').addClass('card');
        const $cardBody = $('<div>')
            .addClass('card-body')
            .attr('id', `apgar-${timePoint}`);

        // Menambahkan judul
        const $title = $('<h6>').text(`APGAR Menit ${timePoint}`);
        $cardBody.append($title);

        // Daftar komponen APGAR
        const apgarComponents = [{
                id: `apgar-${timePoint}-appearance`,
                label: "1.1 Appearance (Warna Kulit)",
                options: [{
                        value: "LA6722-8",
                        text: "[0] Biru, pucat"
                    },
                    {
                        value: "LA6723-6",
                        text: "[1] Tubuh merah muda, ekstremitas biru"
                    },
                    {
                        value: "LA6724-4",
                        text: "[2] Seluruh tubuh merah muda"
                    }
                ]
            },
            {
                id: `apgar-${timePoint}-pulse`,
                label: "1.2 Pulse (Denyut Jantung)",
                options: [{
                        value: "LA6716-0",
                        text: "[0] Tidak Ada"
                    },
                    {
                        value: "LA6717-8",
                        text: "[1] <100 /mnt"
                    },
                    {
                        value: "LA6718-6",
                        text: "[2] >=100 /mnt"
                    }
                ]
            },
            {
                id: `apgar-${timePoint}-grimace`,
                label: "1.3 Grimace (Refleks Taktil)",
                options: [{
                        value: "LA6719-4",
                        text: "[0] Tidak ada respon"
                    },
                    {
                        value: "LA6720-2",
                        text: "[1] Meringis"
                    },
                    {
                        value: "LA6721-0",
                        text: "[2] Terbatuk atau bersin"
                    }
                ]
            },
            {
                id: `apgar-${timePoint}-activity`,
                label: "1.4 Activity (Tonus Otot)",
                options: [{
                        value: "LA6713-7",
                        text: "[0] Lemas"
                    },
                    {
                        value: "LA6714-5",
                        text: "[1] Sedikit gerakan ekstremitas"
                    },
                    {
                        value: "LA6715-2",
                        text: "[2] Bergerak aktif"
                    }
                ]
            },
            {
                id: `apgar-${timePoint}-respiration`,
                label: "1.5 Respiration (Pernapasan)",
                options: [{
                        value: "LA6725-1",
                        text: "[0] Tidak ada"
                    },
                    {
                        value: "LA6726-9",
                        text: "[1] Perlahan (tidak teratur)"
                    },
                    {
                        value: "LA6727-7",
                        text: "[2] Menangis kuat"
                    }
                ]
            }
        ];

        // Membuat elemen select untuk setiap komponen APGAR
        apgarComponents.forEach(component => {
            const $formGroup = $('<div>').addClass('form-group mb-2');
            const $label = $('<label>')
                .attr('for', component.id)
                .addClass('form-label')
                .text(component.label);
            const $select = $('<select>')
                .attr('id', component.id)
                .addClass('form-control apgar-select')
                .attr('data-time-point', timePoint);

            // Menambahkan opsi default "Pilih"
            $select.append($('<option>').attr('value', '').text('Pilih'));

            // Menambahkan opsi ke dalam select
            component.options.forEach(option => {
                $select.append($('<option>')
                    .attr('value', option.value)
                    .text(option.text)
                );
            });

            // Menambahkan label dan select ke dalam form group
            $formGroup.append($label, $select);

            // Menambahkan form group ke dalam card body
            $cardBody.append($formGroup);
        });

        // Membuat tabel untuk total skor
        const $totalScoreTable = $('<div>').addClass('form-group mb-2');
        const $table1 = $('<table>').addClass('table table-bordered');
        const $thead1 = $('<thead>').append(
            $('<tr>').append(
                $('<th>').text('Total Score'),
                $('<th>').attr('id', `apgar-${timePoint}-total-score`).text('-')
            )
        );
        $table1.append($thead1);
        $totalScoreTable.append($table1);
        $cardBody.append($totalScoreTable);

        // Membuat tabel untuk klasifikasi
        const $classificationTable = $('<div>').addClass('form-group');
        const $table2 = $('<table>').addClass('table table-bordered');
        const $thead2 = $('<thead>').append(
            $('<tr>').append(
                $('<th>').text('Klasifikasi'),
                $('<th>').text('Score')
            )
        );
        const $tbody = $('<tbody>').append(
            $('<tr>').attr('id', `apgar-${timePoint}-classification-row`).append(
                $('<td>').text('-'),
                $('<td>').text('-')
            )
        );
        $table2.append($thead2, $tbody);
        $classificationTable.append($table2);
        $cardBody.append($classificationTable);

        // Menambahkan card body ke dalam card
        $card.append($cardBody);

        // Menambahkan card ke dalam container
        $container.append($card);

        return $container;
    }

    // Membuat container APGAR Menit 1
    const $apgar1Container = buildAPGARContainer(1);
    const $apgar5Container = buildAPGARContainer(5);
    const $apgar10Container = buildAPGARContainer(10);

    // Menambahkan container ke dalam elemen parent
    $('#apgar-container-parent').append($apgar1Container);
    $('#apgar-container-parent').append($apgar5Container);
    $('#apgar-container-parent').append($apgar10Container);

    function calculateAPGARScore(timePoint) {
        const selects = $(`#apgar-${timePoint} select`);
        const appearanceCode = $(`#apgar-${timePoint}-appearance`).val()?.trim();
        const pulseCode = $(`#apgar-${timePoint}-pulse`).val()?.trim();
        const grimaceCode = $(`#apgar-${timePoint}-grimace`).val()?.trim();
        const activityCode = $(`#apgar-${timePoint}-activity`).val()?.trim();
        const respirationCode = $(`#apgar-${timePoint}-respiration`).val()?.trim();

        const appearance = clasificationScore(appearanceCode);
        const pulse = clasificationScore(pulseCode);
        const grimace = clasificationScore(grimaceCode);
        const activity = clasificationScore(activityCode);
        const respiration = clasificationScore(respirationCode);

        // Kumpulkan semua skor jika tersedia
        let totalScore = 0;
        let incomplete = false;

        const data = {
            appearance: appearance ? {
                value: appearanceCode,
                score: appearance.score,
                text: appearance.text
            } : (incomplete = true, {
                value: appearanceCode || '',
                score: 0,
                text: '-'
            }),

            pulse: pulse ? {
                value: pulseCode,
                score: pulse.score,
                text: pulse.text
            } : (incomplete = true, {
                value: pulseCode || '',
                score: 0,
                text: '-'
            }),

            grimace: grimace ? {
                value: grimaceCode,
                score: grimace.score,
                text: grimace.text
            } : (incomplete = true, {
                value: grimaceCode || '',
                score: 0,
                text: '-'
            }),

            activity: activity ? {
                value: activityCode,
                score: activity.score,
                text: activity.text
            } : (incomplete = true, {
                value: activityCode || '',
                score: 0,
                text: '-'
            }),

            respiration: respiration ? {
                value: respirationCode,
                score: respiration.score,
                text: respiration.text
            } : (incomplete = true, {
                value: respirationCode || '',
                score: 0,
                text: '-'
            }),
        };

        // Hitung total skor
        totalScore = data.appearance.score + data.pulse.score + data.grimace.score + data.activity.score + data
            .respiration.score;

        let text = 'Belum Lengkap';
        let classColor = 'bg-secondary text-white';
        let scoreRange = `${totalScore}*`;

        if (!incomplete) {
            if (totalScore >= 7) {
                text = 'Bayi Normal';
                classColor = 'bg-success text-white';
                scoreRange = '7-10';
            } else if (totalScore >= 4) {
                text = 'Asfiksia Sedang';
                classColor = 'bg-warning text-dark';
                scoreRange = '4-6';
            } else {
                text = 'Asfiksia Berat';
                classColor = 'bg-danger text-white';
                scoreRange = '0-3';
            }
        }

        // Update UI
        const $classRow = $(`#apgar-${timePoint}-classification-row`);
        $classRow.removeClass('bg-success bg-warning bg-danger bg-secondary text-white text-dark')
            .addClass(classColor)
            .find('td:first-child').text(text)
            .end().find('td:last-child').text(scoreRange);

        return {
            ...data,
            totalScore: {
                value: totalScore,
                text: text,
                score: scoreRange
            }
        };
    }



    function clasificationScore(nilai) {
        if (!nilai) return null;
        const cleanValue = nilai.trim(); // Bersihkan spasi ekstra jika ada

        const classification = [
            // Appearance
            {
                code: 'LA6722-8',
                score: 0,
                text: 'Biru, pucat'
            },
            {
                code: 'LA6723-6',
                score: 1,
                text: 'Tubuh merah muda, ekstremitas biru'
            },
            {
                code: 'LA6724-4',
                score: 2,
                text: 'Seluruh tubuh merah muda'
            },

            // Pulse
            {
                code: 'LA6716-0',
                score: 0,
                text: 'Tidak ada'
            },
            {
                code: 'LA6717-8',
                score: 1,
                text: '<100 /mnt'
            },
            {
                code: 'LA6718-6',
                score: 2,
                text: '>=100 /mnt'
            },

            // Grimace
            {
                code: 'LA6719-4',
                score: 0,
                text: 'Tidak ada respon'
            },
            {
                code: 'LA6720-2',
                score: 1,
                text: 'Meringis'
            },
            {
                code: 'LA6721-0',
                score: 2,
                text: 'Terbatuk atau bersin'
            },

            // Activity
            {
                code: 'LA6713-7',
                score: 0,
                text: 'Lemas'
            },
            {
                code: 'LA6714-5',
                score: 1,
                text: 'Sedikit gerakan ekstremitas'
            },
            {
                code: 'LA6715-2',
                score: 2,
                text: 'Bergerak aktif'
            },

            // Respiration
            {
                code: 'LA6725-1',
                score: 0,
                text: 'Tidak ada'
            },
            {
                code: 'LA6726-9',
                score: 1,
                text: 'Perlahan (tidak teratur)'
            },
            {
                code: 'LA6727-7',
                score: 2,
                text: 'Menangis kuat'
            }
        ];

        const found = classification.find(item => item.code === cleanValue);
        return found ? {
            score: found.score,
            text: found.text
        } : null;
    }

    // Menambahkan event listener untuk semua select dengan class apgar-select
    $('.apgar-select').on('change', function() {
        const timePoint = $(this).data('time-point');
        const scoreData = calculateAPGARScore(timePoint);
        $(`#apgar-${timePoint}-total-score`).text(scoreData.totalScore.value);
    });


    function changeDataLocalStoreApgar(newData, localStore = {}) {
        for (const key in newData) {
            if (localStore[key]) {
                // Jika key sudah ada, perbarui value-nya saja
                localStore[key].value = newData[key].value;
                localStore[key].text = newData[key].text;
                localStore[key].score = newData[key].score;

            } else {
                // Jika key belum ada, buat objek baru tanpa id
                localStore[key] = {
                    value: newData[key].value,
                    text: newData[key].text,
                    score: newData[key].score,
                };
            }
        }
        return localStore;
    }

    function validateApgarForm(timePoint) {
            const requiredFields = [
                `#apgar-${timePoint}-appearance`,
                `#apgar-${timePoint}-pulse`,
                `#apgar-${timePoint}-grimace`,
                `#apgar-${timePoint}-activity`,
                `#apgar-${timePoint}-respiration`
            ];

            let isValid = true;

            requiredFields.forEach(selector => {
                const $field = $(selector);
                const value = $field.val();

                if (!value) {
                    isValid = false;
                    $field.addClass('is-invalid');
                } else {
                    $field.removeClass('is-invalid');
                }
            });

            if (!isValid) {
                swal("Form Belum Lengkap", `Harap lengkapi form APGAR untuk menit ke-${timePoint}.`, "warning");
            }

            return isValid;
    }

    console.log('ini activity' + actv_service);

    // Fungsi untuk menyimpan data ke localStorage saat tombol simpan diklik
    $('#simpanButtonApgar').on('click', function () {
        if ($('#simpanButtonApgar').text() === 'Simpan') {

            // Validasi form APGAR untuk setiap menit
            const valid1 = validateApgarForm(1);
            const valid5 = validateApgarForm(5);
            const valid10 = validateApgarForm(10);
            if (!valid1 || !valid5 || !valid10) return;
            // Hitung skor
            let apgarData1 = calculateAPGARScore(1);
            let apgarData5 = calculateAPGARScore(5);
            let apgarData10 = calculateAPGARScore(10);

            // jika ada datanya load datanya
            if(apgarDataFromPHP[1] != null && apgarDataFromPHP[5] != null && apgarDataFromPHP[10] != null){
                 apgarData1 =  changeDataLocalStoreApgar(apgarData1, apgarDataFromPHP[1]);
              
                 apgarData5 = changeDataLocalStoreApgar(apgarData5, apgarDataFromPHP[5]);
                 apgarData10 = changeDataLocalStoreApgar(apgarData10, apgarDataFromPHP[10]);
            }

            

             dataToSend = {
                pasien_id : '<?= $pasien_id ?>',
                loket_id : '<?= $loket_id ?>',
                puskesmas : '<?= $puskesmas ?>',
                pasien:JSON.stringify(<?= json_encode($pasien) ?>),
                actv_service :actv_service,
                id_dokter: '<?= $item['kdDokter'] ?? null ?>',
                start: '<?= $start ?>'
            }

             console.log(dataToSend);;

            dataToSend.apgar1 = apgarData1;
            dataToSend.apgar5 = apgarData5;
            dataToSend.apgar10 = apgarData10;


            sendFormData(dataToSend);
            // Langsung ubah ke mode Edit
            editButtonChange('Edit');
        } else {
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
            // Mode "Edit" -> tampilkan konfirmasi sebelum mengaktifkan form kembali
        }
    });




    // Fungsi untuk mengambil data dari localStorage dan mengisi form
    function loadDataFromPHP(timePoint) {
        const savedData = apgarDataFromPHP?.[timePoint];

        if (savedData && typeof savedData === 'object' && Object.keys(savedData).length > 0) {
            const data = savedData;

            // Validasi apakah minimal ada 1 value dari kelima indikator
            const isEmpty = ['appearance', 'pulse', 'grimace', 'activity', 'respiration']
                .every(key => !data[key] || data[key].value === undefined || data[key].value === null);

            if (!isEmpty) {
                editButtonChange('Edit');

                // Aman: Set value setiap elemen
                $(`#apgar-${timePoint}-appearance`).val(data.appearance?.value ?? 0);
                $(`#apgar-${timePoint}-pulse`).val(data.pulse?.value ?? 0);
                $(`#apgar-${timePoint}-grimace`).val(data.grimace?.value ?? 0);
                $(`#apgar-${timePoint}-activity`).val(data.activity?.value ?? 0);
                $(`#apgar-${timePoint}-respiration`).val(data.respiration?.value ?? 0);

                // Hitung totalScore aman
                const totalScore = data.totalScore?.value ?? 0;
                $(`#apgar-${timePoint}-total-score`).text(totalScore);

                // Klasifikasi
                let text, classColor, scoreRange;
                if (totalScore >= 7) {
                    text = 'Bayi Normal';
                    classColor = 'bg-success text-white';
                    scoreRange = '7-10';
                } else if (totalScore >= 4) {
                    text = 'Asfiksia Sedang';
                    classColor = 'bg-warning text-dark';
                    scoreRange = '4-6';
                } else {
                    text = 'Asfiksia Berat';
                    classColor = 'bg-danger text-white';
                    scoreRange = '0-3';
                }

                const $classRow = $(`#apgar-${timePoint}-classification-row`);
                $classRow.removeClass('bg-success bg-warning bg-danger text-white text-dark')
                    .addClass(classColor)
                    .find('td:first-child')
                    .text(text)
                    .end()
                    .find('td:last-child')
                    .text(scoreRange);

                return; // selesai kalau valid
            }
        }

        // --- Fallback (data kosong atau invalid)
        editButtonChange();

        const defaultValues = {
            appearance: 0,
            pulse: 0,
            grimace: 0,
            activity: 0,
            respiration: 0
        };

        $(`#apgar-${timePoint}-appearance`).val(defaultValues.appearance);
        $(`#apgar-${timePoint}-pulse`).val(defaultValues.pulse);
        $(`#apgar-${timePoint}-grimace`).val(defaultValues.grimace);
        $(`#apgar-${timePoint}-activity`).val(defaultValues.activity);
        $(`#apgar-${timePoint}-respiration`).val(defaultValues.respiration);

        $(`#apgar-${timePoint}-total-score`).text(0);

        const $classRow = $(`#apgar-${timePoint}-classification-row`);
        $classRow.removeClass('bg-success bg-warning bg-danger text-white text-dark')
            .addClass('bg-danger text-white')
            .find('td:first-child')
            .text('Asfiksia Berat')
            .end()
            .find('td:last-child')
            .text('0-3');
    }



    function editButtonChange(condition = null) {
        if (condition == 'Edit') {
            disableApgarForm(true);
            $('#simpanButtonApgar').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        } else {
            disableApgarForm(false);
            $('#simpanButtonApgar').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        }
    }

    function disableApgarForm(disable) {
        $('#apgarForm').find('input, select, textarea').prop('disabled',
            disable); // Menonaktifkan atau mengaktifkan berdasarkan parameter
    }

 

    // Memuat data dari localStorage saat halaman pertama kali dimuat
    loadDataFromPHP(1); // APGAR Menit 1
    loadDataFromPHP(5); // APGAR Menit 5
    loadDataFromPHP(10); // APGAR Menit 10
});

function sendFormData(data) {
    $.ajax({
      url: '<?= base_url('/simpus/Neonatus/setApgarService') ?>',
      method: 'POST',
      data: data,
      success: function (response) {
        showSwal('success', 'Berhasil', `Data pemeriksaan berhasil disimpan.`);
      },
      error: function (xhr) {
        showSwal('error', 'Gagal', 'Terjadi kesalahan saat menyimpan data.');
      }
    });
  }

  function changeDataLocalStoreApgar (newData, loadData = {}){
        for (const key in newData) {
            if (localStore[key]) {
                // Jika key sudah ada, perbarui value-nya saja
                localStore[key].value = newData[key].value;
                localStore[key].text = newData[key].text;
                localStore[key].score = newData[key].score;

            } else {
                // Jika key belum ada, buat objek baru tanpa id
                localStore[key] = {
                    value: newData[key].value,
                    text: newData[key].text,
                    score: newData[key].score,
                };
            }
        }
        return localStore;
  }

  function synchronizeDataApgar(newData) {
    let updatedData = {};

    // Mitigasi jika newData null, undefined, atau bukan array
    if (!Array.isArray(newData) || newData.length === 0) {
        console.warn('Data APGAR kosong atau tidak valid:', newData);
        return null; // bisa juga return {}, tergantung kebutuhan
    }

    newData.forEach(item => {
        if (!item || !item.jawaban || !item.atribut) {
            // Lewatkan jika struktur item rusak
            return;
        }

        let jawaban;
        try {
            jawaban = JSON.parse(item.jawaban);
        } catch (e) {
            console.warn('Gagal parse jawaban JSON:', item.jawaban);
            return;
        }

        const key = item.atribut;
        const value = jawaban?.value ?? null;
        const text = jawaban?.text ?? '';
        const score = jawaban?.score ?? 0;

        updatedData[key] = {
            value,
            text,
            score,
            id: item.id ?? null
        };
        });

        console.log('Data APGAR hasil sinkronisasi:', updatedData);
        return updatedData;
    }



</script>