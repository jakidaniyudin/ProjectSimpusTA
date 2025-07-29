<div id="form3" class="form-container">
    <h3>Pemeriksaan Fisik Pasien / Objektif</h3>
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-danger" id="custom-tabs-three-persalinan-tab" data-toggle="pill"
                        href="#custom-tabs-three-persalinan" role="tab" aria-controls="custom-tabs-three-persalinan"
                        aria-selected="true">Data Persalinan >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-danger" id="custom-tabs-three-home-tab" data-toggle="pill"
                        href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                        aria-selected="false">Pengisian Kala >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Data Pelayanan Persalinan >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-three-messages-tab" data-toggle="pill"
                        href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                        aria-selected="false">Data Apgar >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="Janin-nav" data-toggle="pill" href="#bayi-form" role="tab"
                        aria-controls="bayi-form" aria-selected="false">
                        Data Bayi >>
                    </a>
                </li>



            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade in active" id="custom-tabs-three-persalinan" role="tabpanel"
                    aria-labelledby="custom-tabs-three-persalinan-tab">
                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/data_persalinan.php') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel"
                    aria-labelledby="custom-tabs-three-home-tab">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">Kala 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false">Kala 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-four-messages" role="tab"
                                        aria-controls="custom-tabs-four-messages" aria-selected="false">Kala 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-four-settings" role="tab"
                                        aria-controls="custom-tabs-four-settings" aria-selected="false">Kala 4</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade in active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/kala1.php') ?>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/kala2.php') ?>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-messages-tab">
                                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/kala3.php') ?>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-settings-tab">
                                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/kala4.php') ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">
                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/pelayanan_pasien_form.php') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-three-messages-tab">
                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/apgar_form') ?>
                </div>
                <div class="tab-pane fade" id="bayi-form" role="tabpanel" aria-labelledby="Janin-nav">
                    <?php $this->load->view('pelayanan/KIA/INC/pelayanan_form/form_support/data_bayi') ?>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.card -->
</div>
</div>