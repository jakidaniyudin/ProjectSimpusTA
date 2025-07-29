<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestNifasPNC implements RequestInterface
{
    protected $CI;
    protected $validator;

    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->library('form_validation');
        $this->validator = $this->CI->form_validation;
    }

    public function rules()
    {
        return [
            'dataPersalinanPNC[pemeriksaanKe][value]' => 'required|numeric',
            'dataPersalinanPNC[sistolik][value]' => 'required|numeric',
            'dataPersalinanPNC[diastolik][value]' => 'required|numeric',
            'dataPersalinanPNC[nadi][value]' => 'required|numeric',
            'dataPersalinanPNC[suhu][value]' => 'required|numeric',
            'dataPersalinanPNC[pernafasan][value]' => 'required|numeric',
            'dataPersalinanPNC[kondisiPayudara][value]' => 'required|numeric',
            'dataPersalinanPNC[pendarahan][value]' => 'required|numeric',
            'dataPersalinanPNC[jumlahPendarahan][value]' => 'required|numeric',
            'dataPersalinanPNC[kontraksiUteri][value]' => 'required',
            'dataPersalinanPNC[warnaLokia][value]' => 'required|numeric',
            'dataPersalinanPNC[produksiAsi][value]' => 'required|numeric',
            'dataPersalinanPNC[konseling][value]' => 'required|numeric',
        ];
    }

    public function setDataRequest($request)
    {
        $request = $request->post('dataPersalinanPNC');
        $data  = [];
        if(empty($request)){
            return $data;
        }else{
            return $request;
        }
    }

    public function setProtocol($request)
    {
       $rules = $this->rules();
        $this->validator->reset_validation();
        if (!empty($rules)) {
            foreach ($rules as $field => $rule) {
                $this->validator->set_rules($field, ucfirst(str_replace('_', ' ', $field)), $rule);
            }
            // Menjalankan validasi
            
            if ($this->validator->run() == false) {
                $errors = $this->validator->error_array();
                throw new ServiceException('validation failed', 400, $errors);
            }
        }
        return $this->setDataRequest($request); // Memanggil setDataRequest dengan $this
    }
}