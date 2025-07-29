<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryANC.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryINC.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryKematian.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananGeneral.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryPNC.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryNeonatus.php';
require_once APPPATH . 'modules/simpus/repository/Layanan_Repository/LayananRepositoryTumbuhKembang.php';
class LayananFactory
{
    public static function layananManager($pelayanan):interfaceLayanan
    {
        if ($pelayanan == 'ANC') {
            return new LayananRepositoryANC();
        } else if ($pelayanan == 'INC') {
            return new LayananRepositoryINC();
        } else if ($pelayanan == 'Kematian') {
            return new LayananRepositoryKematian();
        } else if ($pelayanan == 'PNC') {
            return new LayananRepositoryPNC();
        } else if ($pelayanan == 'Neonatus') {
            return new LayananRepositoryNeonatus();
        } else if ($pelayanan == 'Tumbuh_Kembang'){
            return new LayananRepositoryTumbuhKembang();
        } else {
            throw new ServiceException('layanan Kesehatan tidak ditemukan', 404);
        }
    }
}
