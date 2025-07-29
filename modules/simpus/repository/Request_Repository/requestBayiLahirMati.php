<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestBayiLahirMati implements RequestInterface
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
            'dataLahirMati[beratLahir][value]'             => 'required|numeric',
            'dataLahirMati[jenisTempatMeninggal][value]'   => 'required',
            'dataLahirMati[lamaTinggal][value]'            => 'required',
            'dataLahirMati[dugaanSebabKematianMati][value]' => 'required',
            'dataLahirMati[kelainanBawaan][value]'         => 'required',
            'dataLahirMati[caraPersalinan][value]'         => 'required',
            'dataLahirMati[umurIbu][value]'                => 'required|numeric',
            'dataLahirMati[jamKematian][value]'            => 'required',
            'dataLahirMati[tanggalKematian][value]'        => 'required',
            'dataLahirMati[maserasi][value]'               => 'required',
            'dataLahirMati[kondisiIbu][value]'             => 'required',
            'dataLahirMati[deskripsiKondisi][value]'       => 'required',
            'dataLahirMati[tempatMeninggal][value]'        => 'required',
            'dataLahirMati[jenisKematian][value]'          => 'required',
            'dataLahirMati[deskripsiLainya][value]'        => 'required',
            'dataLahirMati[alamatMeninggal][value]'        => 'required',
            'dataLahirMati[jenisKehamilan][value]'         => 'required',
            'dataLahirMati[usiaKehamilanLahirMati][value]' => 'required|numeric',
            'dataLahirMati[anakHidup][value]'              => 'required|numeric'
        ];
    }


    public function setDataRequest($request)
    {

        $request =  $request->post('dataLahirMati');
        $data =  [];
        if (!empty($data)) {
            return $data;
        } else {
            return $request;
        }
    }

    public function setProtocol($request)
    {
        // $rules = $this->rules();
        // if (!empty($rules)) {
        //     foreach ($rules as $field => $rule) {
        //         $this->validator->set_rules($field, ucfirst(str_replace('_', ' ', $field)), $rule);
        //     }
        //     // Menjalankan validasi
        //     if ($this->validator->run() == false) {
        //         $errors = $this->validator->error_array();
        //         throw new ServiceException('validation failed', 400, $errors);
        //     }
        // }
        return $this->setDataRequest($request); // Memanggil setDataRequest dengan $this
    }
}
