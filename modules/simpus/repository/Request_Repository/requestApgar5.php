<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestApgar5 implements RequestInterface
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
            'apgar5[pulse][value]'         => 'required',
            'apgar5[pulse][text]'          => 'required',
            'apgar5[pulse][score]'         => 'required|numeric',
            'apgar5[respiration][value]'   => 'required',
            'apgar5[respiration][text]'    => 'required',
            'apgar5[respiration][score]'   => 'required|numeric',
            'apgar5[activity][value]'      => 'required',
            'apgar5[activity][text]'       => 'required',
            'apgar5[activity][score]'      => 'required|numeric',
            'apgar5[appearance][value]'    => 'required',
            'apgar5[appearance][text]'     => 'required',
            'apgar5[appearance][score]'    => 'required|numeric',
            'apgar5[totalScore][value]'    => 'required|numeric',
            'apgar5[totalScore][text]'     => 'required',
            'apgar5[totalScore][score]'    => 'required',
            'apgar5[grimace][value]'       => 'required',
            'apgar5[grimace][text]'        => 'required',
            'apgar5[grimace][score]'       => 'required|numeric',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('apgar5');
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