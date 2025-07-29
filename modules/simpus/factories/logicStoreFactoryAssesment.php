<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

require_once(APPPATH . 'modules/simpus/repository/Logic_Repository/logicAssesmentKematianRepository.php');
require_once(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicAssesmentINCRepository.php');
require_once(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicAssesmentANCRepository.php');


class logicStoreFactoryAssesment
{
    public function logicAssesmentManajemen($subLayanan): BaseLogicAbstract
    {
        switch ($subLayanan) {
            case 'assesment_anc': return new LogicAssesmentANCRepository();
            case 'assesment_inc': return new LogicAssesmentINCRepository();
            case 'assesment_kematian': return new logicAssesmentKematianRepository();
            default: throw new ServiceException('Layanan tidak ditemukan pada sub layanan Subjektif', 404);
        }
    }
}
