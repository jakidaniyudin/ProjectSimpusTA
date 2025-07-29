<?php 
require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

class logicAssesmentKematianRepository extends BaseLogicAbstract
{
    protected $CI;

    public function __construct(){
        $this->CI =  &get_instance();
        $this->CI->load->library('uuid');
        $this->CI->load->model('PemeriksaanRecordDetail_model');
        $this->CI->load->model('HasilPemeriksaan_model');
        $this->CI->load->model('MasterSubLayanan_model');
    }

    public function get($post){}
    public function set($post, $data){
        try{
            $loket_id =  $post->post('loket_id');
            $start = $post->post('start');
            $id_pemeriksaan_record =  $post->post('actv_service');
            $id_dokter =  $post->post('id_dokter');
            // mengambil id_subLayanan
            $id_subLayanan =  $this->CI->MasterSubLayanan_model->getByName('assesment_kematian');
            //set pemerisaan record set
            $id_record_detail = $this->setRecordDetail($loket_id, $start, $id_subLayanan->id, $id_pemeriksaan_record, $id_dokter);
            return $id_record_detail;
        }catch (ServiceException $e){
            throw new ServiceException('failed sistem ', 500, $e->getMessage());
        }
    }

    protected function setRecordDetail($loket_id, $start, $id_subLayanan, $id_pemeriksaan_record, $id_dokter){
        $id_record_detail =  null;
        if (!empty($this->CI->PemeriksaanRecordDetail_model->getByLoket($loket_id, $id_subLayanan))) {
            $id_record_detail = ($this->CI->PemeriksaanRecordDetail_model->getByLoket($loket_id, $id_subLayanan))->id;
            $this->CI->PemeriksaanRecordDetail_model->update($start, $id_subLayanan, $loket_id);
        } else {
            //melakukan proses create baru jika loket berbeda // sub layanan berbeda
            $id_record_detail =  $this->CI->PemeriksaanRecordDetail_model->create($loket_id, $id_pemeriksaan_record, $id_dokter, $id_subLayanan, $start);
        }
        return $id_record_detail;
    }
    public function create($data, $id_record_detail){}
    public function update($data, $id_record_detail = null){}
    public function delete($post){}

}