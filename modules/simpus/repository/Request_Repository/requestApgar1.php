<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestApgar1 implements RequestInterface
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
            'apgar1[pulse][value]'         => 'required',
            'apgar1[pulse][text]'          => 'required',
            'apgar1[pulse][score]'         => 'required|numeric',
            'apgar1[respiration][value]'   => 'required',
            'apgar1[respiration][text]'    => 'required',
            'apgar1[respiration][score]'   => 'required|numeric',
            'apgar1[activity][value]'      => 'required',
            'apgar1[activity][text]'       => 'required',
            'apgar1[activity][score]'      => 'required|numeric',
            'apgar1[appearance][value]'    => 'required',
            'apgar1[appearance][text]'     => 'required',
            'apgar1[appearance][score]'    => 'required|numeric',
            'apgar1[totalScore][value]'    => 'required|numeric',
            'apgar1[totalScore][text]'     => 'required',
            'apgar1[totalScore][score]'    => 'required',
            'apgar1[grimace][value]'       => 'required',
            'apgar1[grimace][text]'        => 'required',
            'apgar1[grimace][score]'       => 'required|numeric',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('apgar1');
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