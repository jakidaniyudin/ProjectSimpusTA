<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestKunjunganRepository implements RequestInterface
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
            'kunjunganData[tanggal_kunjungan][value]' => 'required|date',
            'kunjunganData[usia_kehamilan][value]'    => 'required|numeric',
            'kunjunganData[trimester][value]'         => 'required|integer',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('kunjunganData');
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