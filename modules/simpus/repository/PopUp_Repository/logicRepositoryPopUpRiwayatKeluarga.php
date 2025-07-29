<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/interfacePopUp.php');

class  logicRepositoryPopUpRiwayatKeluarga implements interfacePopUp{

    protected $CI;
    public function __construct(){
        $this->CI =  &get_instance();
        $this->CI->load->model('MasterRiwayat_model');

    }
    public function load_popup($n = null, $propertis=null){
        $data['n'] = $n;
        return  $this->CI->load->view('simpus/pop/v_riwayat', $data);
    }

    public function list($propertis = null){
        // mengambil parameter post
        $length = $this->CI->input->post('length');
        $start = $this->CI->input->post('start');
        $search = $this->CI->input->post('search')['value'] ?? null;

    


        // ambil data dari model
        $list= $this->CI->MasterRiwayat_model->get($length, $start, $search);
        
        // menyiapakan data untuk dikirim
        $data = array_map(function($riwayat){
            return[
                $riwayat->code, // kolom code
                $riwayat->value_set, // kolom value
                '<a class="btn btn-xs btn-info" onclick="pilihRiwayat(\'' . $riwayat->code . '\', \'' . $riwayat->value_set . '\',\'' . $riwayat->codesystem . '\',\'' . $riwayat->source_of_code . '\')">Pilih</a>' // kolom action
            ];
        }, $list);

    
        $output = array(
            "draw" => $this->CI->input->post('draw'), // Nomor draw (untuk sinkronisasi)
            "recordsTotal" => $this->CI->MasterRiwayat_model->count_all(), // Total data tanpa filter
            "recordsFiltered" => $this->CI->MasterRiwayat_model->count_filtered($search), // Total data setelah filter
            "data" => $data // Data yang akan ditampilkan
        );

        // Output dalam format JSON
        echo json_encode($output);
    }

}
