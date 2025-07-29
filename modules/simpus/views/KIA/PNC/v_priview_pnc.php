<div class="m-2">
     <div id="notif-log-wrapper" class="p-2">
        <div id="notif-container" class="alert alert-success alert-dismissable" style="display: none;">
            <strong><i class="fa fa-check-circle"></i> Layanan ini sudah diverifikasi Satu Sehat</strong>
            <a href="#" id="showLogModal" class="pull-right text-success" title="Lihat detail layanan">
            <i class="fa fa-exclamation-circle fa-lg"></i>
            </a>
        </div>
    </div>
    <h2>Resumen Medis Postnatal Care</h2>
    <div class="row">
        <div class="col-lg-6">
            <h5>Detail Resume</h5>
        </div>
        <div class="col-lg-6">
            <h5>Tanggal Kunjungan : <?= $item['tglKunjungan'] ?> </h5>
        </div>
    </div>

    <div class="m-2 p-2">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

                    <li class="nav-item active">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                            href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                            aria-selected="false">Subjektif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Objektif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings"
                            aria-selected="false">Assesment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-imunisasi" role="tab" aria-controls="custom-tabs-three-imunisasi"
                            aria-selected="false">Imunisasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-planning" role="tab" aria-controls="custom-tabs-three-planning"
                            aria-selected="false">Planning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-status_pasien" role="tab"
                            aria-controls="custom-tabs-three-status_pasien" aria-selected="false">Status Pasien</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade in active" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">
                        <!-- layanan pemeriksaan kunjungan -->
                        <div class="mt-2">
                            <h4>Riwayat Persalinan</h4>
                            <hr style="border: 1px solid black;">
                            <div id="riwayat_persalinan_pnc" class="mt-3">
                            </div>
                        </div>
                      
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        <div class="mt-2">
                            <h4>Pelayanan Nifas</h4>
                            <hr style="border: 1px solid black;">
                            <div id="nifas_pnc" class="mt-3">
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        <div class="row">
                            <div id="loadDiagnosaData"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-imunisasi" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        <div class="mt-2">
                        <div class="row">
                            <div id="loadImunisasiData"></div>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-planning" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                         <div class="mt-2">
                            <div class="row">
                                <div id="loadTindakanData"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-status_pasien" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        <div class="mt-2">
                            <div class="row">
                                <div id="loadRujukData">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="mt-2 btn-group">
        <button id="kirimSatuSehatButton" class="btn btn-primary disable" style="margin-left: 5px;" type="button">Kirim
            Satu Sehat</button>
    </div>

    <!-- Modal Konfirmasi -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-bold" id="confirmationModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="bg-warning m-2 p-2">
                            <div class="mt-2" id="diagnosaNotFound" style="display: none;">
                            <div class="alert alert-danger alert-dismissable">
                                <strong><i class="fa fa-exclamation-circle"></i> Data diagnosa belum ada.</strong>
                                <button id="goToAssessment" class="btn btn-sm btn-success pull-right">
                                    <i class="fa fa-arrow-right"></i> Ke Layanan Assessment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="modalBodyMessage">
                    <!-- Pesan akan diisi secara dinamis -->
                </div>
                <div class="modal-body" id="dataSelectionContainer" style="display:none;">
                        <h5>Pilih data yang akan dikirim ke Satu Sehat:</h5>
                        <div class="bg-warning m-2 p-2">
                            <p class="text-bold">Catatan !!!</p>
                            <p class="text-danger m-1 rounded">Setiap Memilih resource dikirimkan harus diperhatikan betul pelayanan apa yang sudah dilakukan !!!</p>
                            <p class="text-danger m-1 rounded">Setiap Mengirim akan otomatis mengirim diagnosa dari kunjungan hari ini !!!</p>
                            
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input data-checkbox" type="checkbox" id="checkAllData" checked>
                                <label class="form-check-label" for="checkAllData">
                                    Pilih Semua Data
                                </label>
                            </div>
                            <div id="dataSelectionList" class="ml-3">
                                <!-- Daftar checkbox akan diisi secara dinamis -->
                            </div>
                            
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="confirmActionButton" class="btn btn-primary">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
     <!-- MODAL UNTUK LIHAT DETAIL LOG -->
    <div id="logModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="logModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="logModalLabel"><i class="fa fa-list"></i> Detail Layanan Diverifikasi</h4>
            </div>
            <div class="modal-body">
                <ul id="modal-log-list" class="list-unstyled"></ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

