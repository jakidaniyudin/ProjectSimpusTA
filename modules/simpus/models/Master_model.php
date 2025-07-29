<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{

	public function getId()
	{
		$user_id = $this->session->userdata('user_id');
		$this->id = $this->db->query("SELECT unit FROM users WHERE id='" . $user_id . "'")->row('unit');
		return $this->id;
	}
	//new
	function get_profesi_nakes()
	{
		$K = $this->db->query("SELECT id_profesi,UPPER(nama_profesi) as nama_profesi FROM nakes_profesi where aktif='1' order by nama_profesi asc;");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_profesi']] = $row['nama_profesi'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_data_sdm()
	{
		$sql = "SELECT md.*, prop.nama_prop,kab.nama_kab,kec.nama_kec,kel.nama_kel,np.nama_profesi
		FROM master_dokter md
		LEFT JOIN nakes_profesi np ON md.profesi_id=np.id_profesi
		LEFT JOIN setup_prop prop ON prop.NO_PROP=md.no_prop
		LEFT JOIN setup_kab kab ON kab.NO_PROP=prop.NO_PROP AND kab.NO_KAB=md.no_kab
		LEFT JOIN setup_kec kec ON kec.NO_PROP=prop.NO_PROP AND kec.NO_KAB=kab.NO_KAB AND kec.NO_KEC=md.no_kec
		LEFT JOIN setup_kel kel ON kel.NO_PROP=prop.NO_PROP AND kel.NO_KAB=kab.NO_KAB AND kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=md.no_kel
		ORDER by md.nmDokter asc
		;
		";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_data_sdm_by_id($idDokter)
	{
		$sql = "SELECT * FROM master_dokter where idDokter='" . $idDokter . "' ";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_data_unit_by_id($id_detail)
	{
		$sql = "SELECT * FROM `data_master_unit_detail` WHERE id_detail='".$id_detail."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_master_obat()
	{

		$sql = "SELECT * FROM simpus_master_obat ORDER BY NAMA ASC";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_master_tindakan()
	{

		$sql = "SELECT kat.`kategori`,TINDAKAN,NILAI,KETERANGAN FROM master_tindakan2 tin 
		INNER JOIN master_kategori_tindakan kat ON tin.`id_kategori`=kat.`id_kategori`";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_kategori()
	{

		$sql = "SELECT * from master_kategori_tindakan";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_list_tindakan_by_id_kategori($id_kategori)
	{
		$sql = "select * from master_tindakan2 where id_kategori ='" . $id_kategori . "' ";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_header_lab()
	{
		
		$K = $this->db->query("select * from simpus_master_header_lab where status='1'order by nmHeader asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['idHeader']] = $row['nmHeader'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_jadwalDokter()
	{
		
		$sql = "SELECT * from jadwal_dokter a ";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_subheader_lab($header)
	{
		
		$K = $this->db->query("select * from simpus_master_subheader_lab where headerId='".$header."'order by nmSubheader asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['idSubheader']] = $row['nmSubheader'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_dokter()
	{
		$pusk_id = $this->ion_auth->unit();
		$sql = "SELECT a.*,b.nip from simpus_dokter a left join simpus_dokter_nip b on a.kdDokter=b.kdDokter where pusk_id='" . $pusk_id . "'";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_tindakan_by_id($tindakan_id)
	{
		$sql = "select * from master_tindakan2 where TINDAKAN_ID ='" . $tindakan_id . "'";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_kategori_unit($id=null)
	{
		if($id == '')
		{
			$where = '';
		}
		else
		{
			$where = "where id_kategori <> 1";
		}
		$K = $this->db->query("select * from data_master_unit $where order by id_kategori asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_kategori']] = $row['kategori'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_provider_act()
	{

		$K = $this->db->query("SELECT * FROM simpus_provider a WHERE a.`stts`='1'");
		$data['0'] = '- Pilih -';
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdProvider']] = $row['nmProvider'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_dokter_prov($kd_ppk = null, $kdPoli = null)
	{

		$K = $this->db->query("SELECT * FROM master_dokter_provider a WHERE a.`kdPpk`='" . $kd_ppk . "' AND a.`kdPoli`='" . $kdPoli . "' ORDER BY a.`kdDokter` ASC");
		$data['0'] = '- Pilih -';
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				//$glrBlk=empty('.'.$row['glrBlkang'])?$row['glrBlkang'] : '';
				//$nama = $row['glrDepan'].'. '.$row['nmDokter'].'.'.$row['glrBlkang'];
				$data[$row['kdDokter']] = $row['nmDokter'];
			}
		} else {
			$data['0'] = 'Data Dokter Kosong';
		}
		$K->free_result();
		return $data;
	}

	function get_unit_list($id_unit)
	{
		$idpkm = $this->ion_auth->unit();
		$K = $this->db->query("select * from data_master_unit mu inner join data_master_unit_detail md on mu.id_kategori = md.id_kategori where id_unit='" . $idpkm . "' and mu.id_kategori='" . $id_unit . "' and md.status=1");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_detail']] = $row['nama_unit'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_puskesmas()
	{
		$idpkm = $this->ion_auth->unit();
	
		$K = $this->db->query("select * from unit_profiles where kategori is null AND unit_id='".$idpkm."' order by nama_unit asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['unit_id']] = $row['nama_unit'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_puskesmas_log()
	{
		if ($this->getId() != '46')
			$where = "WHERE unit_id='" . $this->getId() . "' ";
		else
			$where = '';

		$K = $this->db->query("SELECT unit_id,REPLACE(nama_unit,'PUSKESMAS ','') AS puskesmas FROM unit_profiles $where ORDER BY NAMA_UNIT ASC");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['unit_id']] = $row['puskesmas'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_unit_list_all()
	{
		$idpkm = $this->ion_auth->unit();
		if ($idpkm != '46')
			$unit = "WHERE id_unit='" . $idpkm . "'";
		else
			$unit = "";
		$K = $this->db->query("SELECT id_detail,kategori,REPLACE(nama_unit,'PUSKESMAS','') AS nama_unit FROM data_master_unit mu 
			INNER JOIN data_master_unit_detail md ON mu.id_kategori = md.id_kategori 
			$unit and md.status=1 ORDER BY mu.id_kategori,nama_unit asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_detail']] = '[ <strong>' . $row['kategori'] . ' </strong>] ' . $row['nama_unit'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_wilayah()
	{
		$data['0'] = '- Pilih -';

		$K = $this->db->query("select * from master_wilayah order by id_wilayah asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_wilayah']] = $row['wilayah'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_provider()
	{
		$data['0'] = '- Pilih -';

		$K = $this->db->query("SELECT * FROM simpus_provider sp ORDER BY sp.`kdProvider` ASC");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdProvider']] = $row['nmProvider'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_provider_rs()
	{
		$data['0'] = '- Pilih -';

		$K = $this->db->query("SELECT * FROM simpus_provider sp where idKategori='2' ORDER BY sp.`kdProvider` ASC");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdProvider']] = $row['nmProvider'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}


	function get_poli()
	{
		$data['0'] = '- Pilih -';
		$K = $this->db->query("SELECT * FROM simpus_poli_fktp spf WHERE spf.`pelayanan`='true'");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdPoli']] = $row['nmPoli'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_jenis_ukk()
	{
		$K = $this->db->query("select * from master_jenis_ukk order by id_jenis asc");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_jenis']] = $row['jenis_ukk'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_diagnosa_kasus()
	{
		$K = $this->db->query("select * from master_diagnosa_kasus order by id desc");
		$data['0'] = '- Pilih -';
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id']] = $row['kasus'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}


	 function getPuskesmas()
	{
		if ($this->getId() != '46')
			$where = "WHERE unit_id='" . $this->getId() . "' ";
		else
			$where = '';

		$data['0'] = '- Pilih -';
		$K = $this->db->query("SELECT unit_id,REPLACE(nama_unit,'PUSKESMAS ','') AS puskesmas FROM unit_profiles $where ORDER BY NAMA_UNIT ASC");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['unit_id']] = $row['puskesmas'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	//tambahan pengembangan KIA
	

	//-- KAMAR --//
	function get_drop_kamar()
	{
		$K = $this->db->query("SELECT * FROM master_kamar WHERE pusk_id='" . $this->getID() . " ORDER BY nama_kamar ASC';");
		if ($K->num_rows() > 0) {
			$data['0'] = '-- Pilih --';
			foreach ($K->result_array() as $row) {
				$data[$row['id_kamar']] = $row['nama_kamar'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	public function get_kamar()
	{
		$sql = "SELECT * FROM master_kamar WHERE pusk_id='" . $this->getID() . "';";
		$query = $this->db->query($sql);
		return $query;
	}
	public function get_bed()
	{
		$sql = "SELECT mk.*,mb.`id_bed`,mb.`nama_bed`,mb.`status`,mb.`digunakan` FROM master_kamar mk
		RIGHT JOIN master_bed mb ON mk.`id_kamar`=mb.`id_kamar` WHERE pusk_id='" . $this->getID() . "';";
		$query = $this->db->query($sql);
		return $query;
	}



	function get_kategori_katarak()
	{
		$data[''] = '';
		$K = $this->db->query("SELECT * FROM master_katarak mk WHERE mk.`pasca_operasi`='false'");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_katarak']] = $row['nmKatarak'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_kategori_katarakPO()
	{
		$data[''] = '';
		$K = $this->db->query("SELECT * FROM master_katarak mk WHERE mk.`pasca_operasi`='true'");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['id_katarak']] = $row['nmKatarak'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	//spesialis
	function get_spesialis()
	{
		$sql = "SELECT * from simpus_spesialis";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_subspesialis()
	{
		$sql = "SELECT * from simpus_subspesialis order by kdSpesialis";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_spesialiskhusus()
	{
		$sql = "SELECT * from simpus_spesialiskhusus";
		$query = $this->db->query($sql);
		return $query;
	}
	function get_spesialissarana()
	{
		$sql = "SELECT * from simpus_spesialissarana";
		$query = $this->db->query($sql);
		return $query;
	}
	//dropdown
	function get_spesialiskhusus_list()
	{
		$K = $this->db->query("select * from simpus_spesialiskhusus");
		if ($K->num_rows() > 0) {
			$data[''] = '';
			foreach ($K->result_array() as $row) {
				$data[$row['kdKhusus']] = $row['nmKhusus'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_spesialis_list()
	{
		$K = $this->db->query("select * from simpus_spesialis");
		if ($K->num_rows() > 0) {
			$data[''] = '';
			foreach ($K->result_array() as $row) {
				$data[$row['kdSpesialis']] = $row['nmSpesialis'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_subspesialis_list()
	{
		$K = $this->db->query("select * from simpus_subspesialis where THAHEM=1");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdSubSpesialis']] = $row['nmSubSpesialis'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function get_subspesialis_list1($kdSpesialis = NULL)
	{
		$kd = $kdSpesialis;
		$K = $this->db->query("select * from simpus_subspesialis where kdSpesialis='" . $kd . "'");
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['kdSubSpesialis']] = $row['nmSubSpesialis'];
			}
		} else {
			$data = '';
		}
		$K->free_result();
		return $data;
	}
	function get_spesialissarana_list()
	{
		$K = $this->db->query("select * from simpus_spesialissarana");
		if ($K->num_rows() > 0) {
			$data['0'] = '';
			foreach ($K->result_array() as $row) {
				$data[$row['kdSarana']] = $row['nmSarana'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function get_jenis_diare()
	{
		$K = $this->db->query("SELECT * FROM jenis_diare;");
		if ($K->num_rows() > 0) {
			$data['0'] = '-- Pilih --';
			foreach ($K->result_array() as $row) {
				$data[$row['id_jnisDiare']] = $row['nm_jnisDiare'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}

	function viewDokter_simp($kel_id)
	{

		$hasil = $this->db->query('SELECT * FROM master_dokter_provider a WHERE a.`kdPpk`="' . $kel_id . '"');
		return $hasil->result();
	}
	function get_diagnosa_keperawatan()
	{
		$K = $this->db->query("SELECT kdDiag,nmDiag FROM simpus_diagnosa WHERE kategori='1' ORDER BY nmDiag");
		$data['0'] = '- Pilih -';
		if ($K->num_rows() > 0) {
			foreach ($K->result_array() as $row) {
				$data[$row['nmDiag']] = $row['nmDiag'];
			}
		} else {
			$data = '0';
		}
		$K->free_result();
		return $data;
	}
	function getDataMasterLabBySubHeader($header,$subHeader)
	{
		$sql="SELECT * FROM `simpus_master_pemeriksaan_lab` WHERE headerId='".$header."' AND subheaderId='".$subHeader."' order by noUrut asc;";
		$query=$this->db->query($sql);
		return $query;

	}
	function getDataMasterLabById($id)
	{
		$sql="SELECT * FROM `simpus_master_pemeriksaan_lab` WHERE idPemeriksaan	='".$id."'";
		$query=$this->db->query($sql);
		return $query;
	}
}

/* End of file Master_model.php */
/* Location: ./application/modules/simpus/models/Master_model.php */