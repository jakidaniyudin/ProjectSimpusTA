<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestApgar10 implements RequestInterface
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
            'apgar10[pulse][value]'         => 'required',
            'apgar10[pulse][text]'          => 'required',
            'apgar10[pulse][score]'         => 'required|numeric',
            'apgar10[respiration][value]'   => 'required',
            'apgar10[respiration][text]'    => 'required',
            'apgar10[respiration][score]'   => 'required|numeric',
            'apgar10[activity][value]'      => 'required',
            'apgar10[activity][text]'       => 'required',
            'apgar10[activity][score]'      => 'required|numeric',
            'apgar10[appearance][value]'    => 'required',
            'apgar10[appearance][score]'    => 'required|numeric',
            'apgar10[totalScore][value]'    => 'required|numeric',
            'apgar10[totalScore][text]'     => 'required',
            'apgar10[totalScore][score]'    => 'required',
            'apgar10[grimace][value]'       => 'required',
            'apgar10[grimace][text]'        => 'required',
            'apgar10[grimace][score]'       => 'required|numeric',
        ];
    }


    public function setDataRequest($request)
    {

        $request =  $request->post('apgar10');
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