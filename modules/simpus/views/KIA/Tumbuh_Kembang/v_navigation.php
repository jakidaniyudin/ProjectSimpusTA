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
                <h4 id="title_page">Pelayanan Pertumbuhan</h4>
            </div>
            <div class="col-lg-2">
                <button type="button" data-target="#akhiriPNC" class="btn btn-block btn-danger btn-sm">
                    Akhiri Layanan
                </button>
            </div>
        </div>

    </div>

    <nav class="navbar navbar-custom navbar-static-top">
        <div class="container-fluid">
            <!-- Left navbar links -->
            <ul id="navbar-sub-layanan" class="nav navbar-nav pnc">
            </ul>
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
    <div id="akhiriPNC" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengakhiri pelayanan PNC?</p>
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

        if (Array.isArray(menus) && menus.length > 0 && pasienId != null) {


            $('#overlay').hide();

            function buildNavbar() {
                const order = ['subjektif', 'objektif', 'assessment', 'imunisasi', 'planning',
                    'status_pasiens'
                ];
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
                            <li class="hidden-xs">
                                <a href="#" class="${isActive}" data-target="Tumbuh_Kembang/${target}">${capitalizedText}</a>
                            </li>
                        `);
                    }
                });

                // Menambahkan tombol Kirim Satu Sehat di akhir
                $('#navbar-sub-layanan').append(`
                    <li class="hidden-xs">
                        <a href="#" data-target="PNC/priview">
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

                let target = $(this).data('target');
                console.log("Clicked link:", this); // Debugging untuk melihat elemen yang diklik
                console.log("Target:", target); // Debugging untuk melihat nilai target

                if (target) { // Pastikan target tidak undefined atau null
                    loadForm(target);

                    $('.navbar-nav a').removeClass('active-form');
                    $(this).addClass('active-form');
                } else {
                    console.error("Target is undefined for this link.");
                }
            });

            let activeElement = $('.pnc a.active-form');
            if (activeElement.length > 0) {
                let activeTarget = activeElement.data('target');
                console.log(activeTarget);
                loadForm(activeTarget);
            } else {
                console.warn("No active button found. Loading the first button as fallback.");
                let firstLink = $('.pnc a').first().data('target');
                loadForm(firstLink);
                $('.navbar-nav a').first().addClass('active-form');
            }



            // button untuk model
            $('button[data-target="#akhiriPNC"]').click(function() {
                $('#akhiriPNC').modal('show'); // Tampilkan modal
            });


        } else {
            $('#overlay').hide();
            $('#layanan-point').hide();
            $('#notify').show();
        }

        // Event untuk tombol "Ya, Akhiri" di dalam modal
        $('#confirmAkhiri').click(function() {
            const pelayanan = null; // Mengakhiri ANC berarti mengubah pelayanan menjadi null

            // Panggil fungsi AJAX untuk update pelayanan
            updatePelayanan(pasienId, pelayanan);

            // Tutup modal setelah konfirmasi
            $('#akhiriPNC').modal('hide');
        });

        function updatePelayanan(pasienId, pelayanan) {
            $.ajax({
                url: base_url + "simpus/KIA_Navigation/setPelayanan",
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