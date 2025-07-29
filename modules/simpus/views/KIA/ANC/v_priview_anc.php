

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

    <h2>Resumen Medis Antenatal Care</h2>
    
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
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                            href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                            aria-selected="true">Obsetri</a>
                    </li>
                    <li class="nav-item">
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
                <div class="tab-content " id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade in active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <div class="m-2">
                            <h2>Observation</h2>
                            <div class="mt-2">
                                <div class="btn-group">
                                    <h4>A. Pemeriksaan Obsetri</h4>
                                </div>
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
                                            <tbody id="dataPreviewTable">
                                                <tr>
                                                    <td>Gravida :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->gravida) ? htmlspecialchars($obstetri->gravida) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Partus :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->partus) ? htmlspecialchars($obstetri->partus) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Abortus :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->abortus) ? htmlspecialchars($obstetri->abortus) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal TPHPT :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->tphtDate) ? htmlspecialchars($obstetri->tphtDate) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Berat badan sebelum hamil :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->bbSebelumHamil) ? htmlspecialchars($obstetri->bbSebelumHamil) . ' Kg' : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tinggi badan sebelum hamil :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->tinggiBadan) ? htmlspecialchars($obstetri->tinggiBadan) . ' Cm' : '-' ?></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataPreviewTable">
                                                <tr>
                                                    <td>Berat badan target :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->bb_target) ? htmlspecialchars($obstetri->bb_target) . ' Kg' : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Indeks Masa Tubuh :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->imt) ? htmlspecialchars($obstetri->imt) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status Indeks Masa Tubuh :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->status_imt) ? htmlspecialchars($obstetri->status_imt) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jarak Hamil :</td>
                                                    <td><?= isset($obstetri) && isset($obstetri->jarak_hamil) ? htmlspecialchars($obstetri->jarak_hamil) . ' bulan' : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status Imunisasi Tetanus :</td>
                                                    <td>
                                                        <?php
                                                            if (isset($obstetri) && isset($obstetri->imunisasiTtStatus)) {
                                                                echo $obstetri->imunisasiTtStatus == 1 ? 'pernah' : 'belum pernah';
                                                            } else {
                                                                echo '-';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                                <div class="row mt-3 m-3">
                                    <div class="col-lg-12">
                                        <h5>B. Status Imunisasi Tetanus</h5>
                                        <hr style="border: 1px solid black;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Dosis</th>
                                                    <th>Tanggal</th>
                                                    <th>No Batch</th>
                                                    <th>Nama Vaksin</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataPreviewTableImunisasi">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">
                        <!-- layanan pemeriksaan kunjungan -->
                        <div class="mt-2">
                            <h4>Pemeriksaan Kunjungan</h4>
                            <hr style="border: 1px solid black;">
                            <div id="layanan_kunjungan" class="row mt-3">
                                <div class="col-lg-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pemeriksaan</th>
                                                <th>Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataPreviewTable">
                                            <tr>
                                                <td>Tanggal Kunjungan : </td>
                                                <td id="tanggal_kunjungan"></td>
                                            </tr>
                                            <tr>
                                                <td>Usia Kehamilan : </td>
                                                <td id="usia_kehamilan"></td>
                                            </tr>
                                            <tr>
                                                <td>Tri Semester : </td>
                                                <td id="trimester"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-bordered">

                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- layanan pemeriksaan pemantauan dan riwayat -->
                        <div class="mt-2">
                            <h4>Pemeriksaan Pemantauan dan Riwayat</h4>
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
                                        <tbody id="dataPreviewTableObsetri">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        <div class="mt-2">
                            <h4>Pemeriksaan Ibu</h4>
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
                                        <tbody id="pemeriksaanIbuTable">
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Pemeriksaan Fisik Ibu</h4>
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
                                        <tbody id="pemeriksaanFisikIbuTable">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">

                                </div>

                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Pemeriksaan USG</h4>
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
                                        <tbody id="pemeriksaanUsgTable">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                </div>

                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Pemeriksaan Janin</h4>
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
                                        <tbody id="form1Table">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">

                                </div>

                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Pemeriksaan 10T</h4>
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
                                        <tbody id="pemeriksaan10TTable">

                                        </tbody>
                                    </table>
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
            <!-- /.card -->
        </div>
    </div>
    <div class="mt-2 btn-group">
        <button id="simpanPelayananButton" class="btn btn-success" type="button">Simpan Pelayanan</button>
        <button id="kirimSatuSehatButton" class="btn btn-primary disable" style="margin-left: 5px;" type="button">Kirim
            Satu Sehat</button>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="bg-warning m-2 p-2">
                            <div class="mt-2" id="obstetriNotFound" style="display: none;">
                            <div class="alert alert-danger alert-dismissable">
                                <strong><i class="fa fa-exclamation-circle"></i> Data Obstetri belum ada.</strong>
                                <button id="goToObstetri" class="btn btn-sm btn-success pull-right">
                                    <i class="fa fa-arrow-right"></i> Ke Layanan Obstetri
                                </button>
                            </div>
                        </div>
                    </div>
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
                        <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="checkObstetriData" checked>
                        <label class="form-check-label" for="checkObstetriData">
                            Data Obstetri
                        </label>
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

$(document).ready(function() {
    let currentAction = null; // Untuk menyimpan aksi yang sedang diproses
    var obsteri = <?= json_encode($obstetri)  ?? null ?>;
    var log = <?= json_encode(isset($log) ? $log : [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    var berhasilSimpanDiagnosa;
    var dataImunisasiStatus;
     <?php if ($obstetri): ?>
        dataImunisasiStatus = <?= json_encode([
            'imunisasi_doss_1' => json_decode($obstetri->imunisasi_doss_1, true),
            'imunisasi_doss_2' => json_decode($obstetri->imunisasi_doss_2, true),
            'imunisasi_doss_3' => json_decode($obstetri->imunisasi_doss_3, true),
            'imunisasi_doss_4' => json_decode($obstetri->imunisasi_doss_4, true),
            'imunisasi_doss_5' => json_decode($obstetri->imunisasi_doss_5, true),
        ]) ?>;
    <?php endif; ?>
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
    // menampilkan log
    tampilkanNotifikasiVerifikasi(log);


    function displayObstetricData(obstetriData) {
        console.log('ini datanya');
        console.log(obstetriData);
        // Kosongkan tabel dulu 
        // Kosongkan tabel imunisasi
        const immunizationTable = $('#dataPreviewTableImunisasi');
        immunizationTable.empty();

        // Loop imunisasi dosis 1 sampai 5
        for (let i = 1; i <= 5; i++) {
            const doseKey = `imunisasi_doss_${i}`;
            const doseData = obstetriData[doseKey]; // langsung ambil, tanpa JSON.parse

            if (doseData && doseData.tanggal) {
                const formattedDate = new Date(doseData.tanggal).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });

                immunizationTable.append(`
                <tr>
                    <td>Dosis ${i}</td>
                    <td>${formattedDate}</td>
                    <td>${doseData.no_batch || '-'}</td>
                    <td>${doseData.nama_vaksin || '-'}</td>
                </tr>
            `);
            }
        }

        // Kalau tidak ada data sama sekali
        if (immunizationTable.children().length === 0) {
            immunizationTable.append(`
            <tr>
                <td colspan="4" class="text-center">Tidak ada data imunisasi</td>
            </tr>
        `);
        }
    }

    // Assuming you have the obstetri data in a variable called 'obstetri'
    if(dataImunisasiStatus){
        displayObstetricData(dataImunisasiStatus);
    }else{
         const immunizationTableChek = $('#dataPreviewTableImunisasi');
          immunizationTableChek.append(`
            <tr>
                <td colspan="4" class="text-center">Tidak ada data imunisasi</td>
            </tr>
        `);
    }
    


    function showDataSelection() {
        const dataSelectionList = $('#dataSelectionList');
        dataSelectionList.empty();
        
        // Daftar semua data yang mungkin ada di localStorage
        const dataOptions = [
            { key: 'kunjunganData', label: 'Data Kunjungan' },
            { key: 'pemantauanData', label: 'Data Pemantauan' },
            { key: 'pemeriksaanIbu', label: 'Pemeriksaan Ibu' },
            { key: 'pemeriksaanFisikIbu', label: 'Pemeriksaan Fisik Ibu' },
            { key: 'pemeriksaanUsg', label: 'Pemeriksaan USG' },
            { key: 'form1', label: 'Pemeriksaan Janin' },
            { key: 'pemeriksaan10T', label: 'Pemeriksaan 10T' }
        ];
        
        // Tambahkan checkbox untuk setiap opsi data
        dataOptions.forEach(option => {
            if (localStorage.getItem(option.key)) {
                dataSelectionList.append(`
                    <div class="form-check">
                        <input class="form-check-input data-checkbox" type="checkbox" 
                               id="check_${option.key}" value="${option.key}" checked>
                        <label class="form-check-label" for="check_${option.key}">
                            ${option.label}
                        </label>
                    </div>
                `);
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
    $('#simpanPelayananButton').click(function() {
    // Set pesan modal untuk Simpan Pelayanan
        
        $('#modalBodyMessage').text('Apakah data Anda sudah benar? Data ini akan disimpan ke sistem.');
        if(obsteri == null){
            $('#confirmActionButton').prop('disabled', true);
            // Tampilkan alert diagnosa belum ada
            $('#obsteriNotFound').show();
             $('#goToObstetri').off('click').on('click', function () {
                    $('#confirmationModal').modal('hide');
                    // Hide notif diagnosa
                    $('#obsteriNotFound').hide();
                    // Hapus modal backdrop
                    $('.modal-backdrop').remove();
                    // Hapus class modal-open di body
                    $('body').removeClass('modal-open');
                $('a.nav-link-sub[data-target="ANC/obstetri"]').trigger('click');
            });
         }
         berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
         if(!berhasilSimpanDiagnosa){
             // Disable tombol konfirmasi
            $('#confirmActionButton').prop('disabled', true);
            // Tampilkan alert diagnosa belum ada
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
                $('a.nav-link-sub[data-target="ANC/assessment"]').trigger('click');
            });
         }
        // Sembunyikan pilihan data
        $('#dataSelectionContainer').hide();

        // Set aksi yang sedang diproses
        currentAction = 'simpan';

        // Tampilkan modal
        $('#confirmationModal').modal('show');
    });

    $('#kirimSatuSehatButton').click(function() {
        // Set pesan modal untuk Kirim Satu Sehat
        $('#modalBodyMessage').html(`
            <img src="https://play-lh.googleusercontent.com/iQQGOpfKhE2trpcIVJVux1ClJpyo5JFs4uWCIwnDw0uHc44KZMkEPvDNQLuaR7k0Ww" alt="Peringatan" style="width: 40px; height: 40px; display: block;">
            <p style="text-left: right;">Apakah data Anda sudah benar? Data ini akan disimpan ke Satu Sehat.</p>
        `);

         if(obsteri == null){
            $('#confirmActionButton').prop('disabled', true);
            // Tampilkan alert diagnosa belum ada
            $('#obsteriNotFound').show();
             $('#goToObstetri').off('click').on('click', function () {
                    $('#confirmationModal').modal('hide');
                    // Hide notif diagnosa
                    $('#obsteriNotFound').hide();
                    // Hapus modal backdrop
                    $('.modal-backdrop').remove();
                    // Hapus class modal-open di body
                    $('body').removeClass('modal-open');
                $('a.nav-link-sub[data-target="ANC/obstetri"]').trigger('click');
            });
         }
         berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
         if(!berhasilSimpanDiagnosa){
             // Disable tombol konfirmasi
            $('#confirmActionButton').prop('disabled', true);
            // Tampilkan alert diagnosa belum ada
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
                $('a.nav-link-sub[data-target="ANC/assessment"]').trigger('click');
            });
         }
        // Tampilkan pilihan data
        $('#dataSelectionContainer').show();

        // Set aksi yang sedang diproses
        currentAction = 'kirim';

        // Optional: jika ingin generate daftar checkbox dinamis, panggil fungsi di sini
        showDataSelection();

        // Tampilkan modal
        $('#confirmationModal').modal('show');
    });


    function simpanDiagnosaKeLocalStorage() {
        const table = document.getElementById("list_diagnosa");
        const rows = table.querySelectorAll("tbody tr");

        if (rows.length === 0) {
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

    $('#confirmActionButton').click(function () {
        if(obsteri == null){
            swal('Obstetri Tidak ada!','tambahkan data obsteri','error');
            return;
        }
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
            
            if (!berhasilSimpanDiagnosa) {
                cooldownActive = false; // Batalkan cooldown kalau gagal
                 swal("Tidak ada data diagnosa!", "Silakan tambahkan diagnosa sebelum mengirim data.", "warning");
                return;
            }
            if (localStorage.getItem('kunjunganData')) {
                allData.kunjunganData = JSON.parse(localStorage.getItem('kunjunganData'));
            }
            if (localStorage.getItem('pemantauanData')) {
                allData.pemantauanData = JSON.parse(localStorage.getItem('pemantauanData'));
            }
            if (localStorage.getItem('pemeriksaanIbu')) {
                allData.pemeriksaanIbu = JSON.parse(localStorage.getItem('pemeriksaanIbu'));
            }
            if (localStorage.getItem('pemeriksaanFisikIbu')) {
                allData.pemeriksaanFisikIbu = JSON.parse(localStorage.getItem('pemeriksaanFisikIbu'));
            }
            if (localStorage.getItem('pemeriksaanUsg')) {
                allData.pemeriksaanUsg = JSON.parse(localStorage.getItem('pemeriksaanUsg'));
            }
            if (localStorage.getItem('form1')) {
                allData.form1 = JSON.parse(localStorage.getItem('form1'));
            }
            if (localStorage.getItem('pemeriksaan10T')) {
                allData.pemeriksaan10T = JSON.parse(localStorage.getItem('pemeriksaan10T'));
            }
            if (typeof obsteri !== 'undefined') {
                allData.obsteri = obsteri;
            }

            $.ajax({
                url: '<?= base_url('/simpus/ANC/setStore') ?>',
                type: 'POST',
                data: allData,
                dataType: 'json',
                success: function (response) {
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
                            <p style="text-left: right;">Apakah data Anda sudah benar? Data ini akan disimpan ke Satu Sehat.</p>
                        `);

                        // Tampilkan pilihan data
                        $('#dataSelectionContainer').show();

                        // Set aksi yang sedang diproses
                        currentAction = 'kirim';

                        // Optional: jika ingin generate daftar checkbox dinamis, panggil fungsi di sini
                        showDataSelection();

                        // Tampilkan modal
                        $('#confirmationModal').modal('show');
                    }, 2000);
                },
                error: function (xhr) {
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
             if(obsteri == null){
                swal('Obstetri Tidak ada!','tambahkan data obsteri','error');
                return;
            }
             berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
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

            if ($('#checkObstetriData').is(':checked') && obsteri) {
                allData.obsteri = obsteri;
            }

            $.ajax({
                url: '<?= site_url('satuSehatBridge/ANCBriging/sendObsetri') ?>',
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


    if (localStorage.getItem('kunjunganData')) {
        const data = JSON.parse(localStorage.getItem('kunjunganData'));
        $('#tanggal_kunjungan').html((data.tanggal_kunjungan.value) ?? 'tidak diisi');
        $('#usia_kehamilan').html((data.usia_kehamilan.value) ?? 'tidak diisi');
        $('#trimester').html((data.trimester.value) ?? 'tidak diisi');
    } else {
        $('#layanan_kunjungan').html('Layanan Tidak Diisi oleh Nakes');
    }

    if (localStorage.getItem('pemantauanData')) {
        // Ambil data dari localStorage
        const savedData = JSON.parse(localStorage.getItem('pemantauanData'));
        console.log(savedData);

        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Terlalu muda usia melahirkan dibawah 20 tahun',
                key: 'terlalu_mudah'
            },
            {
                label: 'Terlalu rapat jarak kelahiran ( < 2 tahun )',
                key: 'terlalu_rapat'
            },
            {
                label: 'Terlalu tua ( kehamilan di atas 35 tahun)',
                key: 'terlalu_tua'
            },
            {
                label: 'Terlalu sering melahirkan ( anak > 3)',
                key: 'sering_melahirkan'
            },
            {
                label: 'Code Komplikasi',
                key: 'kdDiagnosa'
            },
            {
                label: 'Komplikasi',
                key: 'nmDiagnosa'
            },
            {
                label: 'Deskripsi Komplikasi',
                key: 'komplikasi'
            },
            {
                label: 'code Riwayat Penyakit Menular',
                key: 'codePribadi'
            },
            {
                label: 'Nama Penyakit',
                key: 'valueSetPribadi'
            },
            {
                label: 'Sumber Riwayat Penyakit Menular',
                key: 'sumber_penyakit_menular'
            },
            {
                label: 'Deskripsi',
                key: 'deskripsi_penyakit_menular'
            },
            {
                label: 'code Riwayat Penyakit Keluarga',
                key: 'codeKeluarga'
            },
            {
                label: 'Nama Penyakit',
                key: 'valueSetKeluarga'
            },
            {
                label: 'Sumber Riwayat Penyakit Keluarga',
                key: 'sumber_penyakit_keluarga'
            },
            {
                label: 'Deskripsi',
                key: 'deskripsi_penyakit_keluarga'
            },
            {
                label: 'Status Merokok',
                key: 'status_merokok'
            },
            {
                label: 'Deskripsi',
                key: 'deskripsi_merokok'
            },
            {
                label: 'Apakah Disabilitas',
                key: 'status_disabilitas'
            },
            {
                label: 'Deskripsi',
                key: 'deskripsi_disabilitas'
            },
            {
                label: 'Apakah Mengikuti Kelas Ibu Hamil',
                key: 'kelas_ibu_hamil'
            },
            {
                label: 'Deskripsi',
                key: 'deskripsi_kelas_ibu_hamil'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('dataPreviewTableObsetri');
        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';
        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {
            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            valueCell.textContent = (savedData[mapping.key])?.value ||
                "Tidak Diisi"; // Jika null, tampilkan "Optional"

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

    if (localStorage.getItem('pemeriksaanIbu')) {
        // Ambil data dari localStorage
        const savedData = JSON.parse(localStorage.getItem('pemeriksaanIbu'));
        console.log(savedData);
        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Berat Badan',
                key: 'beratBadan'
            },
            {
                label: 'Lingkar Lengan',
                key: 'lingkarLengan'
            },
            {
                label: 'Status Lingkar Lengan',
                key: 'statusLingkarLengan'
            },
            {
                label: 'Deskripsi Lingkar Lengan',
                key: 'deskripsiLingkarLengan'
            },
            {
                label: 'Tinggi Fundus',
                key: 'tinggiFundus'
            },
            {
                label: 'Sistolik',
                key: 'sistolik'
            },
            {
                label: 'Diastolik',
                key: 'diastolik'
            },
            {
                label: 'Nadi',
                key: 'nadi'
            },
            {
                label: 'Suhu',
                key: 'suhu'
            },
            {
                label: 'Pernapasan',
                key: 'pernapasan'
            },
            {
                label: 'Golongan Darah',
                key: 'golonganDarah'
            },
            {
                label: 'Rhesus',
                key: 'rhesus'
            },
            {
                label: 'Jika LILA < 23,5, Apakah mendapatkan MT',
                key: 'mtlilastatus'
            },
            {
                label: 'MT Deskripsi',
                key: 'mtDeskripsi'
            },
            {
                label: 'Jenis MT',
                key: 'jenisMT'
            },
            {
                label: 'Mendapatkan MT (Makanan Tambahan)',
                key: 'mtconf'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('pemeriksaanIbuTable');

        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';

        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {

            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            // Jika nilai adalah boolean (misalnya checkbox), tampilkan "Ya" atau "Tidak"
            const boolean = (savedData[mapping.key])?.value ?? false;
            if (boolean === 'true' || boolean === 'false') {
                valueCell.textContent = (savedData[mapping.key])?.value === 'true' ? 'Ya' : 'Tidak';
            } else {
                valueCell.textContent = (savedData[mapping.key])?.value ||
                    "tidak Diisi"; // Jika null, tampilkan "Tidak Diisi"
            }

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

    if (localStorage.getItem('pemeriksaanFisikIbu')) {
        // Ambil data dari localStorage
        const savedDataFisik = JSON.parse(localStorage.getItem('pemeriksaanFisikIbu'));
        console.log(savedDataFisik);
        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Konjungtiva',
                key: 'konjungtiva'
            },
            {
                label: 'Deskripsi Konjungtiva',
                key: 'deskripsiKonjungtiva'
            },
            {
                label: 'Sklera',
                key: 'sklera'
            },
            {
                label: 'Deskripsi Sklera',
                key: 'deskripsiSklera'
            },
            {
                label: 'Leher',
                key: 'leher'
            },
            {
                label: 'Deskripsi Leher',
                key: 'deskripsiLeher'
            },
            {
                label: 'Gigi Mulut',
                key: 'gigiMulut'
            },
            {
                label: 'Deskripsi Gigi Mulut',
                key: 'deskripsiGigiMulut'
            },
            {
                label: 'Tungkai',
                key: 'tungkai'
            },
            {
                label: 'Deskripsi Tungkai',
                key: 'deskripsiTungkai'
            },
            {
                label: 'THT',
                key: 'tht'
            },
            {
                label: 'Deskripsi THT',
                key: 'deskripsiTHT'
            },
            {
                label: 'Dada Jantung',
                key: 'dadaJantung'
            },
            {
                label: 'Deskripsi Dada Jantung',
                key: 'deskripsiDadaJantung'
            },
            {
                label: 'Dada Paru',
                key: 'dadaParu'
            },
            {
                label: 'Deskripsi Dada Paru',
                key: 'deskripsiDadaParu'
            },
            {
                label: 'Perut',
                key: 'perut'
            },
            {
                label: 'Deskripsi Perut',
                key: 'deskripsiPerut'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('pemeriksaanFisikIbuTable');

        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';

        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {
            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            valueCell.textContent = (savedDataFisik[mapping.key])?.value ||
                "Tidak Diisi"; // Jika null, tampilkan "Optional"

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

    if (localStorage.getItem('pemeriksaanUsg')) {
        // Ambil data dari localStorage
        const savedDataUsg = JSON.parse(localStorage.getItem('pemeriksaanUsg'));
        console.log('ini data usg');
        console.log(savedDataUsg);

        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Trimester',
                key: 'trimester'
            },
            {
                label: 'GS Diameter',
                key: 'gsDiameter'
            },
            {
                label: 'CRL',
                key: 'crl'
            },
            {
                label: 'DJJ',
                key: 'djj'
            },
            {
                label: 'Usia Kehamilan',
                key: 'usiaKehamilan'
            },
            {
                label: 'Perkiraan Lahir',
                key: 'perkiraanLahir'
            },
            {
                label: 'Letak Janin',
                key: 'letakJanin'
            },
            {
                label: 'Taksiran Persalinan',
                key: 'taksiranPersalinan'
            },
            {
                label: 'BPD',
                key: 'bpd'
            },
            {
                label: 'HC',
                key: 'hc'
            },
            {
                label: 'AC',
                key: 'ac'
            },
            {
                label: 'FL',
                key: 'fl'
            },
            {
                label: 'Berat Janin',
                key: 'beratJanin'
            },
            {
                label: 'Status Janin',
                key: 'statusJanin'
            },
            {
                label: 'Deskripsi Janin',
                key: 'deskripsiJanin'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('pemeriksaanUsgTable');

        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';

        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {
            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            valueCell.textContent = savedDataUsg[mapping.key]?.value ||
                "Tidak Diisi"; // Jika null, tampilkan "Optional"

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

    if (localStorage.getItem('form1')) {
        // Ambil data dari localStorage
        const savedData = JSON.parse(localStorage.getItem('form1'));

        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Denyut Jantung Janin',
                key: 'denyutJantungJanin'
            },
            {
                label: 'Kendala PAP',
                key: 'kendalaPAP'
            },
            {
                label: 'Deskripsi Kendala PAP',
                key: 'deskripsiKendalaPAP'
            },
            {
                label: 'Taksiran Berat Janin',
                key: 'taksiranBeratJanin'
            },
            {
                label: 'Presentasi',
                key: 'presentasi'
            },
            {
                label: 'Deskripsi Presentasi',
                key: 'deskripsiPresentasi'
            },
            {
                label: 'Abdominal Circumference',
                key: 'abdominalCircumference'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('form1Table');

        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';

        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {
            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            valueCell.textContent = (savedData[mapping.key])?.value ||
                "Tidak Diisi"; // Jika null, tampilkan "Optional"

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

    if (localStorage.getItem('pemeriksaan10T')) {
        // Ambil data dari localStorage
        const savedData10T = JSON.parse(localStorage.getItem('pemeriksaan10T'));

        // Array objek yang memetakan label dan kunci data
        const dataMappings = [{
                label: 'Hemoglobin',
                key: 'hemoglobin'
            },
            {
                label: 'HIV Test',
                key: 'hivTest'
            },
            {
                label: 'Deskripsi HIV Test',
                key: 'deskripsiHIVTest'
            },
            {
                label: 'Syphilis Test',
                key: 'syphilisTest'
            },
            {
                label: 'Deskripsi Syphilis Test',
                key: 'deskripsiSyphilisTest'
            },
            {
                label: 'Hepatitis B Test',
                key: 'hepatitisBTest'
            },
            {
                label: 'Deskripsi Hepatitis B Test',
                key: 'deskripsiHepatitisBTest'
            },
            {
                label: 'Gula Darah',
                key: 'gulaDarah'
            },
            {
                label: 'Protein Urin',
                key: 'proteinUrin'
            }
        ];

        // Dapatkan elemen tbody
        const tbody = document.getElementById('pemeriksaan10TTable');

        // Kosongkan tbody sebelum menambahkan data baru
        tbody.innerHTML = '';

        // Menggunakan perulangan untuk membuat baris tabel
        dataMappings.forEach(mapping => {
            // Buat elemen <tr>
            const row = document.createElement('tr');

            // Buat elemen <td> untuk label
            const labelCell = document.createElement('td');
            labelCell.textContent = mapping.label;

            // Buat elemen <td> untuk nilai
            const valueCell = document.createElement('td');
            valueCell.textContent = (savedData10T[mapping.key])?.value ||
                "Tidak Diisi"; // Jika null, tampilkan "Optional"

            // Tambahkan sel ke baris
            row.appendChild(labelCell);
            row.appendChild(valueCell);

            // Tambahkan baris ke tbody
            tbody.appendChild(row);
        });
    }

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
})
</script>