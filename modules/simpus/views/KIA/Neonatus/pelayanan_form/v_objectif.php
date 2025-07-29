<div id="form1" class="form-container">
  <div class="container-fluid" style="margin-top: 20px;">
    <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Form Pengiriman Data Bayi/Balita</h4>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#apgar" data-toggle="tab" class="text-danger">Pemeriksaan APGRA >></a>
                    </li>
                    <li>
                        <a href="#neonatal" data-toggle="tab" class="text-danger">Neonatal Esensial >></a>
                    </li>
                    <li>
                        <a href="#fisik" data-toggle="tab" class="text-danger">Pemeriksaan Fisik head to Toe >></a>
                    </li>
                    <li>
                        <a href="#berat-badan" data-toggle="tab" class="text-danger">Pemeriksaan Berat Badan dan Pemberian ASI >></a>
                    </li>
                </ul>

                <div class="tab-content" style="margin-top: 10px;">
                    <div class="tab-pane fade in active" id="apgar">
                        <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_apgar.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="neonatal">
                        <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_kn.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="fisik">
                        <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/fisik_neonatus.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="berat-badan">
                        <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_bb_neonatus.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
