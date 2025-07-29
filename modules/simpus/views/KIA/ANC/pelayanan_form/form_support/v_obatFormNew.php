<div class="col-md-12">



    <!--   <?php
            $ceksetujui = isset($obat->setujui) ? $obat->setujui : '';
            if ($ceksetujui == 1) {
                echo "<a href=\"javascript:void(0)\" onclick=\"disetujui()\" class=\"btn btn-success btn-sm\" >Sudah Disetujui  </a>";
            } else {
                echo "<a href=\"javascript:void(0)\" onclick=\"popUp()\" class=\"btn btn-success btn-sm\" >Tambah Data </a>";
            } ?>
 -->

    <form class='form-horizontal' name='form_obat' id="form_obat">

        <div class="col-md-6">


            <div class="form-group">
                <label class="col-sm-4 control-label">Puyer/Bukan puyer</label>
                <div class="col-sm-8">
                    <select onChange="getPuyer()" name="ketPuyer" id='ketPuyer' class="">
                        <option value="0">BUKAN PUYER</option>
                        <option value="1">PUYER</option>
                    </select>
                </div>
            </div>

            <div id="namapuyerdiv">
                <div class="form-group">
                    <div class="col-sm-8">
                        <input type="hidden" name="nama_puyer" id="nama_puyer" value="puyer" width="40" class="" />
                    </div>
                </div><!-- /.form-group -->
            </div>
            <div id="jumlahpuyerdiv">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Jumlah Puyer</label>
                    <div class="col-sm-8">
                        <input type="text" name="jumlah_puyer" id="jumlah_puyer" class=""
                            onkeypress="return hanyaAngka(event)" style="width:50px" />
                    </div>
                </div><!-- /.form-group -->
            </div>

            <div id="dosispakaipuyerdiv">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Dosis pakai puyer</label>
                    <div class="col-sm-8">
                        <input type="text" name="dosis_pakai_puyer" id="dosis_pakai_puyer" class=""
                            onkeypress="return hanyaAngka(event)" style="width:50px" /> x Sehari,
                        setiap <input type="text" name="tiapJam" id="tiapJam" class=""
                            onkeypress="return hanyaAngka(event)" style="width:50px" /> Jam Sekali
                    </div>
                </div><!-- /.form-group -->
            </div>
            <div id="tambahanPuyerDiv">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Waktu</label>
                    <div class="col-sm-8">
                        <input type="checkbox" name="waktu[]" value="pagi"> pagi
                        <input type="checkbox" name="waktu[]" value="siang"> siang
                        <input type="checkbox" name="waktu[]" value="malam"> malam
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kondisi</label>
                    <div class="col-sm-8">
                        <input type="checkbox" name="kondisi[]" value="sebelum makan"> sebelum makan
                        <input type="checkbox" name="kondisi[]" value="saat makan"> saat makan
                        <input type="checkbox" name="kondisi[]" value="setelah makan"> setelah makan
                    </div>
                </div><!-- /.form-group -->
            </div>

            <?php if ($item['resep_diambil'] == '0') { ?>
                <a class='btn btn-success pull-right' href='javascript:void(0)' onclick='simpanResep()'>Simpan Resep</a>
            <?php } ?>

        </div>


        <?php
        echo form_hidden('poli', $item['kdPoli']);
        echo form_hidden('obat_id');
        echo form_hidden('pelayananId', $item['idpelayanan']);
        echo form_hidden('loketId', $loket_id);
        ?>
    </form>

    <br>

    <div class="col-sm-6">

    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div id="loadDataObat">

        </div>
    </div>
</div>




<script type="text/javascript">
    $(function() {
        getDataObat();

        $('#namapuyerdiv').hide();
        $('#jumlahpuyerdiv').hide();
        $('#jumlahobatdiv').hide();
        $('#obatdiv').hide();
        $('#dosispakaipuyerdiv').hide();
        $('#dosispakaidiv').hide();
        $('#tambahanPuyerDiv').hide();

    });


    function getDataObat() {
        load('simpus/pelayanan/loadDataObatList/' + "<?= $loket_id ?>" + '/' + "<?= $item['kdPoli'] ?>", '#loadDataObat');
    }

    function disetujui() {
        swal("Maaf !", "Tidak Bisa Tambah Data !", "error");
        return false;
    }


    function getPuyer() {
        if ($('#ketPuyer').val() == '1') {
            $('#namapuyerdiv').show();
            $('#jumlahpuyerdiv').show();
            $('#dosispakaipuyerdiv').show();
            $('#jumlahobatdiv').hide();
            $('#obatdiv').hide();
            $('#dosispakaidiv').hide();
            $('#tambahanPuyerDiv').show();
        } else {
            $('#namapuyerdiv').hide();
            $('#jumlahpuyerdiv').hide();
            $('#jumlahobatdiv').hide();
            $('#obatdiv').hide();
            $('#dosispakaipuyerdiv').hide();
            $('#dosispakaidiv').hide();
            $('#tambahanPuyerDiv').hide();

        }
    }

    function simpanResep() {
        var idLoket = "<?= $loket_id ?>";
        var idPelayanan = "<?= $item['idpelayanan'] ?>";

        $.ajax({
            url: url + 'simpus/obat/simpanResep/' + idLoket + '/' + idPelayanan,
            data: $(document.form_obat.elements).serialize(),
            success: function(r) {
                json = $.parseJSON(r);
                if (json.status == 'success') {
                    $('#form_obat')[0].reset();
                    swal("Sukses!", "Resep berhasil ditambah !", "success").then(() => {
                        getDataObat();
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

    function cari_obat(n) {

        ajaxmodal('<?php echo base_url() ?>simpus/obat/pop/' + n);

    }

    function del_obat(n) {

        $('input[name=namaObat' + n + ']').val('');

    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>