<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpus_model extends CI_Model {

	function get_poli_fktp($jenis = NULL)
	{
		if($jenis == 'true'){
			$where = "where poliSakit = 'TRUE' and active=1";
		}elseif($jenis == 'false'){
			$where = "where poliSakit = 'FALSE' and active=1";
		}else{
			$where = '';
		}
		
		
		
		$K=$this->db->query("select * from simpus_poli_fktp ".$where." order by id ASC");

		foreach ($K->result_array() as $row)
		{
			$data[$row['kdPoli']] = $row['nmPoli'];
		}

		$K->free_result();
		return $data;
	}
	function get_tenagaMedis()
	{
		$pusk_id = $this->ion_auth->unit();
		$data['0']='- pilih -';
		$K = $this->db->query("SELECT * FROM master_dokter a WHERE (a.profesi_id='19' OR a.profesi_id='20')AND a.aktif='1'");
		
		foreach ($K->result_array() as $row) {
			$data[$row['kdDokter']] = $row['nmDokter'];
		}

		$K->free_result();
		return $data;
	}

	function get_poli_fktpx($kdPoli = NULL)
	{
		$sql=$this->db->query("select * from simpus_poli_fktp where kdPoli=".$kdPoli." order by id ASC");
		
		return $sql;
	} 
	
	function get_cont_fktp($jenis = NULL)
	{
		if($jenis == 'true'){
			$where = "where poliSakit = 'TRUE'";
		}elseif($jenis == 'false'){
			$where = "where poliSakit = 'FALSE'";
		}else{
			$where = '';
		}
		
		
		
		$K=$this->db->query("select * from simpus_poli_fktp ".$where." order by id ASC");
		
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdPoli']] = $row['nmController'];
		}

		$K->free_result();
		return $data;
	}



	function get_rujuk_fktp($jenis = NULL)
	{
		if($jenis == 'true'){
			$where = "where rujukIntern = 'TRUE'";
		}elseif($jenis == 'false'){
			$where = "where rujukIntern = 'FALSE'";
		}else{
			$where = '';
		}
		
		
		
		$K=$this->db->query("select * from simpus_poli_fktp ".$where." order by id ASC");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdPoli']] = $row['nmPoli'];
		}

		$K->free_result();
		return $data;
	} 

	function get_poli_fktl()
	{

		
		$K=$this->db->query("select * from simpus_poli_fktl");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdPoli']] = $row['nmPoli'];
		}

		$K->free_result();
		return $data;
	}  
	
	function get_diagnosa()
	{
		$K=$this->db->query("select * from simpus_diagnosa");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdDiag']] = $row['nmDiag'];
		}

		$K->free_result();
		return $data;
	}  	

	function get_kesadaran()
	{
		$K=$this->db->query("select * from simpus_kesadaran");
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdSadar']] = $row['nmSadar'];
		}

		$K->free_result();
		return $data;
	}  		
	
	function get_statuspulang()
	{
		$K=$this->db->query("select * from simpus_statuspulang where rawatInap='false' order by nmStatusPulang asc");
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdStatusPulang']] = $row['nmStatusPulang'];
		}

		$K->free_result();
		return $data;
	}

	function get_kdTacc()
	{
		
		$K = $this->db->query("SELECT * FROM master_tacc ");
		//$data[''] = '';
		foreach ($K->result_array() as $row) {
			$data[$row['kdTacc']] = $row['nmTacc'];
		}

		$K->free_result();
		return $data;
	}

	function get_dataDiagnosa($id)
	{
		
		$K = $this->db->query("SELECT * FROM simpus_data_diagnosa a where a.pelayananId='".$id."' ");
		$data[''] = '';
		foreach ($K->result_array() as $row) {
			$data[$row['kdDiagnosa'].' - '.$row['nmDiagnosa']] =  $row['kdDiagnosa'].' - '.$row['nmDiagnosa'];
		}

		$K->free_result();
		return $data;
	}

	function get_alasanTacc($kdTacc)
	{
		
		$K = $this->db->query("SELECT * FROM tacc_alasan a where a.kdTacc='".$kdTacc."' ");
		//$data[''] = '';
		foreach ($K->result_array() as $row) {
			$data[$row['nmAlasan']] = $row['nmAlasan'];
		}

		$K->free_result();
		return $data;
	}

	function get_ranap_pulang()
	{
		$K=$this->db->query("select * from simpus_ranap_status");
		foreach ($K->result_array() as $row)
		{
			$data[$row['id']] = $row['status'];
		}

		$K->free_result();
		return $data;
	}

	function get_statuspulang_ranap()
	{
		$K=$this->db->query("select * from simpus_statuspulang order by kdStatusPulang asc");
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdStatusPulang']] = $row['nmStatusPulang'];
		}

		$K->free_result();
		return $data;
	}    		
	
	function get_dokter()
	{
		$pusk_id=$this->ion_auth->unit();
		$K=$this->db->query("select * from simpus_dokter where pusk_id='".$pusk_id."'");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdDokter']] = $row['nmDokter'];
		}

		$K->free_result();
		return $data;
	} 
	function get_tenagaMedisAskep()
	{
		$pusk_id = $this->ion_auth->unit();
		$K = $this->db->query("SELECT * FROM master_dokter a WHERE profesi_id NOT IN ('19','20') AND a.aktif='1'");
		$data[''] = '';
		foreach ($K->result_array() as $row) {
			$data[$row['kdDokter']] = $row['nmDokter'];
		}

		$K->free_result();
		return $data;
	}	
	
	function get_provider()
	{
		$K=$this->db->query("select * from simpus_provider");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdProvider']] = $row['nmProvider'];
		}

		$K->free_result();
		return $data;
	} 
	function get_surat()
	{
		
		$K=$this->db->query("SELECT * FROM surat_master a ORDER BY a.ID_JNS_SURAT ASC");
		$data[''] = '';
		foreach ($K->result_array() as $row)
		{
			$data[$row['ID_JNS_SURAT']] = $row['SURAT'];
		}

		$K->free_result();
		return $data;
	}

	function get_imunisasi_vaksin()
	{
		$K=$this->db->query("select * from master_imunisasi_vaksin");
		foreach ($K->result_array() as $row)
		{
			$data[$row['id_imunisasi']] = $row['nama_imunisasi'];
		}

		$K->free_result();
		return $data;
	}  

	function getDataPasien($no_mr)
	{
		$query=$this->db->query("SELECT sp.NO_MR,DATE(sp.created) AS TGL_REG,NIK,sp.noKartu AS NO_BPJS,PUSK_ID,NIK,NAMA_LGKP,JENIS_KLMIN,ALAMAT,NO_PROP,NO_KAB,NO_KEL,NO_KEC,TGL_LHR FROM simpus_pasien sp
			WHERE sp.no_mr='".$no_mr."'");
		return $query;
	}  

	function getRiwayatPasienSimpusLama($no_mr)
	{
		$query=$this->db->query("SELECT sk.tglKunjungan,up.nama_unit,poli.nmPoli,poliInternal.nmPoli AS poliInternal,sk.kdProviderRujukLanjut,diagnosa1,sk.nmdiagnosa1,diagnosa2,sk.nmdiagnosa2,diagnosa3,sk.nmdiagnosa3,sk.diastole,sk.sistole,sk.heartRate,sk.respRate,sk.keluhan,sk.nmtindakan1,sk.nmtindakan2,sk.nmtindakan3,sk.nmtindakan4,sk.nmtindakan5,terapi,tinggiBadan,beratBadan
			FROM simpus_pasien sp
			INNER JOIN simpus_kunjungan sk ON sp.ID=sk.pasien_id
			LEFT JOIN data_master_unit_detail up ON up.id_detail=sk.id_unit
			INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sk.kdPoli 
			LEFT JOIN simpus_poli_fktp poliInternal ON poliInternal.kdPoli=sk.kdPoliRujukInternal
			WHERE sp.NO_MR='".$no_mr."';");
		return $query;
	}
	
	function getRiwayatPasienSimpus($no_mr)
	{
		$query=$this->db->query("SELECT sl.idLoket,sl.tglKunjungan,up.nama_unit,
			sa.tinggiBadan,sa.beratBadan,sa.sistole,sa.diastole,sa.heartRate,sa.respRate,
			sl.keluhan,sa.terapi
			FROM simpus_pasien sp
			INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
			LEFT JOIN data_master_unit_detail up ON up.id_detail=sl.unitId
			LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
			WHERE sp.NO_MR=".$no_mr.";");
		return $query;
	}

	function getRiwayatPasienDiag($idLoket)
	{
		$query=$this->db->query("SELECT sd.kdDiagnosa,sd.nmDiagnosa,keterangan FROM simpus_data_diagnosa sd WHERE sd.loketId='".$idLoket."';");
		return $query;
	}
	function getRiwayatPasienTind($idLoket)
	{
		$query=$this->db->query("SELECT kdTindakan,nmTindakan,keterangan,ketGigi,deskripsi FROM simpus_tindakan st WHERE st.loketId='".$idLoket."'  and deskripsi ='icd9cm' order by idPelayanan asc;");
		return $query;
	}
	function getRiwayatPasienTindLab($idLoket)
	{
		$query=$this->db->query("SELECT kdTindakan,nmTindakan,nilaiLab,sm.satuan,sm.nilaiKritis,sm.nilaiNormal,keterangan,deskripsi 
			FROM simpus_tindakan st 
			LEFT JOIN simpus_master_pemeriksaan_lab sm 
			ON sm.kode=st.kdTindakan WHERE st.loketId='".$idLoket."'  and permohonanId <> '' order by idPelayanan asc;");
		return $query;
	}
	function getRiwayatPasienPoli($idLoket)
	{
		$query=$this->db->query("SELECT b.kdPoli,b.nmPoli ,pul.nmStatusPulang,a.tujuanPoli
			FROM simpus_pelayanan a 
			INNER JOIN simpus_poli_fktp b ON a.kdPoli=b.kdPoli 
			left join simpus_statuspulang pul on pul.kdStatusPulang=a.kdStatusPulang
			WHERE a.loketId='".$idLoket."';");
		return $query;
	}
	function getRiwayatPasienObat($idLoket)
	{
		$query=$this->db->query("SELECT * FROM simpus_resep_obat po WHERE po.loketId='".$idLoket."';");
		return $query;
	}
	// database simpus cloud
	
	function getRiwayatPasienDiagCloud($idLoket)
	{
		$query=$this->db_simpus_cloud->query("SELECT sd.kdDiagnosa,sd.nmDiagnosa,keterangan FROM simpus_data_diagnosa sd WHERE sd.loketId='".$idLoket."';");
		return $query;
	}
	function getRiwayatPasienTindCloud($idLoket)
	{
		$query=$this->db_simpus_cloud->query("SELECT kdTindakan,nmTindakan FROM simpus_tindakan st WHERE st.loketId='".$idLoket."';");
		return $query;
	}
	function getRiwayatPasienPoliCloud($idLoket)
	{
		$query=$this->db_simpus_cloud->query("SELECT b.kdPoli,b.nmPoli ,pul.nmStatusPulang,a.tujuanPoli
			FROM simpus_pelayanan a 
			INNER JOIN simpus_poli_fktp b ON a.kdPoli=b.kdPoli 
			left join simpus_statuspulang pul on pul.kdStatusPulang=a.kdStatusPulang
			WHERE a.loketId=".$idLoket.";");
		return $query;
	}
	function getRiwayatPasienObatCloud($idLoket)
	{
		$query=$this->db_simpus_cloud->query("SELECT po.nama_obat,po.jumlah,po.dosis_pakai FROM simpus_pakai_obat po WHERE po.loketId='".$idLoket."';");
		return $query;
	}

	//end database simpus cloud

	public function get_kategori_unit($unit)
	{
		$sql = "SELECT * FROM data_master_unit WHERE id_kategori = '".$unit."'";
		$query=$this->db->query($sql);
		return $query;
	}

	public function get_polis($poli)
	{
		$sql = "SELECT * FROM simpus_poli_fktp a WHERE a.kdPoli= '".$poli."'";
		$query=$this->db->query($sql);
		return $query;
	}

	public function get_unit_details($unit_details)
	{
		$sql = "SELECT nama_unit FROM data_master_unit_detail WHERE id_detail= '".$unit_details."'";
		$query=$this->db->query($sql);
		return $query;
	}

	public function getRujukan($noKartu,$tglKunjungan,$kd)
	{
		$query=$this->db->query("SELECT sk.pasien_id, p.ID,p.kdProvider,u.first_name, p.NAMA_LGKP, p.NO_KAB, kab.NAMA_KAB, p.noKartu, p.JENIS_KLMIN, p.TGL_LHR,
			sk.kdPoliRujukLanjut, spl.nmPoli, sk.kdProviderRujukLanjut, sp.nmProvider, sk.created_by,
			sk.diagnosa1, sk.nmdiagnosa1, sk.diagnosa2, sk.nmdiagnosa2,sk.diagnosa3,sk.nmdiagnosa3,  p.STAT_HBKEL,sk.kdDokter,sd.nmDokter
			FROM simpus_kunjungan sk 
			INNER JOIN simpus_pasien p ON sk.pasien_id=p.ID
			LEFT JOIN users u ON sk.pusk_id= u.unit
			LEFT JOIN setup_kab kab ON p.NO_PROP=kab.NO_PROP AND p.NO_KAB=kab.NO_KAB 
			LEFT JOIN simpus_provider sp ON sk.kdProviderRujukLanjut=sp.kdProvider 
			LEFT JOIN simpus_poli_fktl spl ON sk.kdPoliRujukLanjut=spl.kdPoli
			LEFT JOIN simpus_dokter sd ON sd.kdDokter=sk.kdDokter  
			WHERE sk.noKartu='".$noKartu."' AND sk.tglKunjungan='".$tglKunjungan."' AND sk.kdProviderRujukLanjut='".$kd."'");
		return $query;
	}
	public function getUnit($id_unit)
	{
		$this->db->select('id_detail,id_unit,nama_unit');
		$this->db->from('data_master_unit_detail as a');
		$this->db->where('a.id_detail',$id_unit);

		$query = $this->db->get();
		return $query;
	}
	public function getStokUnit($id_unit,$tglKunjungan)
	{
		$tahun=date('Y',strtotime($tglKunjungan));

		$this->db->select("ID_STOK_UNIT,b.OBAT_ID,b.KODE_OBAT,b.NAMA,b.SATUAN,b.SUMBER,b.HARGA,b.TAHUN,b.REK, a.JUMLAH");
		$this->db->from("simpus_obat_stok_unit a");
		$this->db->join("simpus_master_obat b","b.OBAT_ID=a.obat_id","inner");
		$this->db->where("YEAR(tanggal)",$tahun);
		$this->db->where("unit_details",$id_unit);

		$this->db->where('a.tanggal >=',$tahun.'-01-01');
		$this->db->where('a.tanggal <=',$tglKunjungan);
		$query = $this->db->get();
       // echo $this->db->last_query();
		return $query;

	}
	public function getDataSurat($id_surat)
	{
		$pusk_id=$this->ion_auth->unit();
		$query=$this->db->query("SELECT 
			sm.ID_JNS_SURAT,sm.SURAT,sur.no_surat,sp.NAMA_LGKP,sp.TMPT_LHR,sp.TGL_LHR,am.DESCRIP as agama,ker.DESCRIP as pekerjaan,sp.ALAMAT,kec.NAMA_KEC,
			kel.NAMA_KEL,sp.NO_RT,sp.NO_RW,
			sur.keperluan,sk.respRate,sk.heartRate,sk.tinggiBadan,sk.beratBadan,sur.mata_ka_ki,sur.telinga_ka_ki,sur.test_buta_warna,keterangan,sd.nmDokter,hasil_pemeriksaan,tgl_ijin_awal,tgl_ijin_akhir,tgl_kematian,jam_kematian,datediff(tgl_ijin_akhir, tgl_ijin_awal) +1 as selisih FROM surat_keterangan sur 
			INNER JOIN surat_master sm ON sur.id_jns_surat=sm.ID_JNS_SURAT
			INNER JOIN simpus_kunjungan sk ON sk.id=sur.id_kunjungan
			INNER JOIN simpus_pasien sp ON sp.id=sk.pasien_id 
			LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC
			LEFT JOIN setup_kel kel ON kel.NO_KEL=sp.NO_KEL AND kel.NO_KEC=kec.NO_KEC
			LEFT JOIN pkrjn_master ker ON ker.NO=sp.JENIS_PKRJN
			LEFT JOIN agama_master am ON am.NO=sp.AGAMA
			LEFT JOIN simpus_dokter sd ON sd.kdDokter=sk.kdDokter
			WHERE kec.NO_PROP='35' AND kel.NO_PROP='35'
			AND kec.no_kab='10' AND kel.NO_KAB='10'
			AND sur.id_surat='".$id_surat."'
			AND sd.PUSK_ID='".$pusk_id."' ;");
		return $query;

	}
	public function getDataSuratRujukan($id_surat)
	{
		$pusk_id=$this->ion_auth->unit();
		$query=$this->db->query("SELECT 
			sp.NO_MR,sur.no_surat,sp.NAMA_LGKP,sp.TMPT_LHR,sp.TGL_LHR,am.DESCRIP as agama,ker.DESCRIP as pekerjaan,sp.ALAMAT,kec.NAMA_KEC,
			kel.NAMA_KEL,sp.NO_RT,sp.NO_RW,poli.nmPoli,prov.nmProvider,sk.kdSadar,sk.keluhan,sk.sistole,sk.diastole,sk.respRate,sk.heartRate,sur.NO_HP,
			sk.diagnosa1,sk.nmdiagnosa1,sk.diagnosa2,sk.nmdiagnosa2,sk.diagnosa3,sk.nmdiagnosa3,sk.terapi,nmDokter,UMUR
			FROM surat_rujukan sur 
			INNER JOIN simpus_kunjungan sk ON sk.id=sur.id_kunjungan
			INNER JOIN simpus_pasien sp ON sp.id=sk.pasien_id 
			LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC
			LEFT JOIN setup_kel kel ON kel.NO_KEL=sp.NO_KEL AND kel.NO_KEC=kec.NO_KEC
			LEFT JOIN pkrjn_master ker ON ker.NO=sp.JENIS_PKRJN
			LEFT JOIN agama_master am ON am.NO=sp.AGAMA
			LEFT JOIN simpus_dokter sd ON sd.kdDokter=sk.kdDokter
			left join simpus_poli_fktl poli on poli.kdPoli=sk.kdPoliRujukLanjut
			left join simpus_provider prov on prov.kdProvider=sk.kdProviderRujukLanjut
			WHERE kec.NO_PROP='35' AND kel.NO_PROP='35'
			AND kec.no_kab='10' AND kel.NO_KAB='10'
			AND sur.id_surat_rujukan='".$id_surat."'
			AND sd.PUSK_ID='".$pusk_id."' ;");
		return $query;

	}
	public function getProfil()
	{
		$pusk_id=$this->ion_auth->unit();
		$query=$this->db->query("SELECT * FROM unit_profiles WHERE unit_id='".$pusk_id."';");
		return $query;

	}

	function get_kegiatan($kdPolinya=NULL)
	{

		 
		$K=$this->db->query("select * from simpus_master_mal where kdPoli='".$kdPolinya."'");
		$data['0'] = ' ';
		foreach ($K->result_array() as $row)
		{
			$data[$row['idMal']] = $row['nmMal'];
		}

		$K->free_result();
		return $data;
	}
	function get_sub_poli($kdPolinya=NULL)
	{

		
		$K=$this->db->query("select * from simpus_poli_tujuan where kdPoli='".$kdPolinya."'");
		foreach ($K->result_array() as $row)
		{
			$data[$row['kdSubPoli']] = $row['nmSubPoli'];
		}

		$K->free_result();
		return $data;
	}
	function get_kegiatanx($kdPolinya = NULL,$kdKegiatannya=NULL)
	{
		$sql=$this->db->query("select * from simpus_master_mal where kdPoli=".$kdPolinya." and idMal=".$kdKegiatannya."");
		
		return $sql;
	} 
	//newscript
	function get_alergi($category,$kode=null)
	{	
		
		$K=$this->db->query("select * from master_alergi where category = '".$category."' and status='1' order by kodeBpjs");
		foreach ($K->result_array() as $row)
		{
			$data[$row['kodeSatuSehat']] = $row['namaAlergiBpjs'];
		}

		$K->free_result();
		return $data;
	}  	 

}