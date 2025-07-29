<form class='form-horizontal' name='form_imun' id="form_imun">

    <div class="col-md-6">
        <div style=" margin-top:8px; margin-bottom:9px"><strong><u>Imunisasi </u></strong></div>
        <!-- <div class="form-group">
   <label class="col-sm-4 control-label">Tgl Diagnosa</label>
        <div class='col-sm-6'>
                <div class='input-group date' id='dateDiag'>
                    <input type='text' id="tgldiag" name="tgldiag" value="<?= date('d-m-Y H:i:s', strtotime($item->tglKunjungan)) ?>" class="form-control" readonly />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
        <script type="text/javascript">
    $("#dateDiag").datetimepicker({
        format: "dd-mm-yyyy hh:ii:ss",
        autoclose: true,
        endDate: new Date(),
    });
</script>            
    </div> 
      </div>  -->
        <?php
        print form_hidden('pasienId', isset($pasien_id) ? $pasien_id : '');
        print form_hidden('TGL_LHR', isset($pasien->TGL_LHR) ? $pasien->TGL_LHR : '');
        ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tgl Imunisasi</label>
            <div class='col-sm-6'>
                <div class='input-group date' id='dateImun'>
                    <input type='text' id="tglImun" name="tglImun" value="<?= date('d-m-Y H:i:s', strtotime('NOW')) ?>"
                        class="form-control" readonly />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <script type="text/javascript">
                    $("#dateImun").datetimepicker({
                        format: "dd-mm-yyyy hh:ii:ss",
                        autoclose: true,
                        endDate: new Date(),
                    });
                </script>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jenis imunisasi *</label>
            <div class="col-sm-8">
                <?php
                $this->load->model('simpus_model');
                $lim = $this->simpus_model->get_imunisasi_vaksin();
                echo form_dropdown('id_imunisasi', $lim, isset($imunisasi->idImunisasi) ? $imunisasi->idImunisasi : '0', 'class=" form-control input-sm"'); ?>
            </div>
        </div>
        <a href="javascript:void(0)" onclick='simpanImun()' class="btn btn-primary btn-sm" btn-sm>Simpan</a>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <button type="button" class="btn btn-primary btn-flat pull-right btn-block"
                    onclick="pop_imun('<?= $pasien_id ?>')">Lihat Riwayat Imunisasi</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</form>


<div class="col-md-4"></div>
<div class="col-md-12">
    <hr>

    <div id="loadImunisasiData"></div>

</div>
<script type="text/javascript">
    $(function() {
        getDataImunisasi();

    });

    var url = '<?= base_url() ?>';

    function getDataImunisasi() {
        var idLoket = '<?= $item['idLoket'] ?>';
        var idPelayanan = '<?= $item['idpelayanan'] ?>';
        load('simpus/imunisasi/loadImunisasiData/' + idLoket + '/' + idPelayanan, '#loadImunisasiData');
    }



    function simpanImun() {
        var idLoket = '<?= $item['idLoket'] ?>';
        var idPelayanan = '<?= $item['idpelayanan']  ?>';
        var jenis = $('select[name=id_imunisasi]').val();
        if (jenis == '0') {
            swal("Gagal !", "Kasus jenis belum dipilih !", "error").then(() => {
                $('select[name=id_imunisasi]').focus();
            });
            return false;
        } else {

            $.ajax({
                url: url + 'simpus/imunisasi/simpan/' + idLoket + '/' + idPelayanan,
                data: $(document.form_imun.elements).serialize(),
                success: function(r) {
                    json = $.parseJSON(r);
                    if (json.status == 'success') {
                        $('#form_imun')[0].reset();

                        swal("Sukses!", "Imunisasi berhasil ditambah !", "success").then(() => {
                            getDataImunisasi();
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



    function pop_imun(id) {

        ajaxmodal('<?php echo base_url() ?>simpus/popup/imun_pop/' + id);

    }
</script>