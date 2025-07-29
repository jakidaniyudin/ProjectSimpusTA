<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanUsgRepository implements RequestInterface
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
            'pemeriksaanUsg[trimester][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[gsDiameter][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[crl][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[djj][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[usiaKehamilan][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[perkiraanLahir][value]' => 'required|trim|regex_match[/^\d{4}-\d{2}-\d{2}$/]', // Validasi format tanggal (YYYY-MM-DD)
            'pemeriksaanUsg[letakJanin][value]' => 'required|trim|max_length[20]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanUsg[taksiranPersalinan][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
        ];
    }

    public function setDataRequest($request)
    {
        $request = $request->post('pemeriksaanUsg');
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