<?php

require_once(APPPATH . 'modules/simpus/interfaces/RequestInterface.php');

class requestRiwayatPemantauanRepository implements RequestInterface
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
            'pemantauanData[terlalu_mudah][value]'    => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[terlalu_rapat][value]'    => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[terlalu_tua][value]'      => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[sering_melahirkan][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[kdDiagnosa][value]' => 'required',
            'pemantauanData[nmDiagnosa][value]' => 'required',
            'pemantauanData[komplikasi][value]' => 'required|trim|max_length[100]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[sumber_penyakit_menular][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[deskripsi_penyakit_menular][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[sumber_penyakit_keluarga][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[deskripsi_penyakit_keluarga][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[status_merokok][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[codeKeluarga][value]' => 'required',
            'pemantauanData[codePribadi][value]' => 'required',
            'pemantauanData[codeSystemKeluarga][value]' => 'required',
            'pemantauanData[codeSystemPribadi][value]' => 'required',
            'pemantauanData[valueSetKeluarga][value]' => 'required',
            'pemantauanData[valueSetPribadi][value]' => 'required',
            'pemantauanData[sourceOfCodeKeluarga][value]' => 'required',
            'pemantauanData[sourceOfCodePribadi][value]' => 'required',
            'pemantauanData[deskripsi_merokok][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[status_disabilitas][value]' => 'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[deskripsi_disabilitas][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[kelas_ibu_hamil][value]' =>  'required|trim|max_length[10]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]',
            'pemantauanData[deskripsi_kelas_ibu_hamil][value]' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9\s.,!?()-]+$/]'
        ];
    }

    public function setDataRequest($request)
    {
        $request = $request->post('pemantauanData');
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