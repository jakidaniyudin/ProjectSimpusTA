<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestBayiLahirHidup implements RequestInterface
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
            'dataLahirHidup[codeDugaanKematianHidup][value]'         => 'required',
            'dataLahirHidup[tanggalKematianHidup][value]'            => 'required',
            'dataLahirHidup[usiaSaatMeninggal][value]'               => 'required|numeric',
            'dataLahirHidup[beratLahirHidup][value]'                 => 'required|numeric',
            'dataLahirHidup[janinMeninggalHidupBayiKembar][value]'   => 'required',
            'dataLahirHidup[usiaKehamilan][value]'                   => 'required|numeric',
            'dataLahirHidup[jenisTempatBersalin][value]'             => 'required',
            'dataLahirHidup[partus][value]'                          => 'required|numeric',
            'dataLahirHidup[caraPersalinanHidup][value]'             => 'required',
            'dataLahirHidup[lingkarKepala][value]'                   => 'required|numeric',
            'dataLahirHidup[jamKematianHidup][value]'                => 'required',
            'dataLahirHidup[panjangSaatMeninggal][value]'            => 'required|numeric',
            'dataLahirHidup[jenisKematianHidup][value]'              => 'required',
            'dataLahirHidup[abortus][value]'                         => 'required|numeric',
            'dataLahirHidup[jumlahAnakHidup][value]'                 => 'required|numeric',
            'dataLahirHidup[beratSaatMeninggal][value]'              => 'required|numeric',
            'dataLahirHidup[kelainanBawaanHidup][value]'             => 'required',
            'dataLahirHidup[jenisTempatMeninggalHidup][value]'       => 'required',
            'dataLahirHidup[gravida][value]'                         => 'required|numeric',
            'dataLahirHidup[jenisKehamilan][value]'                  => 'required',
            'dataLahirHidup[lokasiKematian][value]'                  => 'required',
            'dataLahirHidup[alamatKematian][value]'                  => 'required',
            'dataLahirHidup[dugaanKematianHidup][value]'             => 'required',
        ];
    }


    public function setDataRequest($request)
    {

        $request =  $request->post('dataLahirHidup');
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