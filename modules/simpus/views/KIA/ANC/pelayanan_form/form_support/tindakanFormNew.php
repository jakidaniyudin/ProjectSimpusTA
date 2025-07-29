<style>
.form-group {
    margin-bottom: 5px;
}

.tepi {
    border: 2px solid black;
    padding: 5px;
}
</style>

<form class='form-horizontal' name='form_tindakan' id="form_tindakan">
    <div class="col-md-6">

        <div class="form-group">

            <!-- <?php $idk = isset($idKunjungan) ? $item['idKunjungan'] : ''; ?> -->
            <!-- <input type="hidden" name="idKunjungan" id="idKunjungan" value="<?= $idk ?>" class="form-control input-sm"> -->
            <?php
            print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required  readonly="readonly"'); ?>
        </div><!-- /.form-group -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Tindakan</label>
            <div class="col-sm-8">
                <div class="input-group input-group-sm">
                    <?php
                    print form_input('kdTindakan', '', 'class="form-control input-sm" readonly="readonly"'); ?>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" onclick="cari_tindakan('1')">Cari</button>
                        <button type="button" class="btn btn-danger btn-flat" onclick="del_tindakan('1')">Del</button>
                    </div>
                </div>
            </div>
        </div><!-- /.form-group -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama Tindakan</label>

            <div class="col-sm-8">
                <?php
                print form_textarea('nmTindakan', '', 'class="form-control input-sm" style="height: 30px;" readonly'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama Tindakan(Ind)</label>

            <div class="col-sm-8">
                <?php
                print form_textarea('nmTindakanInd', '', 'class="form-control input-sm" style="height: 30px;" readonly'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Keterangan</label>

            <div class="col-sm-8">
                <?php
                print form_textarea('keterangan', '', 'class="form-control input-sm" style="height: 50px;"'); ?>
            </div>
        </div><!-- /.form-group -->
        <a href="javascript:void(0)" onclick='simpan_tindakan()' class="btn btn-primary btn-sm" btn-sm>Simpan</a>
    </div>
    <input type="hidden" name="deskripsi" value="icd9cm">
</form>


<div class="col-md-4"></div>
<div class="col-md-12">
    <hr>

    <div id="loadTindakanData"></div>

</div>
<script type="text/javascript">
$(function() {
    getDataTindakan();

});

var url = '<?= base_url() ?>';

function getDataTindakan() {
    var idLoket = "<?= $loket_id ?>";
    var kdPoli = "<?= $item['kdPoli'] ?>";
    load('simpus/pelayanan/loadTindakanData/icd9cm/' + idLoket + '/' + kdPoli, '#loadTindakanData');
}

function displayResult(frm) {
    var selectedgigi = "";
    for (i = 0; i < frm.gigi.length; i++) { //menghitung jumlah panjang array
        if (frm.gigi[i].checked) {
            selectedgigi += frm.gigi[i].value + ", ";
        }
    }
    //memunculkan data di input id result yg isinya select buah
    document.getElementById("result").value = selectedgigi;
}


function simpan_tindakan() {

    var idLoket = "<?= $loket_id  ?>";
    var idPelayanan = "<?= $item['kdPoli'] ?>";
    var kdTind = $('input[name=kdTindakan]').val();

    if (kdTind == '') {
        swal("Gagal !", "Tindakan belum dipilih !", "error").then(() => {
            $('input[name=kdTindakan]').focus();
        });
        return false;
    } else {

        $.ajax({
            url: url + 'simpus/tindakan/tindakansimpan/' + idLoket + '/' + idPelayanan,
            data: $(document.form_tindakan.elements).serialize(),
            success: function(r) {
                json = $.parseJSON(r);
                if (json.status == 'success') {
                    $('#form_tindakan')[0].reset();
                    swal("Sukses!", "Tindakan berhasil ditambah !", "success").then(() => {
                        getDataTindakan();
                    });
                    // list_tindakan.ajax.reload(null,false);
                    //location.reload();
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


function cari_tindakan(n) {
    ajaxmodal('<?php echo base_url() ?>simpus/tindakan/pop/' + n);
}

function del_tindakan(n) {

    $('input[name=tindakan' + n + ']').val('');
    $('input[name=nmtindakan' + n + ']').val('');

}

function delTind(id) {


    $.ajax({
        url: '<?php echo base_url() ?>simpus/ranap/hapus_tindakan_list/' + id,
        success: function(r) {
            getDataTindakan();
        }
    });
    return false;
}

function cekharga() {
    var peraturan = $('input[type="radio"]:checked').val();
    var harga = $('input[name=harga]').val();
    if (peraturan == 'PERBUB') {
        $('input[name=bayar]').val('0');
    } else {
        $('input[name=bayar]').val(harga);
    }

}
</script>