<?php $polTuj = isset($item['tujuanPoli']) ? $item['tujuanPoli'] : '0'; ?>
<div id="warning">
    <?php var_dump($pasien) ?>
    <?php
    $q = $this->db->query('SELECT COUNT(*) AS jml FROM simpus_data_diagnosa a 
		LEFT JOIN simpus_diagnosa b ON a.`kdDiagnosa`=b.`kdDiag`
		WHERE b.non_spes="1" AND a.`pelayananId`="' . $item['idpelayanan'] . '";')->row('jml');
    //echo $this->db->last_query();

    $r = $this->db->query('SELECT a.kdDiagnosa,a.nmDiagnosa FROM simpus_data_diagnosa a 
		LEFT JOIN simpus_diagnosa b ON a.`kdDiagnosa`=b.`kdDiag`
		WHERE b.non_spes="1" AND a.`pelayananId`="' . $item['idpelayanan'] . '";')->result();

    if ($q > '0') {
    ?>

    <div class="callout callout-danger">
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <p>Terdapat Diagnosa <b>NON SPESIALISTIK</b> yang digunakan.</p>
        <?php $i = 0;
            foreach ($r as $row): $i++; ?>
        <p>&#9830; <?= $row->kdDiagnosa ?> - <?= $row->nmDiagnosa ?></p>
        <?php endforeach ?>
    </div>
    <?php } ?>
</div>
<form class='form-horizontal' name='form_rujuk' id="form_rujuk">

    <div class="col-md-6">
        <div style=" margin-top:8px; margin-bottom:9px"><strong><u>Rujukan</u></strong></div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Status Pulang</label>
            <div class="col-sm-8">
                <?php
                $this->load->model('simpus_model');
                $kdStatusPulang = $this->simpus_model->get_statuspulang();

                print form_dropdown('kdStatusPulang', $kdStatusPulang, isset($item['kdStatusPulang']) ? $item['kdStatusPulang'] : '', 'class="form-control input-sm" onchange="statuspulang(),get_tacc()" '); ?>
            </div>
        </div><!-- /.form-group -->
        <div id="statuspulang"></div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Tenaga Medis</label>
            <div class="col-sm-8">
                <?php


                $kdDokter = $this->simpus_model->get_tenagaMedis();

                print form_dropdown('tenagaMedis', $kdDokter, isset($item['tenagaMedis']) ? $item->tenagaMedis : '', 'class="form-control input-sm" '); ?>
            </div>

        </div> <!-- /.form-group -->




        <?php $polakhir = $this->db->query('SELECT b.kdPoli, b.`kdStatusPulang`
			FROM simpus_loket AS a 
			INNER JOIN simpus_pelayanan AS b ON a.idLoket=b.loketId
			WHERE loketId="' . $loket_id . '" ORDER BY b.`idpelayanan` DESC LIMIT 1;');
        $plakhir = $polakhir->row('kdPoli');
        $sPulang = $polakhir->row('kdStatusPulang');

        // 

        if ($item['tujuanPoli'] != '004') {
            if ($sPulang == '4' || $sPulang == '3' || $sPulang == '6' || $sPulang == '10') {
                echo '<a href="javascript:void(0)" onclick="simpan_rujuk_selesai()" class="btn btn-info btn-sm">Simpan</a>';
            } else {
                echo '<a href="javascript:void(0)" onclick="simpan_rujuk_cek()" class="btn btn-success btn-sm">Simpan</a>';
            }
        } else {
            echo '<a href="javascript:void(0)" onclick="simpan_rujuk_cek()" class="btn btn-success btn-sm">Simpan</a>';
        }
        ?>
    </div><!-- /.col -->
    <div class="col-md-6">

        <div style=" margin-top:8px; margin-bottom:9px">&nbsp;</div>
        <div class="col-md-12">
            <?php if ($q > '0') {
            ?>
            <div id="tacc">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kode Tacc</label>
                    <div class="col-sm-8">
                        <?php

                            $kdTacc = $this->simpus_model->get_kdTacc();
                            print form_dropdown('kdTacc', $kdTacc, isset($item['kdTacc']) ? $item['kdTacc'] : '', 'class="form-control input-sm" onchange="alasan_tacc()"'); ?>
                    </div>

                </div>
                <div id="alasan"></div>
                <?php if ($item['kdTacc'] == '3') { ?>
                <div class="col-sm-4"> </div>
                <div class="col-sm-8">
                    <?php print form_input('kdDiagnosa', $item['alasanTacc'], 'class="form-control input-sm" required  readonly="readonly"'); ?>
                </div>
                <?php } else { ?>
                <div id="comAlasan">
                    <div class="form-group">
                        <div class="col-sm-4"> </div>
                        <div class="col-sm-2">

                            <?php
                                    print form_input('kdDiagnosa', '', 'class="form-control input-sm" required  readonly="readonly"'); ?>
                        </div>
                        <div class="col-sm-6" style="padding-left:1px;">
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
                    </div><!-- /.form-group -->
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <div class="col-md-2"></div>

    </div><!-- /.col -->
</form>

<div class="col-md-4"></div>
<div class="col-md-12">
    <hr>

    <div id="loadRujukData"></div>

</div>

<!-- Rujukan -->
<div class="modal fade" id="rujukanModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"
    style="margin-top: -20px;">
    <div class="modal-dialog modal-lg" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Rujuk Lanjut Pasien</h4>
            </div>
            <div class="modal-body">
                <div id="rujukan_result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    getDataRujuk();
    statuspulang();
    get_tacc();
    alasan_tacc()

});


var url = '<?= base_url() ?>';

function getDataRujuk() {
    load('simpus/pelayanan/loadRujukData/<?= $loket_id ?>', '#loadRujukData');
}


function statuspulang() {
    var kdStatusPulang = $('select[name=kdStatusPulang]').val();
    load('simpus/dropdown/statuspulang/' + kdStatusPulang + '/<?= $polTuj ?>/<?= $loket_id ?>', '#statuspulang');
}

function alasan_tacc() {
    var kdTacc = $('select[name=kdTacc]').val();
    if (kdTacc == '3') {
        $("#alasan").hide();
        $("#comAlasan").show();
    } else {
        load('simpus/dropdown/alasanTacc/' + kdTacc + '/<?= $item['idpelayanan'] ?>/<?= $loket_id ?>', '#alasan');
        $("#comAlasan").hide();
        $("#alasan").show();
    }
}

function get_tacc() {
    var lap = $('select[name=kdStatusPulang]').val();
    if ((lap == '4')) {
        // $("#kdDiag").attr('disabled',false);
        // $("#Diag").attr('disabled',false);
        $("#tacc").show();
        $("#warning").show();
    } else {
        // $("#kdDiag").val('0');
        // $("#Diag").attr('disabled','disabled');
        // $("#Diag").val('');
        $("#tacc").hide();
        $("#warning").hide();
    }
}

function cari_rujukan() {
    $.ajax({
        url: "<?php echo base_url() ?>simpus/pelayanan/rujukan_pop/<?= $pasien['noKartu'] ?>",
        method: "POST",
        success: function(data) {
            $('#rujukan_result').html(data);
            $('#rujukanModal').modal('show');
        }

    });
}

function cari_rujukanUmum() {
    $.ajax({
        url: "<?php echo base_url() ?>simpus/pelayanan/rujukanUmum_pop",
        method: "POST",
        success: function(data) {
            $('#rujukan_result').html(data);
            $('#rujukanModal').modal('show');
        }

    });
}

function simpan_rujuk_cek() {
    var stts = $('select[name=kdStatusPulang]').val();
    if (stts == '4') {

        var nmppk = $('input[name=nmppk]').val();
        if (nmppk == '') {
            swal("Gagal !", "PPK Rujukan Belum di isi !", "error");
            return false;
        } else {
            simpan_rujuk();
        }

    } else if (stts == '5') {

        var internal = $('select[name=kdPoliRujukInternal]').val();
        if (internal == '') {
            swal("Gagal !", "Rujukan Belum di pilih !", "error");
            return false;
        } else {
            simpan_rujuk();
        }

    } else if (stts == '6') {

        var rjkumum = $('select[name=kdProviderRujukLanjut]').val();
        if (rjkumum == '') {
            swal("Gagal !", "Rujukan Belum di pilih !", "error");
            return false;
        } else {
            simpan_rujuk();
        }

    } else {
        simpan_rujuk();
    }
}

function simpan_rujuk() {
    var idLoket = "<?= $loket_id ?>";
    var idpelayanan = "<?= $item['idpelayanan'] ?>";
    $.ajax({
        url: url + 'simpus/pelayanan/rujukSimpan/' + idLoket + '/' + idpelayanan,
        data: $(document.form_rujuk.elements).serialize(),
        success: function(r) {
            json = $.parseJSON(r);
            if (json.status == 'success') {
                if (json.bridging == 'yes') {
                    swal({
                            title: "Pastikan data sudah benar! Data akan di bridging?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                //kunjungan_bpjs(idpelayanan);
                            } else {
                                swal("Warning!", "bridging di batalkan! data tetap tersimpan!",
                                    "success").then(() => {
                                    location.reload();
                                });
                            }
                        });

                } else {
                    swal("Sukses!", json.message, "success").then(() => {
                        location.reload();
                    });
                }
                //location.reload();
            }
        },
        type: "post",
        dataType: "html"
    });
    return false;
}

function simpan_rujuk_warning() {
    swal("Gagal !", "Sudah ada data yang sama !", "error");
}

function simpan_rujuk_selesai() {
    swal("Selesai !", "Sudah selesai dilayani !", "info");
}

function cekpoli() {
    var poli = <?= $item['kdPoli'] ?>;
    var tjpoli = $('select[name=kdPoliRujukInternal]').val();
    if (poli == tjpoli) {
        swal("Gagal !", "Tidak Boleh sama dengan poli sekarang !", "error").then(() => {
            $('select[name=kdPoliRujukInternal]').val('');
        });;
    }

}


function kunjungan_bpjs(id) {

    //	alert(id);
    $.ajax({
        url: '<?php echo base_url() ?>wsbpjs/addkunjungan_ok/' + id,
        success: function(r) {

            if (r.metaData.code == '201') {
                var obj = r.response;


                update_kunjungan_bpjs(id, r.response.message);
                get_items_tetep();

            } else {
                var obj = r.response;
                swal(r.response + ' ( ' + r.metaData.message + ' ) ' + obj[0].message + ' - ' + obj[0]
                    .field).then(() => {
                    location.reload();
                });
                //swal(r.metaData.message,obj[0].message, "error");
            }
        }
    });
    return false;
}

function update_kunjungan_bpjs(id, noKunjungan) {

    $.ajax({
        url: '<?php echo base_url() ?>wsbpjs/update_kunjungan_bpjs/' + id + '/' + noKunjungan,
        success: function(r) {
            // $('#content').html(response);
            json = $.parseJSON(r);
            if (json.status == 'success') {


            } else {

            }
        },
        type: "post",
        dataType: "html"
    });
    return false;
}

function loadDataDokter() {
    var m = document.getElementById("kdppk").value;
    alert(m);
}
</script>