<!DOCTYPE html>
<html lang="en">

<head>


    <style>
    .form-container {
        display: none;
    }

    .active-form {
        background-color: #5bc0de !important;
        color: white !important;
    }

    /* Custom styles for the navbar */
    .navbar-custom {
        background-color: #004d00;
        /* Dark green background */
    }

    .navbar-custom .navbar-nav>li>a {
        color: white;
        /* White text */
    }

    .navbar-custom .navbar-nav>li>a:hover,
    .navbar-custom .navbar-nav>li>a:focus,
    .navbar-custom .navbar-nav>li.active>a {
        background-color: #66ff66;
        /* Light green background on hover/click */
        color: white;
        /* White text on hover/click */
    }

    .navbar-custom .btn-primary {
        background-color: #00509E;
        /* Light blue for button */
        border-color: #004080;
        /* Darker blue border */
    }

    .lds-ring {
        /* change color here */
        color: #1c4c5b
    }

    .lds-ring,
    .lds-ring div {
        box-sizing: border-box;
    }

    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid currentColor;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: currentColor transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body>
    <div class="mt-4 mb-4">
        <div class="row">
            <div class="col-lg-10">
                <h4 id="title_page">Pelayanan Antenatal Care / Pelayanan Ibu Hamil
                </h4>
            </div>
            <div class="col-lg-2">
                <button type="button" data-target="#akhiriANC" class="btn btn-block btn-danger btn-sm">
                    Akhiri ANC
                </button>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-custom navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- Tombol hamburger muncul otomatis saat layar kecil -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-sub-layanan-wrapper" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="background-color: #fff;"></span>
        <span class="icon-bar" style="background-color: #fff;"></span>
        <span class="icon-bar" style="background-color: #fff;"></span>
        </button>
        
      </div>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbar-sub-layanan-wrapper">
        <ul id="navbar-sub-layanan" class="nav navbar-nav">
         
        </ul>
      </div>
    </div>
  </nav>


    <div id="overlay" class="overlay text-center">
        <div class="table" style="width: 100%; height: 100%;">
            <div class="table-cell" style="vertical-align: middle;">
                <div class="lds-ring center-block">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <div id="form-container" class="mt-4">
        <!-- Forms will be loaded here -->
    </div>

    <div id="notify" style="display: none;">
        <?php $this->load->view('notify/500') ?>
    </div>

    <!-- Modal untuk konfirmasi -->
    <div id="akhiriModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengakhiri pelayanan ANC?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmAkhiri">Ya, Akhiri</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var base_url = "<?php echo base_url(); ?>";
        var pasienId = "<?= $pasien_id ? $pasien_id : null ?>";
        var menus = <?php echo !empty($menus) ?  json_encode($menus) : '[]' ?>;
        //synchronize logic front
        //get data from backend

        const kunjungan = <?= json_encode($kunjungan); ?>;
        const pemantauan = <?= json_encode($pemantauan); ?>;
        const ibu = <?= json_encode($ibu); ?>;
        const fisik_ibu = <?= json_encode($fisik_ibu); ?>;
        const usg = <?= json_encode($usg); ?>;
        const janin = <?= json_encode($janin); ?>;
        const pemeriksaan_10t = <?= json_encode($pemeriksaan_10t); ?>;
        const obstetri =  <?= json_encode($obstetri); ?>;

        //get data last data form localstorage
        const storeKunjungan = JSON.parse(localStorage.getItem('kunjunganData'));
        const storePemantauan = JSON.parse(localStorage.getItem('pemantauanData'));
        const storeIbu = JSON.parse(localStorage.getItem('pemeriksaanIbu'));
        const storeFisikIbu = JSON.parse(localStorage.getItem('pemeriksaanFisikIbu'));
        const storeUsg = JSON.parse(localStorage.getItem('pemeriksaanUsg'));
        const storeJanin = JSON.parse(localStorage.getItem('form1'));
        const store10t = JSON.parse(localStorage.getItem('pemeriksaan10T'));
        


        //excution
        synchronizeData(storeKunjungan, kunjungan, 'kunjunganData');
        synchronizeData(storePemantauan, pemantauan, 'pemantauanData');
        synchronizeData(storeIbu, ibu, 'pemeriksaanIbu');
        synchronizeData(storeFisikIbu, fisik_ibu, 'pemeriksaanFisikIbu');
        synchronizeData(storeUsg, usg, 'pemeriksaanUsg');
        synchronizeData(storeJanin, janin, 'form1');
        synchronizeData(store10t, pemeriksaan_10t, 'pemeriksaan10T');
        setObsetri(obstetri,'obstetriData');

        console.log('ini storage nya yang sudah jadi');
        let storeKunjungan1 = JSON.parse(localStorage.getItem('pemeriksaanUsg'));
        console.log(storeKunjungan1);

        // do synchtonized proccess function
        function synchronizeData(storeData, newData, nameLocalStorage) {
            let updatedData;

            if (newData.length === 0) {
                //remove all localStorage
                localStorage.removeItem(nameLocalStorage);
                return false;
            }


            if (storeData === undefined || storeData === null || Object.keys(storeData).length === 0) {
                updatedData = {};

                newData.forEach(item => {
                    const key = item.atribut;
                    const value = JSON.parse(item.jawaban).value;
                    updatedData[key] = {
                        value: value, // Simpan nilai
                        id: item.id ?? null // Tambahkan id
                    };
                })
            } else {
                updatedData = {
                    ...storeData
                };
                // Loop melalui data baru
                newData.forEach(item => {
                    const key = item
                        .atribut; // Misalnya, 'usia_kehamilan', 'trimester', 'tanggal_kunjungan'
                    const value = JSON.parse(item.jawaban).value; // Ambil nilai dari jawaban

                    // Update data jika atribut ada di data baru
                    if (updatedData.hasOwnProperty(key)) {
                        updatedData[key] = {
                            value: value, // Update nilai
                            id: item.id // Tambahkan atau update id
                        };
                    } else {
                        // Jika atribut belum ada, tambahkan ke updatedData
                        updatedData[key] = {
                            value: value,
                            id: item.id
                        };
                    }
                });
            }

            localStorage.setItem(nameLocalStorage, JSON.stringify(updatedData));
            return true;
        }

        function setObsetri(obstetri, nameLocalStorage){
            localStorage.setItem(nameLocalStorage, JSON.stringify(obstetri));
        }


        if (Array.isArray(menus) && menus.length > 0 && pasienId != null) {
            function buildNavbar() {
                const order = ['obstetri','subjektif', 'objektif',  'assessment', 'imunisasi', 'planning',
                    'status_pasiens'];
                $('#overlay').hide();
                // Mengosongkan daftar navbar
                $('#navbar-sub-layanan').empty();
                // Mengurutkan dan membangun navbar
                order.forEach((target, index) => {
                    const item = menus.find(menu => menu.nama.toLowerCase() === target);

                    if (item) {
                        const capitalizedText = item.nama.charAt(0).toUpperCase() + item.nama.slice(1)
                            .replace('_', ' ');

                        // Menambahkan kelas 'active' jika ini adalah item pertama
                        const isActive = (index === 0) ? 'active-form' :
                            ''; // Menandai item pertama sebagai aktif
                            $('#navbar-sub-layanan').append(`
                                <li>
                                    <a href="#" class="nav-link-sub ${isActive}" data-target="ANC/${target}">${capitalizedText}</a>
                                </li>
                            `);
                    }
                });

                // Menambahkan tombol Kirim Satu Sehat di akhir

                $('#navbar-sub-layanan').append(`
                    <li>
                        <a href="#" data-target="ANC/priview">
                            <button type="button" class="btn btn-success">
                                Kirim Satu Sehat
                            </button>
                        </a>
                    </li>
                `);
            }

            buildNavbar();


            function loadForm(target) {
                $('#form-container').empty();
                $('#overlay').show();

                $('#form-container').load('<?= base_url("simpus/KIASubNavigation/load_form/") ?>' + target,
                    function(response, status, xhr) {
                        $('#overlay').hide();
                        if (status == "error") {
                            $('#form-container').hide();
                            $('#notify').show();
                        } else {
                            $('.form-container').hide();
                            $('.form-container').first().show();
                        }
                    });
            }

            $('.navbar-nav a').click(function(e) {
                e.preventDefault();
                
                const $clickedItem = $(this);
                const target = $clickedItem.data('target');
                
                if (!target) {
                    console.error("Target is undefined for this link.");
                    $('#overlay').hide();
                    return;
                }

                // Handle khusus untuk preview
               
                
                // Load form dan update UI
                loadForm(target);


                
                // Update active state
                $('.navbar-nav a').removeClass('active-form');
                $(this).addClass('active-form');
            });

            let activeElement = $('.navbar-nav a.active-form');
            if (activeElement.length > 0) {
                let activeTarget = activeElement.data('target');
                console.log(activeTarget);
                loadForm(activeTarget);
            } else {
                console.warn("No active button found. Loading the first button as fallback.");
                let firstTarget = $('.navbar-nav a').first().data('target');
                loadForm(firstTarget);
                $('.navbar-nav a').first().addClass('active-form');
            }



            // button untuk model
            $('button[data-target="#akhiriANC"]').click(function() {
                $('#akhiriModal').modal('show'); // Tampilkan modal
            });


        } else {
            $('#overlay').hide();
            $('#layanan-point').hide();
            $('#notify').show();
        }


        // Event untuk tombol "Ya, Akhiri" di dalam modal
        $('#confirmAkhiri').click(function() {
            const pelayanan = 'ANC'; // Mengakhiri ANC berarti mengubah pelayanan menjadi null

            // Panggil fungsi AJAX untuk update pelayanan
            updatePelayanan(pasienId, pelayanan);

            // Tutup modal setelah konfirmasi
            $('#akhiriModal').modal('hide');
        });

        function updatePelayanan(pasienId, pelayanan) {
            $.ajax({
                url: base_url + "simpus/KIA_Navigation/akhiriPelayanan",
                type: 'POST',
                data: {
                    pasien_id: pasienId,
                    pelayanan: pelayanan
                },
                success: function() {
                    location.reload(); // Kosongkan atau tutup tampilan
                },
                error: function() {
                    alert('Gagal memperbarui status pelayanan.');
                }
            });
        };
    });
    </script>
</body>

</html>