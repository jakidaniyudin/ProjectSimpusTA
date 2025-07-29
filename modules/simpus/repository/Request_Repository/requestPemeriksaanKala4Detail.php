<?php


require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestPemeriksaanKala4Detail implements RequestInterface
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
            // Waktu ke-1
            'dataKala4Detail[waktuKe1][value][nadi]'             => 'required|numeric',
            'dataKala4Detail[waktuKe1][value][waktu]'            => 'required',
            'dataKala4Detail[waktuKe1][value][pendarahan]'       => 'required|numeric',
            'dataKala4Detail[waktuKe1][value][kandungKemih]'     => 'required',
            'dataKala4Detail[waktuKe1][value][tekananDarah]'     => 'required|numeric',
            'dataKala4Detail[waktuKe1][value][tinggiFundus]'     => 'required|numeric',
            'dataKala4Detail[waktuKe1][value][kontraksiUterus]'  => 'required',
            // Waktu ke-2
            'dataKala4Detail[waktuKe2][value][nadi]'             => 'required|numeric',
            'dataKala4Detail[waktuKe2][value][waktu]'            => 'required',
            'dataKala4Detail[waktuKe2][value][pendarahan]'       => 'required|numeric',
            'dataKala4Detail[waktuKe2][value][kandungKemih]'     => 'required',
            'dataKala4Detail[waktuKe2][value][tekananDarah]'     => 'required|numeric',
            'dataKala4Detail[waktuKe2][value][tinggiFundus]'     => 'required|numeric',
            'dataKala4Detail[waktuKe2][value][kontraksiUterus]'  => 'required',
            // Waktu ke-3
            'dataKala4Detail[waktuKe3][value][nadi]'             => 'required|numeric',
            'dataKala4Detail[waktuKe3][value][waktu]'            => 'required',
            'dataKala4Detail[waktuKe3][value][pendarahan]'       => 'required|numeric',
            'dataKala4Detail[waktuKe3][value][kandungKemih]'     => 'required',
            'dataKala4Detail[waktuKe3][value][tekananDarah]'     => 'required|numeric',
            'dataKala4Detail[waktuKe3][value][tinggiFundus]'     => 'required|numeric',
            'dataKala4Detail[waktuKe3][value][kontraksiUterus]'  => 'required',
        ];
    }

    public function setDataRequest($request)
    {

        $request =  $request->post('dataKala4Detail');
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