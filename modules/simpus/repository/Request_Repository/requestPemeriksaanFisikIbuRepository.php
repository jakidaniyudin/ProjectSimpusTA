<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanFisikIbuRepository implements RequestInterface
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
            'pemeriksaanFisikIbu[konjungtiva][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiKonjungtiva][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[sklera][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiSklera][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[leher][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiLeher][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[gigiMulut][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiGigiMulut][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[tungkai][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiTungkai][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[tht][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiTHT][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[dadaJantung][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiDadaJantung][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[deskripsiDadaParu][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemeriksaanFisikIbu[perut][value]' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaanFisikIbu[deskripsiPerut][value]' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]'
        ];
    }
    public function setDataRequest($request)
    {
        $request = $request->post('pemeriksaanFisikIbu');
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