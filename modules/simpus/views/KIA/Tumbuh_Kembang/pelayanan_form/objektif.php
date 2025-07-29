<div class="container">
    <div class="card">
        <div class="card_body">
            <div class="m-2">
            <div class="row">
            <div class="col-12">
                <div class="card card-primary card-tabs">
                <div class="card-header p-3 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pengiriman Data Antropometri >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pengiriman Data Stimulasi, Deteksi, dan Intervensi Dini Tumbuh Kembang (SDIDTK) >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-status-tab" data-toggle="pill" href="#custom-tabs-one-status" role="tab" aria-controls="custom-tabs-one-status" aria-selected="false">Pengiriman Data Status Pertumbuhan dan Perkembangan, serta Data Lainnya >> </a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade in active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/antropometri.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/pengiriman_sdidtk.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-status" role="tabpanel" aria-labelledby="custom-tabs-one-status-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/pengiriman_data_status.php'); ?>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

