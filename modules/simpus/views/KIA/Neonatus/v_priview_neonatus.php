<div class="m-2">

    <h2>Resumen Medis Neonatus</h2>
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
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-imunisasi" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-planning" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-status_pasien" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
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
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyMessage">
                    <!-- Pesan akan diisi secara dinamis -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="confirmActionButton" class="btn btn-primary">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

</div>



<script>

</script>