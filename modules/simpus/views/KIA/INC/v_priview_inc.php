<div class="m-2">
        <!-- ALERT NOTIFIKASI (default: tidak tampil) -->
    <div id="notif-log-wrapper" class="p-2">
        <div id="notif-container" class="alert alert-success alert-dismissable" style="display: none;">
            <strong><i class="fa fa-check-circle"></i> Layanan ini sudah diverifikasi Satu Sehat</strong>
            <a href="#" id="showLogModal" class="pull-right text-success" title="Lihat detail layanan">
            <i class="fa fa-exclamation-circle fa-lg"></i>
            </a>
        </div>
    </div>
    <h2>Resume Pemeriksaan Pelayanan INC</h2>
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

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

                <div class="tab-pane fade in active " id="custom-tabs-three-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-three-messages-tab">
                    <div class="mt-2">
                        <h4>Kunjungan Persalinan</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="KunjunganPersalinan">
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Kala 1</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pemeriksaanKala1Table">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <h4> kala 2</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pemeriksaanKala2Table">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Kala 3</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pemeriksaanKala3Table">
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Kala 4</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <h5>Table Pemeriksaan Pasca Melahirkan</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Jam Ke</th>
                                            <th>Waktu</th>
                                            <th>Tekanan Darah</th>
                                            <th>Nadi</th>
                                            <th>Tinggi Fundus</th>
                                            <th>Kontraksi Uterus</th>
                                            <th>Kandung Kemih</th>
                                            <th>Pendarahan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pascaPersalianTable">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="PascaPersalinanLanjutTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Status dan Layanan Persalinan</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="layananPersalinanTable">
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>

                    <div class="mt-2">
                        <h4>Data Apgar Menit 1</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Penampilan</th>
                                            <th>Nadi</th>
                                            <th>Refleks</th>
                                            <th>Aktivitas</th>
                                            <th>Pernafasan</th>
                                            <th>Total Skor</th>
                                            <th>Klasifikasi</th>
                                            <th>Rentang Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="apgarTableBody1">

                                        <!-- Data akan diisi di sini -->
                                    </tbody>
                                </table>
                                <div id="noDataMessage1" style="display: none; color: red;">
                                    Pengisian APGAR menit 1 belum ada.
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Data Apgar Menit 5</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Penampilan</th>
                                            <th>Nadi</th>
                                            <th>Refleks</th>
                                            <th>Aktivitas</th>
                                            <th>Pernafasan</th>
                                            <th>Total Skor</th>
                                            <th>Klasifikasi</th>
                                            <th>Rentang Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="apgarTableBody5">

                                        <!-- Data akan diisi di sini -->
                                    </tbody>
                                </table>
                                <div id="noDataMessage5" style="display: none; color: red;">
                                    Pengisian APGAR menit 5 belum ada.
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Data Apgar Menit 10</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Penampilan</th>
                                            <th>Nadi</th>
                                            <th>Refleks</th>
                                            <th>Aktivitas</th>
                                            <th>Pernafasan</th>
                                            <th>Total Skor</th>
                                            <th>Klasifikasi</th>
                                            <th>Rentang Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="apgarTableBody10">

                                        <!-- Data akan diisi di sini -->
                                    </tbody>
                                </table>
                                <div id="noDataMessage10" style="display: none; color: red;">
                                    Pengisian APGAR menit 10 belum ada.
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>

                    <div class="mt-2">
                        <h4>Data Bayi</h4>
                        <hr style="border: 1px solid black;">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataBayiTableBody">
                                        <!-- Data akan diisi di sini -->
                                    </tbody>
                                </table>
                                <div id="noDataMessageBayi" style="display: none; color: red;">
                                    Pengisian data bayi belum ada.
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                    aria-labelledby="custom-tabs-three-settings-tab">
                    <div class="mt-2">
                        <div class="row">
                            <div id="loadDiagnosaData"></div>
                        </div>
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

    </div>
</div>
<div class="mt-2 btn-group">
    <button id="simpanPelayananButton" class="btn btn-success" type="button">Simpan Pelayanan</button>
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


