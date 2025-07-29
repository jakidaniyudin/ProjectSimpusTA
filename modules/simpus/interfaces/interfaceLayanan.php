<?php
interface interfaceLayanan
{
    public function load_form($load, $pasien_id);
    public function checkStatusPelayanan($pasien_id);
    public function setPelayanan($pasien_id, $pelayanan);
    public function set($pasien_id, $pelayanan);
    public function update($pasien_id, $pelayanan);
    public function dataPrepare();
}