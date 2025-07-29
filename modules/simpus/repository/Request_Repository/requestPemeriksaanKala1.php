<?php
require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanKala1 implements RequestInterface
{
    protected $CI;
    protected $validator;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('form_validation');
        $this->validator = $this->CI->form_validation;
    }

    public function rules()
    {
        return [
            'dataKala1[patogram][value]'         => 'required',
            'dataKala1[hasil][value]'             => 'required',
            'dataKala1[deskripsi][value]'         => 'required',
            'dataKala1[masalahLain][value]'       => 'required',
            'dataKala1[penatalaksanaan][value]'   => 'required',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('dataKala1');
        $data =  [];
        if (!empty($data)) {
            return $data;
        } else {
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