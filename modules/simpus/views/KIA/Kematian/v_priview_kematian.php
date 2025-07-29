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
    <h2>Resumen Medis Laporan Kematian</h2>
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
                        <a class="nav-link active" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Laporan Kematian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings"
                            aria-selected="false">Assesment</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade in active" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        <div class="mt-2">
                            <h4>Laporan Kematian Ibu</h4>
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
                            <h4>Laporan Kematian Bayi Lahir Mati</h4>
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
                                        <tbody id="laporanKematianLahirMati">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">

                                </div>

                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Laporan Kematian Bayi Lahir Hidup </h4>
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
                                        <tbody id="laporanBayiLahirHidup">

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
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-bold" id="confirmationModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger text-bold" aria-hidden="true">&times;</span>
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
    $(document).ready(function() {

        let currentAction = null; // Menyimpan aksi yang sedang diproses
        // Event listener untuk tombol "Simpan Pelayanan"
        var berhasilSimpanDiagnosa;
         var log = <?= json_encode(isset($log) ? $log : [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
         console.log('ini log:');
         console.log(log);
    
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
    
    function showDataSelection() {
        const dataSelectionList = $('#dataSelectionList');
        dataSelectionList.empty();
        
        // Daftar semua data yang mungkin ada di localStorage
        const dataOptions = [
            { key: 'KematianIbu', label: 'Laporan Kematian Ibu' },
            { key: 'dataLahirMati', label: 'Laporan Kematian Bayi Lahir Mati' },
            { key: 'dataLahirHidup', label: 'Laporan Kematian Bayi Lahir Hidup ' },
        ];
        
        // Tambahkan checkbox untuk setiap opsi data
        dataOptions.forEach(option => {
            const dataValue = localStorage.getItem(option.key);
            const parsed = JSON.parse(dataValue);
            if (parsed && typeof parsed === 'object' && Object.keys(parsed).length > 0) {
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


        $('#simpanPelayananButton').click(function() {
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
                            $('a[data-target="Kematian/assessment"]').trigger('click');
                        });
                }
            // Sembunyikan bagian pilihan data
            $('#dataSelectionContainer').hide();

            // Simpan aksi
            currentAction = 'simpan';

            // Tampilkan modal terakhir setelah semua siap
            $('#confirmationModal').modal('show');
        });
        // Event listener untuk tombol "Kirim Satu Sehat"
        $('#kirimSatuSehatButton').click(function() {
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
                            $('a[data-target="Kematian/assessment"]').trigger('click');
                        });
                }
            // Simpan aksi
            currentAction = 'kirim';

            // Tampilkan modal dulu, lalu tampilkan container-nya setelah modal benar-benar terbuka
            $('#confirmationModal').modal('show');

            // Gunakan event Bootstrap untuk menunggu sampai modal benar-benar ditampilkan
            $('#confirmationModal').one('shown.bs.modal', function () {
                $('#dataSelectionContainer').show(); // baru ditampilkan saat modal terbuka
                showDataSelection();
            });
        });
        // melakukan parse data untuk data local dan valid

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

        // Event listener untuk tombol konfirmasi di modal
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
                console.log('berhasil'+ berhasilSimpanDiagnosa);
                    if (!berhasilSimpanDiagnosa) {
                        cooldownActive = false; // Batalkan cooldown kalau gagal
                        return;
                }

                allData.dataLahirHidup = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                    'dataLahirHidup')));
                allData.dataLahirMati = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                    'dataLahirMati')));
                allData.KematianIbu = checkLocalStoreHelper(JSON.parse(localStorage.getItem(
                    'KematianIbu')));

                $.ajax({
                    url: '<?= base_url('/simpus/Kematian_Store/setStore') ?>', // Ganti dengan URL endpoint API Anda
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
                 berhasilSimpanDiagnosa = simpanDiagnosaKeLocalStorage();
                    if (!berhasilSimpanDiagnosa) {
                        cooldownActive = false; // Batalkan cooldown kalau gagal
                        return;
                    }

                    const checkedKeys = [];
                    $('.data-checkbox:checked').not('#checkAllData').each(function () {
                        const dataKey = $(this).val();
                            checkedKeys.push(dataKey); // simpan key-nya untuk dikirim nanti

                            if (localStorage.getItem(dataKey)) {
                                allData[dataKey] = JSON.parse(localStorage.getItem(dataKey)); // ambil datanya
                            }

                    });

                    if (checkedKeys.length === 0) {
                        cooldownActive = false;
                        swal("Data Belum Dipilih", "Pilih minimal satu data untuk dikirim.", "error");
                        return;
                    }

                    const endpointMap = {
                        KematianIbu: '<?= site_url('satuSehatBridge/KematianBriging/sendSatuSehatBundleLaporanKematianIbu') ?>',
                        dataLahirMati: '<?= site_url('satuSehatBridge/KematianBriging/sendSatuSehatBundleLaporanBayiLahirMati') ?>',
                        dataLahirHidup: '<?= site_url('satuSehatBridge/KematianBriging/sendSatuSehatBundleLaporanBayiLahirHidup') ?>'
                    };

                    if (localStorage.getItem('diagnosaList')) {
                        allData.diagnosaList = JSON.parse(localStorage.getItem('diagnosaList'));
                    } else {
                        cooldownActive = false;
                        swal("Data Diagnosa Belum Ada", "Mohon untuk memilih diagnosa terlebih dahulu.", "error");
                        return;
                    }
                    // Logika untuk mengirim data ke Satu Sehat
                    (async () => {
                        for (const key of checkedKeys) {
                            const url = endpointMap[key];
                            if (!url) {
                                await swal(`Gagal Mengirim ${key}`, "Pengiriman tidak valid.", "error");
                                continue;
                            }

                            try {
                                await $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: allData,
                                    dataType: 'json'
                                });

                                await swal("Berhasil!", `Data ${key} berhasil dikirim ke Satu Sehat.`, "success");
                            } catch (xhr) {
                                let errorMessage = "Terjadi kesalahan saat mengirim data ke Satu Sehat";

                                if (xhr.responseJSON) {
                                    const res = xhr.responseJSON;
                                    if (res.errors && typeof res.errors === 'object') {
                                        const messages = Object.values(res.errors).map(err => err.details).filter(Boolean);
                                        errorMessage = messages.join('\n');
                                    } else if (res.message) {
                                        errorMessage = res.message;
                                    }
                                }

                                await swal(`Gagal Mengirim ${key}`, errorMessage, "error");
                            }
                        }
                    })();
            }
           // Sembunyikan modal setelah aksi selesai
        });

        



        function loadLaporanKematianBayiLahirHidup() {
            try {
                const savedData = JSON.parse(localStorage.getItem('dataLahirHidup')) || {};
                const laporanBayiLahirHidup = $('#laporanBayiLahirHidup');

                if (!laporanBayiLahirHidup.length) {
                    throw new Error('Tabel tidak ditemukan');
                }

                laporanBayiLahirHidup.empty();

                // Handle empty data
                if (Object.keys(savedData).length === 0) {
                    laporanBayiLahirHidup.html(`
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        Data belum diisi oleh nakes
                    </td>
                </tr>
            `);
                    return;
                }

                // Field definitions with display names and formatters
                const fieldDefinitions = [{
                        key: 'lokasiKematian',
                        label: 'Lokasi Kematian'
                    },
                    {
                        key: 'alamatKematian',
                        label: 'Alamat Kematian'
                    },
                    {
                        key: 'jenisKematianHidup',
                        label: 'Jenis Kematian'
                    },
                    {
                        key: 'usiaSaatMeninggal',
                        label: 'Usia Saat Meninggal'
                    },
                    {
                        key: 'beratSaatMeninggal',
                        label: 'Berat Saat Meninggal'
                    },
                    {
                        key: 'panjangSaatMeninggal',
                        label: 'Panjang Saat Meninggal'
                    },
                    {
                        key: 'tanggalKematianHidup',
                        label: 'Tanggal Kematian'
                    },
                    {
                        key: 'jamKematianHidup',
                        label: 'Jam Kematian'
                    },
                    {
                        key: 'codeDugaanKematianHidup',
                        label: 'Kode Dugaan Kematian'
                    },
                    {
                        key: 'dugaanKematianHidup',
                        label: 'Dugaan Kematian'
                    },
                    {
                        key: 'detailDugaanKematianHidup',
                        label: 'Detail Dugaan Kematian'
                    },
                    {
                        key: 'codePengaruhIbuHidup',
                        label: 'Kode Pengaruh Ibu'
                    },
                    {
                        key: 'pengaruhIbuHidup',
                        label: 'Pengaruh Ibu'
                    },
                    {
                        key: 'detailPengaruhIbuHidup',
                        label: 'Detail Pengaruh Ibu'
                    },
                    {
                        key: 'jenisTempatMeninggalHidup',
                        label: 'Jenis Tempat Meninggal'
                    },
                    {
                        key: 'deskripsiLainyaHidup',
                        label: 'Deskripsi (Jika Lainnya)'
                    },
                    {
                        key: 'gravida',
                        label: 'Gravida'
                    },
                    {
                        key: 'partus',
                        label: 'Partus'
                    },
                    {
                        key: 'abortus',
                        label: 'Abortus'
                    },
                    {
                        key: 'usiaKehamilan',
                        label: 'Usia Kehamilan',
                        formatter: value => value ? `${value} Minggu` : 'Tidak ada data'
                    },
                    {
                        key: 'jumlahAnakHidup',
                        label: 'Jumlah Anak Hidup'
                    },
                    {
                        key: 'jenisKehamilan',
                        label: 'Jenis Kehamilan'
                    },
                    {
                        key: 'janinMeninggalHidupBayiKembar',
                        label: 'Janin Meninggal (Bayi Kembar)'
                    },
                    {
                        key: 'beratLahirHidup',
                        label: 'Berat Lahir'
                    },
                    {
                        key: 'lingkarKepala',
                        label: 'Lingkar Kepala'
                    },
                    {
                        key: 'codeKelainanBawaanHidup',
                        label: 'Kode Kelainan Bawaan'
                    },
                    {
                        key: 'kelainanBawaanHidup',
                        label: 'Kelainan Bawaan'
                    },
                    {
                        key: 'detailKelainanBawaanHidup',
                        label: 'Detail Kelainan Bawaan'
                    },
                    {
                        key: 'jenisTempatBersalin',
                        label: 'Jenis Tempat Bersalin'
                    },
                    {
                        key: 'deskripsiLainyaBersalin',
                        label: 'Deskripsi (Jika Lainnya Bersalin)'
                    },
                    {
                        key: 'caraPersalinanHidup',
                        label: 'Cara Persalinan'
                    }
                ];



                // Create table rows
                fieldDefinitions.forEach(({
                    key,
                    label,
                    formatter
                }) => {
                    const fieldData = savedData[key];
                    let displayValue;

                    if (fieldData === null || fieldData === undefined) {
                        displayValue = 'Tidak ada data';
                    } else if (formatter) {
                        // Apply custom formatter if exists
                        displayValue = formatter(fieldData.value || fieldData);
                    } else if (typeof fieldData === 'object' && fieldData !== null) {
                        // Get value from object
                        displayValue = fieldData.value || 'Tidak ada data';
                    } else {
                        // Primitive value
                        displayValue = fieldData;
                    }

                    const row = `
                <tr>
                    <td>${label}</td>
                    <td>${displayValue}</td>
                </tr>
            `;
                    laporanBayiLahirHidup.append(row);
                });

            } catch (error) {
                console.error('Gagal memuat laporan:', error);
                $('#laporanBayiLahirHidup').html(`
            <tr>
                <td colspan="2" class="text-center text-danger">
                    Error: ${error.message}
                </td>
            </tr>
        `);
            }
        }

        // Panggil fungsi saat halaman dimuat

        loadLaporanKematianBayiLahirHidup(); // Memuat laporan ke tabel


        function loadLaporanKematianLahirMati() {
            try {
                const savedData = JSON.parse(localStorage.getItem('dataLahirMati')) || {};
                const laporanKematianLahirMati = $('#laporanKematianLahirMati');

                if (!laporanKematianLahirMati.length) {
                    throw new Error('Tabel tidak ditemukan');
                }

                laporanKematianLahirMati.empty();

                // Handle empty data
                if (Object.keys(savedData).length === 0) {
                    laporanKematianLahirMati.html(`
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        Data belum diisi oleh nakes
                    </td>
                </tr>
            `);
                    return;
                }

                // Field definitions with display names
                const fieldDefinitions = [{
                        key: 'jenisKematian',
                        label: 'Jenis Kematian'
                    },
                    {
                        key: 'codeDugaanSebabKematianMati',
                        label: 'Kode Dugaan Sebab Kematian'
                    },
                    {
                        key: 'dugaanSebabKematianMati',
                        label: 'Dugaan Sebab Kematian'
                    },
                    {
                        key: 'detailSebabKematianMati',
                        label: 'Detail Sebab Kematian'
                    },
                    {
                        key: 'tanggalKematian',
                        label: 'Tanggal Kematian'
                    },
                    {
                        key: 'jamKematian',
                        label: 'Jam Kematian'
                    },
                    {
                        key: 'kondisiIbu',
                        label: 'Kondisi Ibu'
                    },
                    {
                        key: 'kondisiIbuDisplay',
                        label: 'Kondisi Ibu (Display)'
                    },
                    {
                        key: 'deskripsiKondisi',
                        label: 'Deskripsi Kondisi Ibu'
                    },
                    {
                        key: 'tempatMeninggal',
                        label: 'Tempat Meninggal'
                    },
                    {
                        key: 'alamatMeninggal',
                        label: 'Alamat Meninggal'
                    },
                    {
                        key: 'jenisTempatMeninggal',
                        label: 'Jenis Tempat Meninggal'
                    },
                    {
                        key: 'deskripsiLainya',
                        label: 'Deskripsi Lainnya'
                    },
                    {
                        key: 'maserasi',
                        label: 'Maserasi'
                    },
                    {
                        key: 'kelainanBawaan',
                        label: 'Kelainan Bawaan'
                    },
                    {
                        key: 'kelainanBawaanDisplay',
                        label: 'Kelainan Bawaan (Display)'
                    },
                    {
                        key: 'deskripsiKelainanBawaan',
                        label: 'Deskripsi Kelainan Bawaan'
                    },
                    {
                        key: 'beratLahir',
                        label: 'Berat Lahir'
                    },
                    {
                        key: 'janinMeninggalBayiKembar',
                        label: 'Janin Meninggal (Bayi Kembar)'
                    },
                    {
                        key: 'jenisKehamilan',
                        label: 'Jenis Kehamilan'
                    },
                    {
                        key: 'caraPersalinan',
                        label: 'Cara Persalinan'
                    },
                    {
                        key: 'usiaKehamilanLahirMati',
                        label: 'Usia Kehamilan Saat Lahir Mati'
                    },
                    {
                        key: 'anakHidup',
                        label: 'Anak Hidup'
                    },
                    {
                        key: 'umurIbu',
                        label: 'Umur Ibu'
                    },
                    {
                        key: 'lamaTinggal',
                        label: 'Lama Tinggal'
                    }
                ];

                // Create table rows
                fieldDefinitions.forEach(({
                    key,
                    label
                }) => {
                    const fieldData = savedData[key];
                    let value;

                    if (fieldData && typeof fieldData === 'object' && fieldData !== null) {
                        value = fieldData.value || 'Tidak ada data';
                    } else if (fieldData) {
                        value = fieldData;
                    } else {
                        value = 'Tidak ada data';
                    }

                    const row = `
                <tr>
                    <td>${label}</td>
                    <td>${value}</td>
                </tr>
            `;
                    laporanKematianLahirMati.append(row);
                });

            } catch (error) {
                console.error('Gagal memuat laporan:', error);
                $('#laporanKematianLahirMati').html(`
            <tr>
                <td colspan="2" class="text-center text-danger">
                    Error: ${error.message}
                </td>
            </tr>
        `);
            }
        }

        // Panggil fungsi saat halaman dimuat
        loadLaporanKematianLahirMati(); // Memuat laporan ke tabel

        function loadLaporanKematianIbu() {
            try {
                const savedData = JSON.parse(localStorage.getItem('KematianIbu')) || {};
                const pemeriksaanIbuTable = $('#pemeriksaanIbuTable');

                if (!pemeriksaanIbuTable.length) {
                    throw new Error('Tabel tidak ditemukan');
                }

                pemeriksaanIbuTable.empty();

                // Handle data kosong
                if (Object.keys(savedData).length === 0) {
                    pemeriksaanIbuTable.html(`
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        Data belum diisi oleh nakes
                    </td>
                </tr>
            `);
                    return;
                }

                // Mapping nama field ke tampilan
                const fieldDisplayMap = {
                    'tempatMeninggal': 'Tempat Meninggal',
                    'alamatKematian': 'Alamat Kematian',
                    'tanggalMeninggal': 'Tanggal Meninggal',
                    'waktuMeninggal': 'Waktu Meninggal',
                    'masaKematian': 'Masa Kematian',
                    'dugaanSebabKematian': 'Dugaan Sebab Kematian',
                    'display_sebab_kematian': 'Nama Sebab Kematian',
                    'dugaan_detail_ibu': 'Deskripsi Sebab Kematian',
                    'jenisTempatMeninggal': 'Jenis Tempat Meninggal',
                    'deskripsiLainya': 'Deskripsi Lainnya',
                    'gravida': 'Gravida',
                    'partus': 'Partus',
                    'abortus': 'Abortus',
                    'usiaKehamilan': 'Usia Kehamilan',
                    'periodeNifas': 'Periode Nifas',
                    'year': 'Tahun'

                };

                // Buat baris tabel
                Object.entries(fieldDisplayMap).forEach(([fieldName, displayName]) => {
                    const fieldValue = savedData[fieldName]?.value || 'Tidak ada data';

                    const row = `
                <tr>
                    <td>${displayName}</td>
                    <td>${fieldValue}</td>
                </tr>
            `;
                    pemeriksaanIbuTable.append(row);
                });

            } catch (error) {
                console.error('Gagal memuat laporan:', error);
                $('#pemeriksaanIbuTable').html(`
            <tr>
                <td colspan="2" class="text-center text-danger">
                    Error: ${error.message}
                </td>
            </tr>
        `);
            }
        }

        loadLaporanKematianIbu();
        getDataDiagnosa();

        function getDataDiagnosa() {
            var idLoket = "<?= $loket_id ?>";
            var idPelayanan = "<?= $item['idpelayanan'] ?>";
            load('simpus/pelayanan/loadDiagnosaData/' + idLoket + '/' + idPelayanan, '#loadDiagnosaData');
        }

    });


</script>