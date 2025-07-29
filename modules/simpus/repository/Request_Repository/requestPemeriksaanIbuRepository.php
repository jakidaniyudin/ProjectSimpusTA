<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanIbuRepository implements RequestInterface
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
            'pemeriksaanIbu[beratBadan][value]' => 'required|regex_match[/^[0-9]+(\.[0-9]+)?$/]',
            'pemeriksaanIbu[lingkarLengan][value]' => 'required|regex_match[/^[0-9]+(\.[0-9]+)?$/]',
            'pemeriksaanIbu[statusLingkarLengan][value]' => 'required',
            'pemeriksaanIbu[deskripsiLingkarLengan][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]', // HARUS DIUBAH
            'pemeriksaanIbu[tinggiFundus][value]' => 'required|regex_match[/^[0-9]+(\.[0-9]+)?$/]',
            'pemeriksaanIbu[sistolik][value]' => 'required|regex_match[/^[0-9]+$/]',
            'pemeriksaanIbu[diastolik][value]' => 'required|regex_match[/^[0-9]+$/]',
            'pemeriksaanIbu[nadi][value]' => 'required|regex_match[/^[0-9]+$/]',
            'pemeriksaanIbu[suhu][value]' => 'required|regex_match[/^[0-9]+(\.[0-9]+)?$/]',
            'pemeriksaanIbu[pernapasan][value]' => 'required|regex_match[/^[0-9]+$/]',
            'pemeriksaanIbu[golonganDarah][value]' => 'required|regex_match[/^[A-Z]+$/]',
            'pemeriksaanIbu[rhesus][value]' => 'required|regex_match[/^[+\-]$/]',
            'pemeriksaanIbu[mtStatus][value]' => 'regex_match[/^[a-zA-Z0-9\s]+$/]',
            'pemeriksaanIbu[mtDeskripsi][value]' => 'regex_match[/^[a-zA-Z0-9\s.,!?()\-]+$/]', // HARUS DIUBAH
            'pemeriksaanIbu[jenisMT][value]' => 'regex_match[/^[a-zA-Z0-9\s]+$/]',
        ];
        
        
    }
    public function setDataRequest($request)
    {
        $request = $request->post('pemeriksaanIbu');
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