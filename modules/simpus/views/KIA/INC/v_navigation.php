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
                <h4 id="title_page">Pelayanan Intranatal Care / Pelayanan Ibu Bersalin</h4>
            </div>
            <div class="col-lg-2">
                <button type="button" data-target="#akhiriANC" class="btn btn-block btn-danger btn-sm">
                    Akhiri INC
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
                    <p>Apakah Anda yakin ingin mengakhiri pelayanan INC?</p>
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
        var base_url = "<?php echo base_url(); ?>"
        var pasienId = "<?= $pasien_id ? $pasien_id : null ?>";
        var menus = <?php echo !empty($menus) ?  json_encode($menus) : '[]' ?>;
        //synchronize logic front
        //get data from backend
        const persalinan = <?= json_encode($persalinan); ?>;
        console.log('data persalinan by server');
        console.log(persalinan);
        const kala1 = <?= json_encode($kala1); ?>;
        const kala2 = <?= json_encode($kala2); ?>;
        const kala3 = <?= json_encode($kala3); ?>;
        const kala4 = <?= json_encode($kala4); ?>;
        const kala4Detail = <?= json_encode($kala4Detail); ?>;
        console.log('ini data dari server untuk kala 4 detail');
        console.log(kala4Detail);


        const pelayanan_persalinan = <?= json_encode($pelayanan_persalinan); ?>;
        const apgar1 = <?= json_encode($apgar1); ?>;
        const apgar5 = <?= json_encode($apgar5); ?>;
        const apgar10 = <?= json_encode($apgar10); ?>;
        const bayi = <?= json_encode($bayi); ?>;
        const obstetri = <?= json_encode($obstetri); ?>;


        synchronizeData(persalinan, 'kunjunganPersalinan');
        synchronizeData(kala1, 'dataKala1');
        synchronizeData(kala2, 'dataKala2');
        synchronizeData(kala3, 'dataKala3');
        synchronizeData(kala4, 'dataFormBawah');
        sysnchonizeDataKala4Detail(kala4Detail, 'dataFormAtas');
        synchronizeData(bayi, 'formBayi');
        synchronizeData(pelayanan_persalinan, 'dataKeadaanIbu');
        synchronizeDataApgar(apgar1, 'apgar-1-data');
        synchronizeDataApgar(apgar5, 'apgar-5-data');
        synchronizeDataApgar(apgar10, 'apgar-10-data');
        setObsetri(obstetri,'obstetriData');


        function getLocalStorageSize() {
            let totalSize = 0;
            // Loop melalui semua item di localStorage
            for (let key in localStorage) {
                if (localStorage.hasOwnProperty(key)) {
                    // Hitung ukuran key dan value (dalam byte)
                    totalSize += key.length + localStorage.getItem(key).length;
                }
            }
            // Kembalikan ukuran dalam kilobyte (KB)
            return (totalSize / 1024).toFixed(2) + " KB";
        }

        // Contoh penggunaan
        console.log("Ukuran localStorage: " + getLocalStorageSize());
        // do synchtonized proccess function
        function synchronizeData(newData, nameLocalStorage) {
            let updatedData = {};
            if (newData.length === 0) {
                //remove all localStorage
                localStorage.removeItem(nameLocalStorage);
                localStorage.setItem(nameLocalStorage, JSON.stringify(null));
            } else {
                newData.forEach(item => {
                    const key = item.atribut;
                    const value = JSON.parse(item.jawaban).value;
                    updatedData[key] = {
                        value: value, // Simpan nilai
                        id: item.id ?? null // Tambahkan id
                    };
                })
                console.log('ini data sinkronsiasi awal');
                console.log(updatedData);
                localStorage.setItem(nameLocalStorage, JSON.stringify(updatedData));
            }

        }

        function setObsetri(obstetri, nameLocalStorage){
            if(!obstetri || obstetri.length === 0){
                swal('Data Obstetri Tidak Ditemukan', 'Sistem tidak ada record data Obsetri, Abaikan jika memang belum ada, dan pelaynan anak!!', 'error');
            }else{
                localStorage.setItem(nameLocalStorage, JSON.stringify(obstetri));
            };
            
        }

        function sysnchonizeDataKala4Detail(newData, nameLocalStorage) {
            let updatedData = {};
            if (newData.length === 0) {
                // Remove all localStorage
                localStorage.removeItem(nameLocalStorage);
                localStorage.setItem(nameLocalStorage, JSON.stringify(null));
            } else {
                newData.forEach(item => {
                    const key = item.atribut;
                    const value = JSON.parse(item.jawaban);
                    updatedData[key] = {
                        value: value,
                        id: item.id ?? null
                    };
                });
                console.log('ini data sinkronisasi awal');
                console.log(updatedData);
                localStorage.setItem(nameLocalStorage, JSON.stringify(updatedData));
            }
        }

        function synchronizeDataApgar(newData, nameLocalStorage) {
            let updatedData = {};
            console.log('hello');
            if (Object.keys(newData).length === 0) {
                //remove all localStorage

                localStorage.removeItem(nameLocalStorage);
                localStorage.setItem(nameLocalStorage, JSON.stringify(null));
            } else {
                newData.forEach(item => {
                    const jawaban = JSON.parse(item.jawaban);

                    const key = item.atribut;
                    const value = jawaban.value;
                    const text = jawaban.text;
                    const score = jawaban.score;
                    updatedData[key] = {
                        value: value,
                        text: text,
                        score: score, // Simpan nilai
                        id: item.id ?? null // Tambahkan id
                    };
                });
            }
            console.log('ini data yang sudah di sinkronisasi');
            console.log(updatedData);
            localStorage.setItem(nameLocalStorage, JSON.stringify(updatedData));
        }

        if (Array.isArray(menus) && menus.length > 0 && pasienId != null) {
            function buildNavbar() {
                const order = ['objektif', 'assessment', 'imunisasi', 'planning',
                    'status_pasiens'
                ];
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
                                <a href="#" class="${isActive}" data-target="INC/${target}">${capitalizedText}</a>
                            </li>
                        `);
                    }
                });

                // Menambahkan tombol Kirim Satu Sehat di akhir
                $('#navbar-sub-layanan').append(`
                    <li>
                        <a href="#" data-target="INC/priview">
                            <button type="button" class="btn btn-success">
                                Kirim Satu Sehat
                            </button>
                        </a>
                    </li>
                `);
            }

            buildNavbar();

            $('#overlay').hide();

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

                let target = $(this).data('target');
                console.log("Clicked link:", this); // Debugging untuk melihat elemen yang diklik
                console.log("Target:", target); // Debugging untuk melihat nilai target

                if (target) { // Pastikan target tidak undefined atau null
                    loadForm(target);

                    $('.navbar-nav a').removeClass('active-form');
                    $(this).addClass('active-form');
                } else {
                    console.error("Target is undefined for this link.");
                    $('#overlay').hide();
                }
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

            // Event untuk tombol "Ya, Akhiri" di dalam modal

        } else {
            $('#navbar-sub-layanan').html('<p>Maaf Layanan masih dalam perbaikan</p>')
        }

        $('#confirmAkhiri').click(function() {
            const pelayanan = 'INC'; // Mengakhiri ANC berarti mengubah pelayanan menjadi null

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
                    alert('terjadi error saat mengakhiri pelayanan');
                }
            });
        };

    });
    </script>

</body>