<script>
$(document).ready(function() {

    let currentAction = null; // Untuk menyimpan aksi yang sedang diproses
    var berhasilSimpanDiagnosa;
    var log = <?= json_encode(isset($log) ? $log : [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
   

    function tampilkanNotifikasiVerifikasi(logData) {
        if (!Array.isArray(logData.log) || logData.log.length === 0) {
             return; // Jangan tampilkan alert jika tidak ada data
        }
       
        var list = $('#modal-log-list');
        var container = $('#notif-container');

        list.empty(); // Kosongkan dulu
        logData.log.forEach(function(item) {
            
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
    // menampilkan log
    tampilkanNotifikasiVerifikasi(log);

    function showDataSelection() {
        const dataSelectionList = $('#dataSelectionList');
        dataSelectionList.empty();
        
        // Daftar semua data yang mungkin ada di localStorage
        const dataOptions = [
            { key: 'kunjunganPersalinan', label: 'Kunjungan Persalinan (Belum Bisa Integrasi)' },
            { key: 'dataKeadaanIbu', label: 'Data Persalinan (Belum Bisa Integrasi)' },
            { key: 'apgar-1-data', label: 'Apgar Menit 1 (Belum Bisa Integrasi)' },
            { key: 'apgar-5-data', label: 'Apgar Menit 5 (Belum Bisa Integrasi)' },
            { key: 'apgar-10-data', label: 'Apgar Menit 10 (Belum Bisa Integrasi)' },
            { key: 'formBayi', label: 'Data Bayi (Belum Bisa Integrasi)' },
        ];
        
        // Tambahkan checkbox untuk setiap opsi data
        dataOptions.forEach(option => {
            const dataValue = localStorage.getItem(option.key);

            if (dataValue && dataValue !== 'undefined') {
                try {
                    const parsed = JSON.parse(dataValue);

                    // Cek apakah parsed adalah objek dan memiliki minimal satu properti
                    if (parsed && typeof parsed === 'object' && Object.keys(parsed).length > 0) {
                        console.log(`✅ Menampilkan: ${option.key}`, parsed);

                        dataSelectionList.append(`
                            <div class="form-check">
                                <input class="form-check-input data-checkbox" type="checkbox" 
                                    id="check_${option.key}" value="${option.key}" checked>
                                <label class="form-check-label" for="check_${option.key}">
                                    ${option.label}
                                </label>
                            </div>
                        `);
                    } else {
                        console.log(`⛔ Dilewati karena kosong: ${option.key}`);
                    }
                } catch (e) {
                    console.warn(`❌ Gagal parse data ${option.key}:`, dataValue);
                }
            }
        });

        // Tampilkan container pilihan data
        $('#dataSelectionContainer').show();
        
        // Handle check all
        $('#checkAllData').change(function() {
            $('.data-checkbox').not(this).prop('checked', $(this).prop('checked'));
        });
    }
    // Ketika tombol "Simpan Pelayanan" diklik
   // Tombol "Simpan Pelayanan"
    $('#simpanPelayananButton').click(function () {
        // Set pesan modal
        $('#modalBodyMessage').text('Apakah data Anda sudah benar? Data ini akan disimpan ke sistem.');

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
                    $('a[data-target="INC/assessment"]').trigger('click');
                });
        }


        // Sembunyikan bagian pilihan data
        $('#dataSelectionContainer').hide();

        // Simpan aksi
        currentAction = 'simpan';

        // Tampilkan modal terakhir setelah semua siap
        $('#confirmationModal').modal('show');
    });

    // Tombol "Kirim Satu Sehat"
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
                    $('a[data-target="INC/assessment"]').trigger('click');
                });
        }

        // Simpan aksi
        currentAction = 'kirim';

        // Tampilkan modal dulu, lalu tampilkan container-nya setelah modal benar-benar terbuka
        $('#confirmationModal').modal('show');

        // Gunakan event Bootstrap untuk menunggu sampai modal benar-benar ditampilkan
        $('#confirmationModal').one('shown.bs.modal', function () {
            $('#dataSelectionContainer').show(); // baru ditampilkan saat modal terbuka
            showDataSelection(); // isi daftar jika perlu
        });
    });




    // berupa parse data untuk valid local storage ready
    function checkLocalStoreHelper(value) {
        if (
            value !== null &&
            value !== undefined &&
            value !== "" &&
            !(Array.isArray(value) && value.length === 0) &&
            !(typeof value === "object" && Object.keys(value).length === 0)
        ) {
            return value; // Kembalikan nilai jika valid
        } else {
            return null; // Kembalikan null jika tidak valid
        }
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

    currentAction = '';
    var cooldownActive = false;
    var cooldownDuration = 10; // dalam detik

    // Ketika tombol "Ya, Lanjutkan" di modal diklik
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
        if (currentAction === 'simpan') {
            const berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
                    if (!berhasilSimpanDiagnosa) {
                        cooldownActive = false; // Batalkan cooldown kalau gagal
                        return;
            }
            //ambil data dari localStorage
            allData.kunjunganPersalinan = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'kunjunganPersalinan')));
            allData.dataKala1 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataKala1')));
            allData.dataKala2 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataKala2')));
            allData.dataKala3 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataKala3')));
            allData.dataKala4 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataFormBawah')));
            allData.dataKala4Detail = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataFormAtas')));
            allData.keadaanIbu = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'dataKeadaanIbu')));
            allData.apgar1 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'apgar-1-data')));
            allData.apgar5 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'apgar-5-data')));
            allData.apgar10 = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'apgar-10-data')));
            allData.bayi = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                'formBayi')));
          

            $.ajax({
                url: '<?= base_url('/simpus/INC/setStore') ?>', // Ganti dengan URL endpoint API Anda
                type: 'POST',
                data: allData, // Mengonversi objek menjadi string JSON
                dataType: 'json',
                success: function(response) {
                    // Tutup modal setelah pengiriman
                    $('#confirmationModal').modal('hide');
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan ke sistem Puskesmas.",
                        icon: "success",
                        timer: 2000,
                        buttons: false
                    });

                    setTimeout(() => {
                        $('#modalBodyMessage').html(`
                            <img src="https://play-lh.googleusercontent.com/iQQGOpfKhE2trpcIVJVux1ClJpyo5JFs4uWCIwnDw0uHc44KZMkEPvDNQLuaR7k0Ww" alt="Peringatan" style="width: 40px; height: 40px; display: block;">
                            <p style="text-align: left;">Apakah data Anda sudah benar? Data ini akan disimpan ke sistem.</p>
                        `);
                        // Simpan aksi
                        currentAction = 'kirim';

                        // Tampilkan modal dulu, lalu tampilkan container-nya setelah modal benar-benar terbuka
                        $('#confirmationModal').modal('show');

                        // Gunakan event Bootstrap untuk menunggu sampai modal benar-benar ditampilkan
                        $('#confirmationModal').one('shown.bs.modal', function () {
                            $('#dataSelectionContainer').show(); // baru ditampilkan saat modal terbuka
                            showDataSelection(); // isi daftar jika perlu
                        });
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    $('#confirmationModal').modal('hide');
                    let errorMessage = "Terjadi kesalahan saat menyimpan data !!";

                    if (xhr.responseJSON) {
                        const res = xhr.responseJSON;
                        if (res.errors && typeof res.errors === 'object') {
                            const messages = Object.values(res.errors);
                            errorMessage = messages.join('\n');
                        } else if (res.message) {
                            errorMessage = res.message;
                        }
                    }

                    swal("Gagal!", errorMessage, "error");
                }
            });
        } else if (currentAction === 'kirim') {
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
                url: '<?= site_url('satuSehatBridge/INCBriging/sendSatuSehatBundle') ?>',
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
        }
    });

    // Ketika tombol "Batal" di modal diklik
    $('.btn-secondary').click(function() {
        // Tutup modal
        $('#confirmationModal').modal('hide');
    });
    // Ambil data dari localStorage
    const storedData = JSON.parse(localStorage.getItem('kunjunganPersalinan')) || {};
    console.log('ini priview persalinan');
    console.log(storedData);

    // Cek apakah ada data yang disimpan
    if (Object.keys(storedData).length > 0) {
        // Ambil referensi ke tbody
        const tbody = $('#KunjunganPersalinan');

        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Usia Kehamilan',
                value: storedData.usiaKehamilan?.value || 0
            },
            {
                label: 'Tanggal Persalinan',
                value: storedData.tanggalPersalinan?.value || ''
            },
            {
                label: 'Waktu Persalinan',
                value: storedData.waktuPersalinan?.value || ''
            },
            {
                label: 'Gravida',
                value: storedData.gravida?.value || 1
            },
            {
                label: 'Partus',
                value: storedData.partus?.value || 1
            },
            {
                label: 'Abortus',
                value: storedData.abortus?.value || 1
            },
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }



    // Ambil data dari localStorage
    const storedKala1 = JSON.parse(localStorage.getItem('dataKala1')) || {};

    // Cek apakah ada data yang disimpan
    if (Object.keys(storedKala1).length > 0) {
        // Disable semua elemen form
        $('#formkala1 select, #formkala1 textarea').prop('disabled', true);

        // Ambil referensi ke tbody
        const tbody = $('#pemeriksaanKala1Table');

        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Patogram',
                value: storedKala1.patogram?.value || ''
            },
            {
                label: 'Deskripsi',
                value: storedKala1.deskripsi?.value || ''
            },
            {
                label: 'Masalah Lain',
                value: storedKala1.masalahLain?.value || ''
            },
            {
                label: 'Penatalaksanaan',
                value: storedKala1.penatalaksanaan?.value || ''
            },
            {
                label: 'Hasil',
                value: storedKala1.hasil?.value || ''
            }
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }

    // Mengambil data dari localStorage saat halaman dimuat
    const storedData1 = JSON.parse(localStorage.getItem('dataKala2')) || {};
    if (Object.keys(storedData1).length > 0) {
        // Disable semua elemen form


        // Ambil referensi ke tbody
        const tbody = $('#pemeriksaanKala2Table');

        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Patogram Garis',
                value: storedData1.patogramGaris?.value || 'Ya'
            },
            {
                label: 'Indikasi Patogram',
                value: storedData1.indikasiPatogram?.value || ''
            },
            {
                label: 'Gawat Janin',
                value: storedData1.gawatJanin?.value || 'Ya'
            },
            {
                label: 'Tindakan Gawat',
                value: storedData1.tindakanGawat?.value || ''
            },
            {
                label: 'Distosia Bahu',
                value: storedData1.distosiaBahu?.value || 'Ya'
            },
            {
                label: 'Tindakan Distosia',
                value: storedData1.tindakanDistosia?.value || ''
            },
            {
                label: 'Masalah Lain',
                value: storedData1.masalahLain?.value || ''
            },
            {
                label: 'Penatalaksanaan',
                value: storedData1.penatalaksanaan?.value || ''
            },
            {
                label: 'Hasil Masalah',
                value: storedData1.hasilMasalah?.value || ''
            }
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }


    // Mengambil data dari localStorage saat halaman dimuat
    const storedData3 = JSON.parse(localStorage.getItem('dataKala3')) || {};
    if (Object.keys(storedData3).length > 0) {

        // Disable semua elemen form
        // Ambil referensi ke tbody
        const tbody = $('#pemeriksaanKala3Table');
        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Plasenta',
                value: storedData3.plasenta?.value || 'Lengkap'
            },
            {
                label: 'Penanganan Plasenta',
                value: storedData3.penangananPlasenta?.value || ''
            },
            {
                label: 'Perdarahan',
                value: storedData3.perdarahan?.value || 'Tidak Ada'
            },
            {
                label: 'Tindakan Perdarahan',
                value: storedData3.tindakanPerdarahan?.value || ''
            },
            {
                label: 'Masalah Lain',
                value: storedData3.masalahLainKala3?.value || ''
            },
            {
                label: 'Penatalaksanaan',
                value: storedData3.penatalaksanaanKala3?.value || ''
            },
            {
                label: 'Hasil',
                value: storedData3.hasilKala3?.value || ''
            }
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }

    function klasifikasiCaraPersalinan(selectedValue) {
        if (selectedValue === "48782003") {
            return "Normal";
        } else if (selectedValue === "200138003") {
            return "Vakum";
        } else if (selectedValue === "200130005") {
            return "Forceps";
        } else if (selectedValue === "200144004") {
            return "Sectio Caesaria";
        }
    }

    function klasifikasiPenolongPersalinan(selectedValue) {
        if (selectedValue === "303071001") {
            return "Keluarga";
        } else if (selectedValue === "OV000012") {
            return "Dukun";
        } else if (selectedValue === "309453006") {
            return "Bidan";
        } else if (selectedValue === "309343006") {
            return "Dokter";
        } else if (selectedValue === "11935004") {
            return "Dokter Spesialis";
        } else if (selectedValue === "249215002") {
            return "Lokhia Berbau";
        }
    }

    function klasifikasiInisiasiKeadaanIbu(selectedValue) {
        if (selectedValue === "102514002") {
            return "Sehat";
        } else if (selectedValue === "39104002") {
            return "Sakit";
        } else if (selectedValue === "47821001") {
            return "Perdarahan";
        } else if (selectedValue === "386661006") {
            return "Demam atau Kejang"; // Nilai sama untuk Demam dan Kejang
        } else if (selectedValue === "249215002") {
            return "Lokhia Berbau";
        } else if (selectedValue === "74964007") {
            return "Lain - lain";
        }
    }

    function klasifikasiMenyusui(value) {
        if (value == 'OV000014') {
            return 'Kurang dari 1 Jam';
        } else if (value == 'OV000015') {
            return 'Lebih dari 1 Jam';
        }
    }

    function renderTable() {
        let dataAtas = {};
        const raw = localStorage.getItem('dataFormAtas');
        console.log('ini data di render table:', raw);

        try {
            if (raw && raw !== 'undefined' && raw !== undefined && raw !== null) {
                const parsed = JSON.parse(raw);
                if (parsed && typeof parsed === 'object' && !Array.isArray(parsed)) {
                    dataAtas = parsed;
                }
            }
        } catch (e) {
            console.error('Error parsing localStorage data:', e);
        }



        // Ini untuk disable tombol simpan jika sudah 3 atau lebih data
        $('#simpan-table').prop('disabled', Object.keys(dataAtas).length >= 3);

        const tableBody = $('#pascaPersalianTable');
        tableBody.empty();

        Object.entries(dataAtas).forEach(([key, entry], index) => {
            const data = entry?.value || {};
            console.log(data);

            const row = `
        <tr>
            <td>${key}</td>
            <td>${data.waktu || ''}</td>
            <td>${data.tekananDarah || ''}</td>
            <td>${data.nadi || ''}</td>
            <td>${data.tinggiFundus || ''}</td>
            <td>${data.kontraksiUterus || ''}</td>
            <td>${data.kandungKemih || ''}</td>
            <td>${data.pendarahan || ''}</td>
        </tr>
        `;
            tableBody.append(row);
        });
    }




    renderTable();

    // Mengambil data dari localStorage saat halaman dimuat
    const dataBawah = JSON.parse(localStorage.getItem('dataFormBawah')) || {};
    if (Object.keys(dataBawah).length > 0) {
        // Disable semua elemen form

        // Ambil referensi ke tbody
        const tbody = $('#PascaPersalinanLanjutTable');

        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Masalah Kala IV',
                value: dataBawah.masalahKalaIV?.value || ''
            },
            {
                label: 'Penatalaksanaan Masalah',
                value: dataBawah.penatalaksanaanMasalah?.value || ''
            },
            {
                label: 'Hasil',
                value: dataBawah.hasil?.value || ''
            }
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }

    // Mengambil data dari localStorage saat halaman dimuat
    const storedDataBersalin = JSON.parse(localStorage.getItem('dataKeadaanIbu')) || {};
    if (Object.keys(storedDataBersalin).length > 0) {
        // Disable semua elemen form

        // Ambil referensi ke tbody
        const tbody = $('#layananPersalinanTable');

        // Buat array dari data yang ingin ditampilkan
        const dataToDisplay = [{
                label: 'Keadaan Ibu',
                value: klasifikasiInisiasiKeadaanIbu(storedDataBersalin.keadaanIbu?.value) || ''
            },
            {
                label: 'Deskripsi Keadaan Ibu',
                value: storedDataBersalin.deskripsiKeadaanIbu?.value || ''
            },
            {
                label: 'Penolong Persalinan',
                value: klasifikasiPenolongPersalinan(storedDataBersalin.penolongPersalinan?.value) || '1'
            },
            {
                label: 'Deskripsi Penolong',
                value: storedDataBersalin.deskripsiPenolong?.value || ''
            },
            {
                label: 'Cara Persalinan',
                value: klasifikasiCaraPersalinan(storedDataBersalin.caraPersalinan?.value) || '1'
            }
        ];

        // Loop melalui data dan buat elemen tr dan td
        dataToDisplay.forEach(data => {
            const tr = $('<tr></tr>');
            const tdLabel = $('<td></td>').text(data.label);
            const tdValue = $('<td></td>').text(data.value);

            // Tambahkan td ke tr
            tr.append(tdLabel);
            tr.append(tdValue);

            // Tambahkan tr ke tbody
            tbody.append(tr);
        });
    }

    function loadDataFromLocalStorage(timePoint, idbody, idNodata) {
        const savedData = localStorage.getItem(`apgar-${timePoint}-data`);
        console.log('priview apgar load data apgar');
        console.log(savedData);
        const tbody = $(idbody);
        const noDataMessage = $(idNodata);

        if (Object.keys(savedData).length) {
            const data = JSON.parse(savedData);
            console.log(timePoint + 'apgar');
            console.log(data);

            // Membuat elemen tr untuk data
            const tr = $('<tr></tr>');
            tr.append($('<td></td>').text(`Menit ${timePoint}`)); // Menambahkan waktu

            // Mengisi nilai form dengan data dari localStorage
            tr.append($('<td></td>').text(data.appearance?.text || ''));
            tr.append($('<td></td>').text(data.pulse?.text || ''));
            tr.append($('<td></td>').text(data.grimace?.text || ''));
            tr.append($('<td></td>').text(data.activity?.text || ''));
            tr.append($('<td></td>').text(data.respiration?.text || ''));
            // Menampilkan klasifikasi dan rentang skor
            tr.append($('<td></td>').text(data.totalScore?.value || ''));
            tr.append($('<td></td>').text(data.totalScore?.text || ''));
            tr.append($('<td></td>').text(data.totalScore?.score || ''));

            // Menambahkan tr ke tbody
            tbody.append(tr);

            // Sembunyikan pesan tidak ada data
            noDataMessage.hide();
        } else {
            // Jika tidak ada data, tampilkan pesan
            noDataMessage.show();
        }
    }

    // Memanggil fungsi untuk setiap waktu
    loadDataFromLocalStorage(1, '#apgarTableBody1', '#noDataMessage1'); // APGAR Menit 1
    loadDataFromLocalStorage(5, '#apgarTableBody5', '#noDataMessage5'); // APGAR Menit 5
    loadDataFromLocalStorage(10, '#apgarTableBody10', '#noDataMessage10'); // APGAR Menit 10


    function klasifikasiBeratBayi(berat) {
        const beratGram = parseInt(berat);

        if (isNaN(beratGram)) return '-';

        if (beratGram >= 4000) {
            return 'BBLB (Bayi Berat Lahir Besar) [>=4000gr]';
        } else if (beratGram >= 2500) {
            return 'BBLC (Bayi Berat Lahir Cukup) [2500gr s/d 3999gr]';
        } else if (beratGram >= 1500) {
            return 'BBLR (Bayi Berat Lahir Rendah) [1500gr s/d 2499gr]';
        } else if (beratGram >= 1000) {
            return 'BBLSR (Bayi Berat Lahir Sangat Rendah) [1000gr s/d 1499gr]';
        } else {
            return 'BLASR (Bayi Berat Lahir Amat Sangat Rendah) [< 1000gr]';
        }
    }

    function loadDataFromLocalStorageBayi(formId) {
        const savedData = localStorage.getItem(formId);
        const tbody = $('#dataBayiTableBody');
        const noDataMessage = $('#noDataMessageBayi');
        console.log('data_bayi');
        console.log(savedData);

        // Kosongkan tbody terlebih dahulu
        tbody.empty();

        // Cek jika savedData tidak ada, null, undefined, atau {}
        if (!savedData || savedData === 'null' || savedData === 'undefined' || savedData === '{}') {
            noDataMessage.show().text('Data pemeriksaan tidak ada');
            return; // Keluar dari fungsi
        }

        try {
            const formData = JSON.parse(savedData);

            // Cek jika formData kosong atau tidak memiliki properti yang diharapkan
            if (!formData || Object.keys(formData).length === 0) {
                noDataMessage.show().text('Data pemeriksaan tidak ada');
                return;
            }

            const dataToDisplay = [{
                    label: 'Berat Bayi',
                    value: formData.beratBayi?.value || '-'
                },
                {
                    label: 'Interpretasi Berat Bayi',
                    value: klasifikasiBeratBayi(formData.beratBayi?.value) || '-'
                },
                {
                    label: 'Panjang Bayi',
                    value: formData.panjangBayi?.value || '-'
                },
                {
                    label: 'Lokasi Persalinan',
                    value: formData.lokasiPersalinan?.value || '-'
                },
                {
                    label: 'Inisiasi Menyusui',
                    value: formData.inisiasiMenyusui?.value || '-'
                },
                {
                    label: 'Waktu Inisiasi',
                    value: klasifikasiMenyusui(formData.waktuInisiasi?.value) || '-'
                }
            ];

            // Loop melalui data dan buat elemen tr dan td
            dataToDisplay.forEach(data => {
                const tr = $('<tr></tr>');
                tr.append($('<td></td>').text(data.label));
                tr.append($('<td></td>').text(data.value));
                tbody.append(tr);
            });

            // Sembunyikan pesan tidak ada data
            noDataMessage.hide();

        } catch (error) {
            console.error('Error parsing saved data:', error);
            noDataMessage.show().text('Data pemeriksaan tidak valid');
        }
    }

    // Memanggil fungsi dengan formId yang sesuai
    loadDataFromLocalStorageBayi('formBayi'); // Ganti 'formId' dengan ID yang sesuai

    getDataDiagnosa();

    function getDataDiagnosa() {
        var idLoket = "<?= $loket_id ?>";
        var idPelayanan = "<?= $item['idpelayanan'] ?>";
        load('simpus/pelayanan/loadDiagnosaData/' + idLoket + '/' + idPelayanan, '#loadDiagnosaData');
    }

    getDataImunisasi();

    function getDataImunisasi() {
        var idLoket = '<?= $item['idLoket'] ?>';
        var idPelayanan = '<?= $item['idpelayanan'] ?>';
        load('simpus/imunisasi/loadImunisasiData/' + idLoket + '/' + idPelayanan, '#loadImunisasiData');
    }

    getDataTindakan();

    function getDataTindakan() {
        var idLoket = "<?= $loket_id ?>";
        var kdPoli = "<?= $item['kdPoli'] ?>";
        load('simpus/pelayanan/loadTindakanData/icd9cm/' + idLoket + '/' + kdPoli, '#loadTindakanData');
    }

    getDataRujuk();

    function getDataRujuk() {
        load('simpus/pelayanan/loadRujukData/<?= $loket_id ?>', '#loadRujukData');
    }

});
</script>