<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaan10tRepository implements RequestInterface
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
            'pemeriksaan10T[hemoglobin][value]'                => 'required|trim|numeric|less_than_equal_to[100]',
            'pemeriksaan10T[hivTest][value]'                   => 'required|trim|in_list[Reaktif,Non Reaktif]',
            'pemeriksaan10T[deskripsiHIVTest][value]'          => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]*$/]',
            'pemeriksaan10T[syphilisTest][value]'              => 'required|trim|in_list[Reaktif,Non Reaktif]',
            'pemeriksaan10T[deskripsiSyphilisTest][value]'     => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]*$/]',
            'pemeriksaan10T[hepatitisBTest][value]'            => 'required|trim|in_list[Reaktif,Non Reaktif]',
            'pemeriksaan10T[deskripsiHepatitisBTest][value]'   => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]*$/]',
            'pemeriksaan10T[gulaDarah][value]'                 => 'required|trim|numeric|less_than_equal_to[1000]',
            'pemeriksaan10T[proteinUrin][value]'               => 'required|trim|numeric|less_than_equal_to[1000]',
        ];
    }

    public function setDataRequest($request)
    {
        $request = $request->post('pemeriksaan10T');
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