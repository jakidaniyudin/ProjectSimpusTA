<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestDataBayiNeonatus implements RequestInterface
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
            'dataBayiBalita[tanggalLahir][value]'   => 'required',
            'dataBayiBalita[jamLahir][value]'       => 'required',
            'dataBayiBalita[kotaKelahiran][value]'  => 'required|numeric',
            'dataBayiBalita[jenisKelamin][value]'   => 'required|numeric',
            'dataBayiBalita[anakKe][value]'         => 'required|numeric',
            'dataBayiBalita[usiaGestasi][value]'    => 'required|numeric',
        ];
    }


    public function setDataRequest($request)
    {
        $request = $request->post('dataBayiBalita');
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