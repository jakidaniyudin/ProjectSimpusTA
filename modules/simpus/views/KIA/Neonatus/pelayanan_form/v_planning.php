<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_tindakan" data-toggle="tab" style="color:red; font-weight: bold;">Tindakan</a>
        </li>
        <li><a href="#tab_obat" data-toggle="tab" style="color:red; font-weight: bold;">Pengobatan</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_tindakan">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $data['item'] =  $item;
                    $data['pasien_id'] = $pasien_id;
                    $data['loket_id'] = $loket_id;
                    ?>
                    <?php echo  $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/tindakanFormNew', $data) ?>
                </div>

            </div>
        </div>
        <div class="tab-pane" id="tab_obat">
            <div class="row">
                <div class="col-md-12">

                </div>
                <?php echo  $this->load->view('pelayanan/KIA/ANC/pelayanan_form/form_support/v_obatFormNew', $data) ?>

            </div>
        </div>
    </div>
</div>