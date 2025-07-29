<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestObstetriRepository implements RequestInterface
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
            'pemeriksaan[pasien_id]'         => 'required|alpha_numeric',
            'pemeriksaan[gravida]'           => 'required|integer',
            'pemeriksaan[partus]'            => 'required|integer',
            'pemeriksaan[abortus]'           => 'required|integer',
            'pemeriksaan[tanggal_tpht]'      => 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]', // Validasi tanggal YYYY-MM-DD
            'pemeriksaan[berat_badan]'       => 'required|numeric|greater_than[0]',
            'pemeriksaan[tinggi_badan]'      => 'required|numeric|greater_than[0]',
            'pemeriksaan[target_kenaikan]'   => 'required',
            'pemeriksaan[imt]'               => 'required|numeric',
            'pemeriksaan[status]'            => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaan[jarak_kehamilan]'   => 'required|integer|greater_than_equal_to[0]',
            'pemeriksaan[statusImunisasi]'   => 'required|regex_match[/^[a-zA-Z\s]+$/]',
            'pemeriksaan[loket_id]'          => 'required',
            'pemeriksaan[actv_service]'      => 'required',
            'pemeriksaan[start]'             => 'required'
        ];
        
    }

    public function setDataRequest($request)
    {
        return [
            'pasienId' => $request['pasien_id'], // Mengambil nilai dari $request
            'loketId' => $request['loket_id'],
            'actv_service' => $request['actv_service'],
            'id_dokter' => $request['id_dokter'],
            'start' => $request['start'],
            'gravida' => $request['gravida'],
            'partus' => $request['partus'],
            'abortus' => $request['abortus'],
            'tphtDate' => $request['tanggal_tpht'],
            'bbSebelumHamil' => $request['berat_badan'],
            'tinggiBadan' => $request['tinggi_badan'],
            'bb_target' => $request['target_kenaikan'],
            'imt' => $request['imt'],
            'status_imt' => $request['status'],
            'jarak_hamil' => $request['jarak_kehamilan'],
            'imunisasiTtStatus' => $request['statusImunisasi'],
        ];
    }

    public function setProtocol($request)
    {
        $rules = $this->rules();
        $this->validator->reset_validation();
        if(!empty($rules)) {
             foreach ($rules as $field => $rule) {
                 $this->validator->set_rules($field, ucfirst(str_replace('_', ' ', $field)), $rule);
             }
             
            if ($this->validator->run() == false) {
                $errors = $this->validator->error_array();
                throw new ServiceException('validation failed', 400, $errors);
            }
        }
       

        // Menjalankan validasi


        return $this->setDataRequest($request); // Memanggil setDataRequest dengan $this
    }
}