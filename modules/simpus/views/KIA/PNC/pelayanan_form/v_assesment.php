<div class="row">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-danger" id="custom-tabs-four-home-tab" data-toggle="pill"
                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                        aria-selected="true">Diagnosa Medis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" id="custom-tabs-four-profile-tab" data-toggle="pill"
                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                        aria-selected="false">Skrining</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade in active" id="custom-tabs-four-home" role="tabpanel"
                    aria-labelledby="custom-tabs-four-home-tab">
                    <div class="row" style="margin: 4px;">
                        <div class="col-sm-6">
                            <div style=" margin-top:8px; margin-bottom:9px; color: red;"><strong><u>Diagnosa
                                        Medis</u></strong></div>
                            <!-- from diagnosa medis -->
                            <form class='form-horizontal' name='form_diagnosa' id="form_diagnosa">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-2">

                                            <?php
                                            print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required  readonly="readonly"');
                                            //print form_input('non_spes','','class="form-control input-sm" required  readonly="readonly"');
                                            print form_input('kdDiagnosa', '', 'class="form-control input-sm" required  readonly="readonly"'); ?>
                                        </div>
                                        <div class="col-sm-10" style="padding-left:1px;">
                                            <div class="input-group input-group-sm">
                                                <?php
                                                print form_input('nmDiagnosa', '', 'class="form-control input-sm" readonly="readonly"'); ?>
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-flat"
                                                        onclick="cari_diagnosa('1')">Cari</button>
                                                    <button type="button" class="btn btn-danger btn-flat"
                                                        onclick="del_diagnosa('1')">Del</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.form-group -->

                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="">Alergi Makanan</label>
                                            <?php
                                            $kodeAlergiMakanan = isset($alergi->kodeAlergiMakanan) ? $alergi->kodeAlergiMakanan : '';
                                            $alergiMakanan = $this->db->query("SELECT ma.`namaAlergiBpjs` FROM simpus_alergi_data sa
            INNER JOIN master_alergi ma ON sa.`kodeAlergiMakanan`= ma.`kodeSatuSehat` 
            WHERE sa.`pasienId`='" . $pasien_id . "' ")->row();
                                            ?>
                                            <input class="form-control input-sm" style="background-color:yellow"
                                                value="<?php echo isset($alergiMakanan->namaAlergiBpjs) ? $alergiMakanan->namaAlergiBpjs : '' ?>">
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="">Alergi Obat</label>

                                            <?php
                                            $kodeAlergiObat = isset($alergi->kodeAlergiObat) ? $alergi->kodeAlergiObat : '';
                                            $alergiObat = $this->db->query("SELECT ma.`namaAlergiBpjs` FROM simpus_alergi_data sa
              INNER JOIN master_alergi ma ON sa.`kodeAlergiObat`= ma.`kodeSatuSehat` 
              WHERE sa.`pasienId`='" . $pasien_id . "' ")->row();
                                            ?>
                                            <input class="form-control input-sm" style="background-color:yellow"
                                                value='<?php echo isset($alergiObat->namaAlergiBpjs) ? $alergiObat->namaAlergiBpjs : '' ?>'>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="">Keterangan alergi</label>
                                            <input class="form-control input-sm" style="background-color:yellow"
                                                value='<?php echo isset($alergi->keterangan) ? $alergi->keterangan : '' ?>'>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <label>Kunjungan Kasus *</label>

                                            <?php
                                            $this->load->model('master_model');
                                            $diagnosaKasus = $this->master_model->get_diagnosa_kasus();
                                            //echo $this->db->last_query();
                                            print form_dropdown('diagnosaKasus', $diagnosaKasus, isset($item->diagnosaKasus) ? $item->diagnosaKasus : '', 'class="form-control input-sm select2" required'); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <?php
                                            print form_input('keterangan', '', 'class="form-control input-sm"'); ?>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>


                                <a href="javascript:void(0)" onclick='simpan()' class="btn btn-success pull-left"><i
                                        class="fa fa-save"></i>
                                    Simpan Diagnosa Medis</a>
                            </form>
                            <!-- end form diagnosa medis -->
                        </div>
                        <div class="col-sm-6">

                            <div class="col-sm-4">

                                <div style=" margin-top:8px; margin-bottom:9px; color:red"><strong><u>Pemeriksaan
                                            Penunjang</u></strong>
                                </div>
                                <a href="javascript:void(0)"
                                    onclick="form('<?= $item['kdPoli'] ?>/<?= $loket_id ?>/<?= $item['idpelayanan'] ?>')"
                                    class="btn btn-sm btn-info"><i class="fa fa-bars"></i> Laboratorium</a>

                            </div>
                            <div class="col-sm-8">
                                <div style=" margin-top:8px; margin-bottom:9px; color: red;"><strong><u>Form
                                            lanjutan</u></strong></div>
                                <?php
                                $diaree = isset($diare->cek) ? $diare->cek : '0';
                                if (($diaree != '0')) { ?>
                                <a href="javascript:void(0)" class="btn btn-primary "
                                    onclick="pop_diare('<?= $item->idpelayanan ?>')"><i class="fa fa-edit"></i>
                                    Diare</a>
                                <?php } else { ?>
                                <a href="javascript:void(0)" class="btn btn-default "> <i class="fa fa-edit"></i>
                                    Diare</a>
                                <?php } ?>

                                <?php
                                $katarak = isset($katarakItem->cekKatarak) ? $katarakItem->cekKatarak : '0';
                                if (($katarak != '0')) { ?>
                                <a href="javascript:void(0)" class="btn btn-primary "
                                    onclick="pop_katarak('<?= $item->idpelayanan ?>')"><i class="fa fa-edit"></i>
                                    Diare</a>
                                <?php } else { ?>
                                <a href="javascript:void(0)" class="btn btn-default "><i class="fa fa-edit"></i>
                                    Katarak</a>
                                <?php } ?>

                                <a href="javascript:void(0)" class="btn btn-default "><i class="fa fa-edit"></i> PTM</a>

                                <a href="javascript:void(0)" class="btn btn-default "><i class="fa fa-edit"></i>
                                    Hipertensi</a>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">


                                    <div style=" margin-top:8px; margin-bottom:9px; color: red;"><strong><u>Diagnosa
                                                Keperawatan</u></strong></div>
                                    <form class='form-horizontal' name='form_diagnosa_keperawatan'
                                        id="form_diagnosa_keperawatan">
                                        <div class="col-sm-12">

                                            <div class="form-group">
                                                <?php
                                                $diagnosaKeperawatan = $this->master_model->get_diagnosa_keperawatan();
                                                //echo $this->db->last_query();
                                                print form_dropdown('nmDiagnosaKeperawatan', $diagnosaKeperawatan, '', 'class="form-control  select2 input-sm" style="width:100%"'); ?>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" onclick='simpanDiagKeperawatan()'
                                            class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan Diagnosa
                                            Keperawatan</a>
                                    </form>



                                </div>
                            </div>
                        </div>


                    </div><!-- end row 1 -->

                    <div class="row">

                        <hr>

                        <div id="loadDiagnosaData"></div>



                    </div><!-- end row 2 -->

                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-four-profile-tab">
                    <div class="row" style="margin: 4px;">
                        <?php $this->load->view('pelayanan/KIA/Kematian/pelayanan_form/form_support/skrining') ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>


<script src="<?php echo base_url() ?>template/admin/plugins/select2/js/select2.min.js"></script>

<script type="text/javascript">
$(function() {
    getDataDiagnosa();
    $('.select2').select2();

});

var url = '<?= base_url() ?>';

function cari_diagnosa(n) {

    ajaxmodal('<?php echo base_url() ?>simpus/diagnosa/pop/' + n);

}

function getDataDiagnosa() {
    var idLoket = "<?= $loket_id ?>";
    var idPelayanan = "<?= $item['idpelayanan'] ?>";
    load('simpus/pelayanan/loadDiagnosaData/' + idLoket + '/' + idPelayanan, '#loadDiagnosaData');
}

function simpan() {

    var kdPoli = <?= $item['kdPoli'] ?>;
    var idLoket = "<?= $loket_id ?>";
    var idPelayanan = "<?= $item['idpelayanan']; ?>";
    var kasus = $('select[name=diagnosaKasus]').val();
    var kdDiag = $('input[name=kdDiagnosa]').val();
    if (kasus == '0') {
        swal("Gagal !", "Kasus diagnosa belum dipilih !", "error").then(() => {
            $('select[name=diagnosaKasus]').focus();
        });
        return false;
    } else if (kdDiag == '') {
        swal("Gagal !", "Diagnosa belum dipilih !", "error").then(() => {
            $('input[name=kdDiagnosa]').focus();
        });
        return false;
    } else {

        $.ajax({
            url: url + 'simpus/diagnosa/diagnosasimpan/' + idLoket + '/' + idPelayanan,
            data: $(document.form_diagnosa.elements).serialize(),
            success: function(r) {
                json = $.parseJSON(r);
                if (json.status == 'success') {
                    $('#form_diagnosa')[0].reset();

                    swal("Sukses!", "Diagnosa berhasil ditambah !", "success").then(() => {
                        loadForm('PNC/assessment');
                    });
                } else {
                    swal(json.message);
                }
            },
            type: "post",
            dataType: "html"
        });
        return false;
    }
}

function simpanDiagKeperawatan() {

    var kdPoli = <?= $item['kdPoli'] ?>;
    var idLoket = "<?= $loket_id ?>";
    var idPelayanan = "<?= $item['idpelayanan'] ?>";

    var diagKeperawatan = $('select[name=nmDiagnosaKeperawatan]').val();
    if (diagKeperawatan == '0') {
        swal("Gagal !", "Diagnosa keperawatan belum dipilih !", "error").then(() => {
            $('select[name=nmDiagnosaKeperawatan]').focus();
        });
        return false;
    } else {
        $.ajax({
            url: url + 'simpus/diagnosa/diagnosaKeperawatansimpan/' + idLoket + '/' + idPelayanan,
            data: $(document.form_diagnosa_keperawatan.elements).serialize(),
            success: function(r) {
                json = $.parseJSON(r);
                if (json.status == 'success') {
                    $('#form_diagnosa_keperawatan')[0].reset();

                    swal("Sukses!", "Diagnosa keperawatan berhasil ditambah !", "success").then(() => {
                        loadForm('PNC/assesment');
                    });
                } else {
                    swal(json.message);
                }
            },
            type: "post",
            dataType: "html"
        });
        return false;
    }




}

function del_diagnosa(n) {

    $('input[name=kdDiagnosa]').val('');
    $('input[name=nmDiagnosa]').val('');
}

function loadForm(target) {
    $('#form-container').load('<?= base_url("simpus/KIASubNavigation/load_form/") ?>' + target,
        function(response, status, xhr) {
            if (status == "error") {
                $('#form-container').html("<p>Error loading form: " + xhr.status + " " +
                    xhr.statusText + "</p>");
            } else {
                $('.form-container').hide();
                $('.form-container').first().show();
            }
        });
}

function pop_Katarak(idpelayanan) {
    ajaxmodal('<?php echo base_url() ?>simpus/popup/katarak_pop/' + idpelayanan);
}

function pop_diare(idpelayanan) {
    ajaxmodal('<?php echo base_url() ?>simpus/popup/diare_pop/' + idpelayanan);
}

function form(pol, idLoket, idPelayanan) {
    window.open('<?php echo base_url() ?>simpus/laborat/form/' + pol, '_self');
}
</script>