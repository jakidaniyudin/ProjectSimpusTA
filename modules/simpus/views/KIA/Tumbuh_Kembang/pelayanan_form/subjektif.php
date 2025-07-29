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
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pengiriman Data Anamnesis >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pengiriman Data Riwayat Terkait Gizi dan Konsumsi Makanan >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-asi-tab" data-toggle="pill" href="#custom-tabs-one-asi" role="tab" aria-controls="custom-tabs-one-asi" aria-selected="false">Pengiriman Data Asi >> </a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade in active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/anamnesis.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/gizi_dan_makanan.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-asi" role="tabpanel" aria-labelledby="custom-tabs-one-asi-tab">
                            <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/keterangan_bayi.php'); ?>
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

