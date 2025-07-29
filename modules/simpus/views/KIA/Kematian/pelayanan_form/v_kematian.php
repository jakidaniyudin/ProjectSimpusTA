<div class="form-container">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item text-danger">
                    <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                        aria-selected="false">Pelaporan Kematian Ibu</a>
                </li>
                <li class="nav-item text-danger">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                        href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                        aria-selected="false">Pelaporan Kematian Bayi</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade in active" id="custom-tabs-four-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-four-profile-tab">
                    <?php $this->load->view('pelayanan/KIA/Kematian/pelayanan_form/form_support/laporan_kematian_ibu') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-four-messages-tab">
                    <?php $this->load->view('pelayanan/KIA/Kematian/pelayanan_form/form_support/laporan_kematian_bayi') ?>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>