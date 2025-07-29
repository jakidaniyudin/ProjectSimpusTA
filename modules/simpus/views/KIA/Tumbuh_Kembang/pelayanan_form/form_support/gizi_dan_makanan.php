
<div class="container">
<div class="card">
        <div class="card_body">
            <div class="m-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-3 pt-1">
                                <ul class="nav nav-tabs" id="indep-tabs-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="indep-tab-anamnesis-tab" data-toggle="pill" href="#indep-tab-anamnesis" role="tab" aria-controls="indep-tab-anamnesis" aria-selected="true">
                                            Riwayat Gizi >>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="indep-tab-gizi-tab" data-toggle="pill" href="#indep-tab-gizi" role="tab" aria-controls="indep-tab-gizi" aria-selected="false">
                                            Riwayat Makanan >>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="indep-tabs-tabContent">
                                    <div class="tab-pane fade in active" id="indep-tab-anamnesis" role="tabpanel" aria-labelledby="indep-tab-anamnesis-tab">
                                        <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/riwayat_gizi.php'); ?>
                                    </div>
                                    <div class="tab-pane fade" id="indep-tab-gizi" role="tabpanel" aria-labelledby="indep-tab-gizi-tab">
                                        <?php $this->load->view('pelayanan/KIA/Tumbuh_Kembang/pelayanan_form/form_support/riwayat_konsumsi_makanan.php'); ?>
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

</div>   
   
   