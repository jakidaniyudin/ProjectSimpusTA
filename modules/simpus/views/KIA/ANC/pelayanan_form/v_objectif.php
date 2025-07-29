<div id="form3" class="form-container">
    <h3>Pemeriksaan Fisik Pasien / Objektif</h3>
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link in active text-danger" id="custom-tabs-three-home-tab" data-toggle="pill"
                        href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                        aria-selected="true">Pemeriksaan Ibu >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Pemeriksaan Fisik Ibu >> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-three-messages-tab" data-toggle="pill"
                        href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                        aria-selected="false">Pemeriksaan USG >></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-danger" id="Janin-nav" data-toggle="pill" href="#janin" role="tab"
                        aria-controls="janin" aria-selected="false">Pemeriksaan Janin>></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-danger" id="pemeriksaanT-nav" data-toggle="pill" href="#pemeriksaanT"
                        role="tab" aria-controls="pemeriksaanT" aria-selected="false">Pemeriksaan 10T >></a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade in active" id="custom-tabs-three-home" role="tabpanel"
                    aria-labelledby="custom-tabs-three-home-tab">
                    <?php $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/pemeriksaan_ibu') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">
                    <?php $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/pemeriksaan_fisik_ibu') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-three-messages-tab">
                    <?php $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/pemeriksaan_usg') ?>
                </div>
                <div class="tab-pane fade" id="janin" role="tabpanel" aria-labelledby="janin-tab">
                    <?php $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/pemeriksaan_janin') ?>
                </div>
                <div class="tab-pane fade" id="pemeriksaanT" role="tabpanel" aria-labelledby="pemeriksaanT-tab">
                    <?php $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/pemeriksaan_10T') ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
</div>
</div>

<!-- Modal Konfirmasi Edit -->
<!-- Modal Konfirmasi Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit ModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengedit data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Edit</button>
            </div>
        </div>
    </div>
</div>