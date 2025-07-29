<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/interfacePopUp.php');

class  LogicRepositoryPopUpDugaanSebabKematian implements interfacePopUp
{

    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('diagnosa_model');
    }
    public function load_popup($n = null, $propertis = null)
    {
        $data['n'] = $n;
        $data['propertis'] = $propertis;
        return  $this->CI->load->view('simpus/pop/v_dugaanSebabKematian', $data);
    }

    public function list($propertis = null)
    {
        // mengambil parameter post
        $length = $this->CI->input->post('length');
        $start = $this->CI->input->post('start');
        $search = $this->CI->input->post('search')['value'] ?? null;
        $codeFormId =  $this->CI->input->post('codeFormId');
        $codeFormDisplay = $this->CI->input->post('codeFormDisplay');
        $list = $this->CI->diagnosa_model->get_datatables();
        $data = array();
        $no = $start;
        foreach ($list as $lis) {

            $nmDiag = preg_replace("/[']/", '', $lis->nmDiag);
            $no++;
            $row = array();
            $row[] = $lis->kdDiag;
            $row[] = $nmDiag;
            if ($lis->non_spes == '1') {
                $row[] = 'Non Spesial';
            } else {
                $row[] = '';
            }
            $row[] = '<span class="btn btn-xs btn-info" onclick="pilihDiag(\'' . $lis->kdDiag . '\',\'' . $nmDiag . '\',\'' . $codeFormId . '\',\'' . $codeFormDisplay . '\')">Pilih</a>';
            $data[] = $row;
        }


        $output = array(
            "q" => $this->CI->db->last_query(),
            "draw" => $this->CI->input->post('draw'),
            "recordsTotal" => $this->CI->diagnosa_model->count_all(),
            "recordsFiltered" => $this->CI->diagnosa_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}