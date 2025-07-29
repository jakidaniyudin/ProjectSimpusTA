<body class="sidebar-collapse">
    <style>
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

    <section id="kia_service">
        <div class="mt-4">

            <div id="title" class="pb-2 pt-2">
                <h4 class="text-start">Pelayanan KIA</h4>
            </div>

            <div class="pull-left" id="buttonContainer">

            </div>
            <hr />
            <div id="formContainer" class="mt-4">
                <!-- Overlay untuk loading -->
                <div id="overlay" class="overlay">
                    <div class="lds-ring">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <!-- Konten dari halaman lain akan dimuat di sini -->
            </div>
        </div>
    </section>

    <!-- Modal Structure for ANC -->
    <div class="modal fade" id="ancModal" tabindex="-1" role="dialog" aria-labelledby="ancModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi ANC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan ANC?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonANC">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for INC -->
    <div class="modal fade" id="incModal" tabindex="-1" role="dialog" aria-labelledby="incModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi INC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan INC?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonINC">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for PNC -->
    <div class="modal fade" id="pncModal" tabindex="-1" role="dialog" aria-labelledby="pncModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi PNC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan PNC?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonPnc">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Neonatus -->
    <div class="modal fade" id="neonatusModal" tabindex="-1" role="dialog" aria-labelledby="neonatusModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Neonatus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan Neonatus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonNeonatus">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Kematian -->
    <div class="modal fade" id="kematianModal" tabindex="-1" role="dialog" aria-labelledby="kematianModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Kematian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan Kematian?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonKematian">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal Structure for Tumbuh_Kembang -->

     <div class="modal fade" id="tumbuh_kembangModal" tabindex="-1" role="dialog" aria-labelledby="tumbuh_kembangModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pertumbuhan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan dengan Pertumbuhan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i> Tidak
                    </button>
                    <button type="button" class="btn btn-success" id="yesButtonTumbuhKembang">
                        <i class="fas fa-check"></i> Ya
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div id="formContainer" class="mt-4">
        <!-- Konten dari halaman lain akan dimuat di sini -->
    </div>

    <script type="text/javascript">
    var actv_service = null;
    var baseurl = "<?php echo base_url(); ?>";
    const array = <?php echo json_encode($buttons); ?>;
    $(document).ready(function() {

        $('#overlay').hide();


        function formatNama(nama) {
            // Mengganti underscore dengan spasi
            nama = nama.replace(/_/g, ' ');
            return nama;
        }

        // Fungsi untuk membuat tombol
        function createButtons() {
            const buttonContainer = document.getElementById('buttonContainer');

            array.forEach(item => {
                const formattedNama = formatNama(item.nama); // Format nama
                const buttonId = formattedNama.replace(/ /g,
                    '_'); // Ganti spasi dengan underscore untuk ID
                const modalTarget = `#${item.nama.toLowerCase()}Modal`; // Target modal

                // Buat elemen tombol
                const button = document.createElement('button');
                button.type = 'button';
                button.id = buttonId;
                button.className = 'btn btn-primary';
                button.style = "margin-left:5px;";
                button.setAttribute('data-toggle', 'modal');
                button.setAttribute('data-target', modalTarget);
                button.textContent = formattedNama;

                // Tambahkan tombol ke container
                buttonContainer.appendChild(button);
            });
        }

        // Panggil fungsi untuk membuat tombol saat halaman dimuat
        createButtons();




        // Event listener for the "Yes" button in the ANC modal
        var pasienId = '<?= $pasien->ID ?>';

        checkStatus(pasienId);
        $("#yesButtonANC").click(function() {
            updatePelayanan(pasienId, "ANC");

            loadForm("ANC", pasienId);
            $("#ancModal").modal("hide");
        });

        // Event listeners for other modals (INC, Kematian, Neonatus, Tumbuh Kembang)
        $("#yesButtonINC").click(function() {
            updatePelayanan(pasienId, "INC");

            loadForm("INC", pasienId);
            $("#incModal").modal("hide");
        });

        $("#yesButtonKematian").click(function() {
            updatePelayanan(pasienId, "Kematian");

            loadForm("Kematian", pasienId);
            $("#kematianModal").modal("hide");
        });

        $("#yesButtonPnc").click(function() {
            updatePelayanan(pasienId, "PNC");

            loadForm("PNC", pasienId);
            $("#pncModal").modal("hide");
        });

        $("#yesButtonNeonatus").click(function() {
            updatePelayanan(pasienId, "Neonatus");

            loadForm("Neonatus", pasienId);
            $("#neonatusModal").modal("hide");
        });

        
         $("#yesButtonTumbuhKembang").click(function() {
            updatePelayanan(pasienId, "Tumbuh_Kembang");

            loadForm("Tumbuh_Kembang", pasienId);
            $("#tumbuh_kembangModal").modal("hide");
        });
    });

    function updatePelayanan(pasienId, pelayanan) {
        $.ajax({
            url: baseurl + "simpus/KIA_Navigation/setPelayanan",
            type: "POST",
            data: {
                pasien_id: pasienId,
                pelayanan: pelayanan,

            },
            success: function() {

                checkStatus(pasienId); // Perbarui status setelah berhasil
            },
            error: function() {

                alert("Gagal memperbarui status pelayanan.");
                $("#formContainer").html("<p>Maaf, terjadi kesalahan saat memuat form.</p>");
            }
        });
    }

    function checkStatus(pasienId) {
        $.ajax({
            url: baseurl + "simpus/KIA_Navigation/checkStatusPelayanan",
            type: "POST",
            data: {
                pasien_id: pasienId
            },
            success: function(response) {

                if (response.status == 'success') {
                    actv_service = response.data ? response.data.id : null;
                    disableButtons(response.data ? response.data.pelayananStatus : null);
                } else {
                    disableButtons(null);
                }

            },
            error: function(xhr, status, error) {
                $("#formContainer").html("<p>Maaf, terjadi kesalahan saat memuat form.</p>");
                alert("Gagal mengecek status pelayanan.");
            }
        });
    }

    function loadForm(layanan, pasien_id) {

        $('#overlay').show(); // Tampilkan overlay


        // Simulasikan delay 1 detik sebelum AJAX dimulai
        setTimeout(function() {
            $.ajax({
                url: baseurl + "simpus/KIA_Navigation/load_form/" + layanan + "/" + pasien_id,
                type: "GET",
                success: function(response) {
                    console.log("AJAX sukses"); // Debugging
                    $('#overlay').hide(); // Sembunyikan overlay setelah selesai
                    $("#formContainer").html(response);
                },
                error: function() {
                    console.log("AJAX error"); // Debugging
                    $('#overlay').hide(); // Sembunyikan overlay jika terjadi error
                    $("#formContainer").html("<p>Maaf, terjadi kesalahan saat memuat form.</p>");
                }
            });
        }, 1000); // Delay 1 detik (1000 milidetik)
    }

    function disableButtons(activePelayanan) {
        var buttons = ["ANC", "INC", "PNC", "Neonatus", "Kematian","Tumbuh_Kembang"];
        if (!activePelayanan) {
            // Jika activePelayanan null, aktifkan semua tombol
            buttons.forEach(function(pelayanan) {
                $(`#yesButton${pelayanan}`).prop("disabled", false);
            });
        } else {
            // Jika ada activePelayanan, hanya aktifkan tombol terkait
            buttons.forEach(function(pelayanan) {
                if (pelayanan === activePelayanan) {
                    $(`#${pelayanan}`).prop("disabled", false); // Aktifkan tombol aktif
                } else {
                    $(`#${pelayanan}`).prop("disabled", true); // Disable tombol lainnya
                }
            });
        }
    }
    </script>
</body>