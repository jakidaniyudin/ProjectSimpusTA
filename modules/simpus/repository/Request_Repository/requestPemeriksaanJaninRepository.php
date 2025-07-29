<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanJaninRepository implements RequestInterface
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
            'form1[denyutJantungJanin][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[kendalaPAP][value]' => 'required|trim|max_length[20]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[deskripsiKendalaPAP][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[taksiranBeratJanin][value]' => 'trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[presentasi][value]' => 'required|trim|max_length[20]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[deskripsiPresentasi][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
            'form1[abdominalCircumference][value]' => 'trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]',
        ];
    }

    public function setDataRequest($request)
    {
        $request = $request->post('form1');
        $data = [];

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