<?php

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');

class SubLayananFactoryService
{

    protected $CI;
    public  function __construct()
    {
        $this->CI =  &get_instance();
        (!class_exists('LayananSubFactorySubjektif') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactorySubjektif.php')) ||
            (!class_exists('LayananSubFactoryObstetri') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryObstetri.php')) ||
            (!class_exists('LayananSubFactoryObjektif') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryObjektif.php')) ||
            (!class_exists('LayananSubFactoryAssesment') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryAssesment.php')) ||
            (!class_exists('LayananSubFactoryImunization') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryImunization.php')) ||
            (!class_exists('LayananSubFactoryPlanning') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryPlanning.php')) ||
            (!class_exists('LayananSubFactoryStatusPasien') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LayananSubFactoryStatusPasien.php')) ||
            (!class_exists('layananSubFactoryPriview') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/layananSubFactoryPriview.php'));
    }

    public function getServiceLayanan(string $layanan): SubLayananFactoryInterface
    {
        if ($layanan == 'obstetri') {
            return new LayananSubFactoryObstetri();
        } else if ($layanan == 'subjektif') {
            return new LayananSubFactorySubjektif();
        } else if ($layanan == 'objektif') {
            return new LayananSubFactoryObjektif();
        } else if ($layanan ==  'assessment') {
            return new LayananSubFactoryAssesment();
        } else if ($layanan ==  'imunisasi') {
            return new LayananSubFactoryImunization();
        } else if ($layanan ==  'planning') {
            return new LayananSubFactoryPlanning();
        } else if ($layanan == 'status_pasiens') {
            return new LayananSubFactoryStatusPasien();
        } else if ($layanan == 'laporan_kematian') {
            return new LayananSubFactorySubjektif();
        } else if ($layanan == 'priview') {
            return new layananSubFactoryPriview();
        } else {
            throw new ServiceException('layanan tidak ditemukan', 404);
        }
    }
}
