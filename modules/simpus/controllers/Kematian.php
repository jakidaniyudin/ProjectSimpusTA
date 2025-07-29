<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kematian extends CI_Controller {
	function __construct() 
	{	


		parent::__construct();

		$this->data = null;
		$this->data['message'] = $this->session->flashdata('message');

		$data['message'] = $this->session->flashdata('message');
		
		$this->load->model('kematian_model');	
		$this->load->model('simpus_model');	
		$this->load->model('master_model');
		$this->load->model('base_model');
		$this->template->set_template('template/admin');	
		if (!$this->ion_auth->logged_in())
		{		
			redirect('auth/login?continue='.urlencode(base_url().'simpus/loket'));								   
		}

		if(!$this->ion_auth->in_group(array('admin','loket','puskesmas'))){		
			$this->session->set_flashdata('message', 'Maaf, anda tidak berhak');						
			redirect('backend','refresh');					
		}			
	}

	public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;
    }


	function index()
	{
		
		redirect('simpus/kematian/form','refresh');	
	}

	public function ajax_list(){
		$list = $this->kematian_model->get_datatables();
		$data = array();
		$PPK=$this->base_model->pcare('KODE_PPK');
		
		$no = $_POST['start'];
		foreach ($list as $lis) {
			

					
			$no++;
			$row = array();
			$row[] = date("d-m-Y", strtotime($lis->tglKematian));
			$row[] = '<a type="button" target="_blank" class="btn btn-xs btn-info"  href="'.base_url().'simpus/pelayananDetail/popRiwayatSimpusID/'.$lis->ID.'">'.$lis->NO_MR.'</a>';
			$row[] = $lis->NAMA_LGKP.'  <strong>('.$lis->umur.')</strong>'.'<BR/>'.$lis->NIK;
			$row[] = $lis->ALAMAT.' RT '.$lis->NO_RT.' RW '.$lis->NO_RW.'<BR/>'.$lis->NAMA_KEC.'-'.$lis->NAMA_KEL;
			$row[] = $lis->noKartu;
			// $row[] = $lis->puskId;
			$row[] = '
			<a type="button" class="btn btn-xs btn-warning" href="'.base_url().'simpus/kematian/form_edit/'.$lis->pasienId.'/'.$lis->idCatatan.'"><i class="fa fa-edit"></i></a>
			<a type="button" class="btn btn-xs btn-danger" href="'.base_url().'simpus/kematian/hapus/'.$lis->idCatatan.'" onclick="return confirm(\'Yakin di Hapus ?\');"><i class="fa fa-close"></i></a>
						';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			//"recordsTotal" => $this->loket_model->count_all(),
			"recordsFiltered" => $this->kematian_model->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
				
		
	}

	function form($id_pasien = NULL,$id = NULL)
	{
		
		

		$year=date('Y');
		$data['message'] = $this->session->flashdata('message');
		$data['id_pasien'] = $id_pasien;
		$data['id'] = $id;

		if($id)
		{
			$data['item'] = $this->db->query('select * from simpus_catatan_kematian where idCatatan = "'.$id.'" ')->row();
		}
		else
		{
			$data['item'] = $this->base_model->get_field_table('simpus_catatan_kematian');	
		}

		$this->template->title = 'Form Kematian';
		$data['menu'] = 'Form Kematian';
		$data['tglKunj'] = $this->input->post('tglKunj');
		$this->template->description = '';		
		$this->template->meta->add('keyword', '');
		$this->template->content->view('simpus/kematian/v_form',  isset($data) ? $data : NULL);
		$this->template->publish();		
	}

	function form_edit($id_pasien = NULL,$id = NULL)
	{
		$year=date('Y');
		$data['message'] = $this->session->flashdata('message');
		$data['id_pasien'] = $id_pasien;
		$data['id'] = $id;
		$data['item'] = $this->db->query('SELECT sp.*,pk.`DESCRIP` AS NAMA_PKRJN,ag.`DESCRIP` AS DET_AGAMA,kec.NAMA_KEC,kel.NAMA_KEL,cat.* FROM simpus_pasien sp 
			LEFT JOIN simpus_catatan_kematian cat ON cat.`pasienId`=sp.`ID` 
LEFT JOIN pkrjn_master pk ON sp.`JENIS_PKRJN`=pk.`NO`
LEFT JOIN agama_master ag ON ag.`NO`=sp.`AGAMA`
LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP`
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` WHERE idCatatan='.$id.' LIMIT 1 ')->row();
		$this->template->title = 'Form Edit Kunjungan';
		$data['menu'] = 'Form Kematian';
		$this->template->description = '';		
		$this->template->meta->add('keyword', '');
		$this->template->content->view('simpus/kematian/v_form_update',  isset($data) ? $data : NULL);
		$this->template->publish();		
	}


	public function simpan()
	{	
	

		// $field = array_keys($_POST);			
		// $data = $this->fungsi->accept_data($field);

		$data['tglKematian']=date('Y-m-d', strtotime($this->input->post('tglKunjungan')));
		$data['jamKematian']=$this->input->post('jamKematian');
		$data['kdDiagnosa']=$this->input->post('kdDiagnosa');
		$data['nmDiagnosa']=$this->input->post('nmDiagnosa');
		$data['ketKematian']=$this->input->post('ketKematian');
		$data['pasienId']=$this->input->post('pasienId');
		$data['puskId'] = $this->ion_auth->unit();

		// tanggal lahir
		$tanggal = new DateTime($this->input->post('TGL_LHR'));
		// tanggal hari ini
		$today = new DateTime('today');
		// tahun
		$y = $today->diff($tanggal)->y;
		// bulan
		$m = $today->diff($tanggal)->m;
		// hari
		$d = $today->diff($tanggal)->d;

		if ($y==0) {
			if($m!=0){ 
				$kel_umur="3";
			}else{
				if (($d>=0)&&($d<=7)) {
					$kel_umur="1";
				}else if (($d>=8)&&($d<=28)) {
					$kel_umur="2";
				}
			}
		}else if (($y>=1)&&($y<=4)) {
			$kel_umur="4";
		}else if (($y>=5)&&($y<=9)) {
			$kel_umur="5";
		}else if (($y>=10)&&($y<=14)) {
			$kel_umur="6";
		}else if (($y>=15)&&($y<=19)) {
			$kel_umur="7";
		}else if (($y>=20)&&($y<=44)) {
			$kel_umur="8";
		}else if (($y>=45)&&($y<=54)) {
			$kel_umur="9";
		}else if (($y>=55)&&($y<=59)) {
			$kel_umur="10";
		}else if (($y>=60)&&($y<=69)) {
			$kel_umur="11";
		}else if ($y>=70){
			$kel_umur="12";
		}else if ($y<<0){
			$kel_umur="0";
		}

		
		$data['kelUmur']=$kel_umur;
		$data['umur']=$y;

		$data['createdBy']	= $this->session->userdata('username');				
		$this->db->insert('simpus_catatan_kematian',$data);


		//redirect('simpus/kematian/form','refresh');	
		$kirim['status'] = 'success';
		$kirim['message'] = 'ok';
		echo json_encode($kirim); 

	}

	public function update($id=null)
	{	

		$data['tglKematian']=date('Y-m-d', strtotime($this->input->post('tglKunjungan')));
		$data['jamKematian']=$this->input->post('jamKematian');
		$data['kdDiagnosa']=$this->input->post('kdDiagnosa');
		$data['nmDiagnosa']=$this->input->post('nmDiagnosa');
		$data['ketKematian']=$this->input->post('ketKematian');
		$data['pasienId']=$this->input->post('pasienId');
		$data['puskId'] = $this->ion_auth->unit();

		// tanggal lahir
		$tanggal = new DateTime($this->input->post('TGL_LHR'));
		// tanggal hari ini
		$today = new DateTime('today');
		// tahun
		$y = $today->diff($tanggal)->y;
		// bulan
		$m = $today->diff($tanggal)->m;
		// hari
		$d = $today->diff($tanggal)->d;

		if ($y==0) {
			if($m!=0){ 
				$kel_umur="3";
			}else{
				if (($d>=0)&&($d<=7)) {
					$kel_umur="1";
				}else if (($d>=8)&&($d<=28)) {
					$kel_umur="2";
				}
			}
		}else if (($y>=1)&&($y<=4)) {
			$kel_umur="4";
		}else if (($y>=5)&&($y<=9)) {
			$kel_umur="5";
		}else if (($y>=10)&&($y<=14)) {
			$kel_umur="6";
		}else if (($y>=15)&&($y<=19)) {
			$kel_umur="7";
		}else if (($y>=20)&&($y<=44)) {
			$kel_umur="8";
		}else if (($y>=45)&&($y<=54)) {
			$kel_umur="9";
		}else if (($y>=55)&&($y<=59)) {
			$kel_umur="10";
		}else if (($y>=60)&&($y<=69)) {
			$kel_umur="11";
		}else if ($y>=70){
			$kel_umur="12";
		}else if ($y<<0){
			$kel_umur="0";
		}

		
		$data['kelUmur']=$kel_umur;
		$data['umur']=$y;

		$data['modifiedDate'] = date('Y-m-d H:i:s', strtotime('NOW'));
		$data['modifiedBy']	= 	$this->session->userdata('username');
		$this->db->where('idCatatan',$id);
		$this->db->update('simpus_catatan_kematian',$data);

			$kirim['status'] = 'done';
			$kirim['message'] = 'update';
			echo json_encode($kirim);
	}

	public function hapus($id)
	{
		$this->db->delete('simpus_catatan_kematian', array('idCatatan' => $id));
		redirect('simpus/kematian/form','refresh');		
	}

	

	function lap_cat_kematian($is_html,$unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa)
	{
		$this->template->title = 'LAPORAN CATATAN KEMATIAN';
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['is_html'] = $is_html;
		$data['unit_details'] = $unit_details;
		$data['unit']=$unit;

		if($unit != '0')
			$data['kategori_unit'] = $this->simpus_model->get_kategori_unit($unit)->row();
		else
			$data['kategori_unit'] = $unit;
		
		if($unit_details != '0')
		{
			$data['unit_detailsx'] = $this->simpus_model->get_unit_details($unit_details)->row();
		}
		else{
			$data['unit_detailsx'] = $unit_details;
		}	
		$data['ttd'] = $this->base_model->get_ttd($unit_details)->row();
		$data['items'] = $this->kematian_model->lapRawatJalanPoli($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa)->result();
		
		$data['menu'] = 'laporan';
		$this->load->view('laporan/kematian/v_lapCatKem',$data);
	}


}