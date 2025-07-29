<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestKematianIbu implements RequestInterface
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
            'KematianIbu[tempatMeninggal][value]'         => 'required',
            'KematianIbu[masaKematian][value]'            => 'required',
            'KematianIbu[periodeNifas][value]'            => 'required|numeric',
            'KematianIbu[usiaKehamilan][value]'           => 'required|numeric',
            'KematianIbu[partus][value]'                  => 'required|numeric',
            'KematianIbu[tanggalMeninggal][value]'        => 'required',
            'KematianIbu[year][value]'                    => 'required|numeric',
            'KematianIbu[jenisTempatMeninggal][value]'    => 'required',
            'KematianIbu[waktuMeninggal][value]'          => 'required',
            'KematianIbu[dugaanSebabKematian][value]'     => 'required',
            'KematianIbu[abortus][value]'                 => 'required|numeric',
            'KematianIbu[gravida][value]'                 => 'required|numeric',
            'KematianIbu[deskripsiLainya][value]'         => 'required',
            'KematianIbu[alamatKematian][value]'          => 'required',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('KematianIbu');
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