</div>



<script>

    function tampilkanNotifikasiVerifikasi(logData) {

         if (!Array.isArray(logData) || logData.length === 0) {
                return; // Jangan tampilkan alert jika tidak ada data
            }
        
            var list = $('#modal-log-list');
            var container = $('#notif-container');

            list.empty(); // Kosongkan dulu
            logData.forEach(function(item) {
                
            var layanan = item.sub_layanan || 'Tidak diketahui';
            var start = item.start || '-';
            var end = item.end || '-';

            var itemHTML = '<li class="text-success">' +
                            '<i class="fa fa-check"></i> ' +
                            '<strong>' + layanan + '</strong> dari <em>' + start + '</em> sampai <em>' + end + '</em>' +
                            '</li>';

                 list.append(itemHTML);
            });
            // Tampilkan alert jika data ada
            container.fadeIn();
            // Tampilkan modal saat icon diklik
            $('#showLogModal').on('click', function(e) {
            e.preventDefault();
            $('#logModal').modal('show');
        });
     }
     function synchronizeData(newData) {
      let updatedData = {};

      if (newData.length === 0) {
          // Jika data kosong, kembalikan null sebagai feedback
          return null;
      } else {
          newData.forEach(item => {
              const key = item.atribut;
              const value = JSON.parse(item.jawaban).value;
              updatedData[key] = {
                  value: value,           // Simpan nilai
                  id: item.id ?? null     // Tambahkan id jika ada
              };
          });

          // Return data sebagai hasil sinkronisasi
          return updatedData;
      }

    }

    function renderRiwayatPersalinanTable(data) {
        const container = $('#riwayat_persalinan_pnc');
        container.empty(); // Kosongkan sebelum render ulang

        // Buat elemen tabel
        const table = $('<table class="table table-bordered table-sm w-100"></table>');
        const thead = $('<thead><tr><th>Atribut</th><th>Nilai</th></tr></thead>');
        const tbody = $('<tbody></tbody>');

        // Pastikan data adalah objek
        const safeData = (typeof data === 'object' && data !== null) ? data : {};

        Object.entries(safeData).forEach(([key, item]) => {
            let value = 'tidak ada data';

            if (item !== undefined && item !== null) {
                value = (item.value !== undefined && item.value !== null) ? item.value : 'tidak ada data';
            }

            const row = $('<tr></tr>');
            row.append(`<td>${key}</td>`);
            row.append(`<td>${value}</td>`);
            tbody.append(row);
        });

        table.append(thead);
        table.append(tbody);
        container.append(table);
    }

    function renderNifas(data) {
        const container = $('#nifas_pnc');
        container.empty(); // Bersihkan kontainer

        const table = $('<table class="table table-bordered table-sm w-100"></table>');
        const thead = $('<thead><tr><th>Atribut</th><th>Nilai</th></tr></thead>');
        const tbody = $('<tbody></tbody>');

        // Pastikan data adalah objek
        const safeData = (typeof data === 'object' && data !== null) ? data : {};

        // Jika objek kosong, tambahkan baris kosong
        if (Object.keys(safeData).length === 0) {
            const row = $('<tr><td>(Tidak ada)</td><td>tidak ada data</td></tr>');
            tbody.append(row);
        } else {
            Object.entries(safeData).forEach(([key, item]) => {
                const value = (item && item.value !== undefined && item.value !== null) ? item.value : 'tidak ada data';
                const row = $('<tr></tr>');
                row.append(`<td>${key}</td>`);
                row.append(`<td>${value}</td>`);
                tbody.append(row);
            });
        }

        table.append(thead);
        table.append(tbody);
        container.append(table);
    }

    function getDataDiagnosa() {
        var idLoket = "<?= $loket_id ?>";
        var idPelayanan = "<?= $item['idpelayanan'] ?>";
        load('simpus/pelayanan/loadDiagnosaData/' + idLoket + '/' + idPelayanan, '#loadDiagnosaData');
    }
    function getDataImunisasi() {
        var idLoket = '<?= $item['idLoket'] ?>';
        var idPelayanan = '<?= $item['idpelayanan'] ?>';
        load('simpus/imunisasi/loadImunisasiData/' + idLoket + '/' + idPelayanan, '#loadImunisasiData');
    }
    function getDataTindakan() {
        var idLoket = "<?= $loket_id ?>";
        var kdPoli = "<?= $item['kdPoli'] ?>";
        load('simpus/pelayanan/loadTindakanData/icd9cm/' + idLoket + '/' + kdPoli, '#loadTindakanData');
    }
    function getDataRujuk() {
        load('simpus/pelayanan/loadRujukData/<?= $loket_id ?>', '#loadRujukData');
    }
    
    function simpanDiagnosaKeLocalStorage() {
        const table = document.getElementById("list_diagnosa");
        const rows = table.querySelectorAll("tbody tr");

        if (rows.length === 0) {
            swal("Tidak ada data diagnosa!", "Silakan tambahkan diagnosa sebelum mengirim data.", "warning");
            return false;
        }

        const dataDiagnosa = [];
        let formatError = false;

        rows.forEach(row => {
            const diagnosaText = row.querySelectorAll("td")[1]?.innerText.trim();

            // Validasi format harus seperti: [A01.0] Typhoid fever
            const match = diagnosaText.match(/^\[(.+?)\]\s*(.+)$/);

            if (match) {
                dataDiagnosa.push({
                    value: match[1],
                    display: match[2]
                });
            } else {
                formatError = true;
            }
        });

        if (formatError) {
            swal("Format Diagnosa Tidak Cocok!", "Silakan hapus dan ulangi pengisian Diagnosa", "warning");
            return false;
        }

        localStorage.setItem("diagnosaList", JSON.stringify(dataDiagnosa));
        console.log("✅ Diagnosa disimpan:", dataDiagnosa);
        return true;
    }



    function showDataSelection(dataMap) {
        const dataSelectionList = $('#dataSelectionList');
        dataSelectionList.empty();

        Object.entries(dataMap).forEach(([key, config]) => {
            const dataValue = config.data;

            // Validasi data seperti biasa
            if (dataValue && typeof dataValue === 'object' && Object.keys(dataValue).length > 0) {
                console.log(`✅ Menampilkan: ${key}`, dataValue);

                dataSelectionList.append(`
                    <div class="form-check">
                        <input class="form-check-input data-checkbox" type="checkbox" 
                            id="check_${key}" value="${key}" checked>
                        <label class="form-check-label" for="check_${key}">
                            ${config.label}
                        </label>
                    </div>
                `);
            } else {
                console.log(`⛔ Dilewati karena kosong atau tidak valid: ${key}`);
            }
        });
    }

    //get data-dismiss
    $(document).ready(function () {
        let dataLoad;
        const loadDataRiwayat =  <?=  json_encode($riwayat) ?? null?>;
        const loadNifas = <?= json_encode($nifas) ?? null ?>;
        const logSatuSehat = <?= json_encode($log) ?? null ?>;
        
        let currentAction;

        //check log satu sehat list
        tampilkanNotifikasiVerifikasi(logSatuSehat);
        if(loadDataRiwayat != null){
            dataLoad =  synchronizeData(loadDataRiwayat);
            renderRiwayatPersalinanTable(dataLoad);
           
        }
        if(loadNifas != null){
            dataLoad = synchronizeData(loadNifas);
            renderNifas(dataLoad);
        }

        getDataDiagnosa();
        getDataImunisasi();
        getDataTindakan();
        getDataRujuk();

        $('#kirimSatuSehatButton').click(function () {
            // Set pesan modal

            $('#modalBodyMessage').html(`
                <img src="https://play-lh.googleusercontent.com/iQQGOpfKhE2trpcIVJVux1ClJpyo5JFs4uWCIwnDw0uHc44KZMkEPvDNQLuaR7k0Ww" alt="Peringatan" style="width: 40px; height: 40px; display: block;">
                <p style="text-align: left;">Apakah data Anda sudah benar? Data ini akan disimpan ke Satu Sehat.</p>
            `);

            berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
            if(!berhasilSimpanDiagnosa){
                $('#confirmActionButton').prop('disabled', true);
                $('#diagnosaNotFound').show();
                // Tombol ke layanan assessment
                    $('#goToAssessment').off('click').on('click', function () {
                            $('#confirmationModal').modal('hide');
                            // Hide notif diagnosa
                            $('#diagnosaNotFound').hide();
                            // Hapus modal backdrop
                            $('.modal-backdrop').remove();
                            // Hapus class modal-open di body
                            $('body').removeClass('modal-open');
                        $('a[data-target="PNC/assessment"]').trigger('click');
                    });
            }

            // Simpan aksi
            currentAction = 'kirim';

            // Tampilkan modal dulu, lalu tampilkan container-nya setelah modal benar-benar terbuka
            $('#confirmationModal').modal('show');

            // Gunakan event Bootstrap untuk menunggu sampai modal benar-benar ditampilkan
            $('#confirmationModal').one('shown.bs.modal', function () {
                $('#dataSelectionContainer').show(); // baru ditampilkan saat modal terbuka
                const dataMap = {
                    riwayatPersalinan: {
                        label: 'Riwayat Persalinan',
                        data: loadDataRiwayat
                    },
                    nifasData: {
                        label: 'Data Nifas',
                        data: loadNifas
                    },
                    // Tambahkan lainnya jika perlu
                };
                showDataSelection(dataMap); // isi daftar jika perlu
            });
        }); 

        var cooldownActive = false;
        var cooldownDuration = 10; // dalam detik
        $('#confirmActionButton').click(function() {
            if (cooldownActive) {
                swal("Tunggu Dulu!", "Silakan tunggu " + cooldownDuration + " detik sebelum mencoba lagi.", "warning");
                return; // STOP EKSEKUSI
            }

            cooldownActive = true; // Aktifkan cooldown

            // Hitung mundur dan tampilkan informasi swal jika ingin
            let remainingTime = cooldownDuration;
            const countdownInterval = setInterval(function () {
                remainingTime--;
                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                    cooldownActive = false; // Reset cooldown
                }
            }, 1000);

            const allData = {
                pasien_id: '<?= $pasien_id ?>',
                loket_id: '<?= $loket_id ?>',
                puskesmas: '<?= $puskesmas ?>',
                pasien: JSON.stringify(<?= json_encode($pasien) ?>),
                type: 'form',
                actv_service: actv_service,
                id_dokter: '<?= $item["kdDokter"] ?>',
                start: '<?= $start ?>',
            };
                  
            const berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
            if (!berhasilSimpanDiagnosa) {
                cooldownActive = false; // Batalkan cooldown kalau gagal
                return;
            }

            $('.data-checkbox:checked').not('#checkAllData').each(function () {
                const dataKey = $(this).val();
                if (localStorage.getItem(dataKey)) {
                    allData[dataKey] = JSON.parse(localStorage.getItem(dataKey));
                }
            });

            if (localStorage.getItem('diagnosaList')) {
                allData.diagnosaList = JSON.parse(localStorage.getItem('diagnosaList'));
            } else {
                cooldownActive = false;
                swal("Data Diagnosa Belum Ada", "Mohon untuk memilih diagnosa terlebih dahulu.", "error");
                return;
            }
            // Logika untuk mengirim data ke Satu Sehat
            $.ajax({
                url: '<?= site_url('satuSehatBridge/PNCBriging/sendSatuSehatBundle') ?>',
                type: 'POST',
                data: allData,
                dataType: 'json',
                success: function (response) {
                    $('#confirmationModal').modal('hide');
                    swal("Berhasil!", "Data berhasil dikirim ke Satu Sehat.", "success");
                },
                error: function (xhr) {
                    $('#confirmationModal').modal('hide');
                    let errorMessage = "Terjadi kesalahan saat menyimpan data Satu Sehat";

                    if (xhr.responseJSON) {
                        const res = xhr.responseJSON;
                        if (res.errors && typeof res.errors === 'object') {
                            const messages = Object.values(res.errors).map(err => err.details).filter(Boolean);
                            errorMessage = messages.join('\n');
                        } else if (res.message) {
                            errorMessage = res.message;
                        }
                    }

                    swal("Gagal Dalam Mengirim Satu Sehat!", errorMessage, "error");
                }
            });
        
       });
    });

</script>