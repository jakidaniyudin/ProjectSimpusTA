<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laborat_model extends CI_Model {

	public function getId()
	{
		$user_id = $this->session->userdata('user_id');
		$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
		return $this->id;

	}
	public function getUnit()
	{
		$this->db->select('id_detail,id_unit,nama_unit');
		$this->db->from('data_master_unit_detail as a');
		$this->db->where('a.id_detail',$this->getId());

		$query = $this->db->get();
		return $query;
	}
	public function getUnitDetails($unit)
	{

		if($this->getId() != '46')
			$idpkm = "id_unit='".$this->getId()."'  ";
		else
			$idpkm = '';

		if($unit == '0')
			$unitx='';
		else
			$unitx="AND id_kategori='".$unit."' "; 
		$K=$this->db->query("SELECT * FROM data_master_unit_detail WHERE  $idpkm  $unitx ORDER BY nama_unit ASC");   

		foreach ($K->result_array() as $row)
		{
			$data[$row['id_detail']] = $row['nama_unit'];
		}
		$K->free_result();
		return isset($data) ? $data : NULL;
	}
	public function getUnitDropdown()
	{
		$K=$this->db->query("SELECT * FROM data_master_unit ");

		foreach ($K->result_array() as $row)
		{
			$data[$row['id_kategori']] = $row['kategori'];
		}

		$K->free_result();
		return $data;
	}
	public function getJumlahPasien($date = null)
	{
		$idpkm = $this->ion_auth->unit();
        if($idpkm != '46')
            $unit="AND puskId ='".$idpkm."'";
        else
            $unit="";
        $tgl=date("Y-m-d");
        $sql= "SELECT COUNT(*) AS jumlahLab
        FROM simpus_loket sl 
        inner join simpus_permohonan_lab plab on plab.loketId=sl.idLoket
        WHERE tglKunjungan = '".$tgl."' 
        $unit ";
        $query=$this->db->query($sql);   
        return $query;
	}
	public function getPasienlab($unit_details,$date)
	{
		$sql ="SELECT idPermohonan,tglDibuat,lok.idLoket,spn.idpelayanan,spn.pelIdSebelum,lok.jknPbi,sp.NAMA_LGKP,JENIS_KLMIN,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL,plab.alasanDirujuk,statusLayanan,tenagaMedisPengirim,nmPoli
		FROM simpus_permohonan_lab plab
		INNER JOIN simpus_loket lok ON plab.loketId=lok.idLoket
		INNER JOIN simpus_pasien sp ON sp.ID=lok.pasienId
		INNER JOIN simpus_pelayanan spn ON spn.loketId=lok.idLoket AND spn.`idpelayanan`=plab.`pelayananId`
		LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP 
		LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
		WHERE DATE_FORMAT(lok.tglKunjungan,'%d-%m-%Y')='$date'  
		AND lok.unitId='$unit_details'
		order by plab.createdDate";
		$query = $this->db->query($sql);

		return $query;
	}
	public function getDataPelayanan($idPelayanan)
	{
		$sql='SELECT pel.sudahDilayani,pel.*,sa.*,pel.idpelayanan,lok.keluhan,lok.pasienId,lok.tglKunjungan,lok.umur,lok.unitId,lok.kunjSakit,lok.idLoket,pel.kdPoli AS polpel,pel.tujuanPoli,lok.tglKunjungan,p.nmPoli,lok.kdKegiatan
				FROM simpus_pelayanan pel
				LEFT JOIN simpus_loket lok ON lok.idLoket=pel.loketId 
				LEFT JOIN simpus_anamnesa sa ON sa.loketId=pel.loketId 
				LEFT JOIN simpus_poli_fktp p on pel.kdPoli=p.kdPoli
				WHERE pel.idpelayanan = "'.$idPelayanan.'"';
		$query = $this->db->query($sql);
		return $query;

	}
	public function getDataPasien($idPasien,$tglKunjungan)
	{
		$sql='select c.ID,IHS_NUMBER,c.ALERGI,c.TGL_LHR, IF(c.JENIS_KLMIN="1","Laki-laki","Perempuan") AS JENIS_KLMN,c.NO_MR,c.NIK,c.noKartu,c.kdProvider,c.NAMA_LGKP,c.ALAMAT,c.NO_PROP,c.NO_KAB,c.NO_KEC,c.NO_KEL,e.kategori,b.nama_unit,a.tglKunjungan,e.id_kategori,a.unitId,d.UKK from simpus_loket a 
				inner join data_master_unit_detail b on a.unitId=b.id_detail
				inner join simpus_pasien c on a.pasienId=c.ID
				left join pkrjn_master d on d.NO=c.JENIS_PKRJN
				inner join data_master_unit e on e.id_kategori=b.id_kategori where c.ID  = "'.$idPasien.'" and a.tglKunjungan="'.$tglKunjungan.'"';
		$query = $this->db->query($sql);
		return $query;

	}
	public function getTindakanLab($idLoket)
	{
		$sql ="SELECT st.idTindakan,st.kdTindakan, st.nmTindakan,st.deskripsi,nilaiLab
		FROM simpus_tindakan st     
		where loketId='".$idLoket."' AND deskripsi ='lab' ";
		$query = $this->db->query($sql);
		return $query;
	}
	public function update($table, $data, $where)
	{
		$this->db->where($where)
		->update($table, $data);
		return TRUE;
	}
	public function getDataPermohonan($idLoket=null,$idPermohonan=null)
	{
		if($idLoket)
		{
			$this->db->where('loketId',$idLoket);
		}
		if($idPermohonan)
		{
			$this->db->where('idPermohonan',$idPermohonan);
		}
		$this->db->select('*');
		$this->db->from('simpus_permohonan_lab');
		$this->db->order_by('createdDate','asc');
		$query = $this->db->get();

		return $query;
	}
	/*public function getDataPemeriksaan($idLoket)
	{
		$this->db->select('idPemeriksaan,idTindakan,kdTindakan,nmTindakan,nmTindakanInd,nilaiLab,nilaiNormal,nilaiKritis,satuan,c.statusLayanan');
		$this->db->from('simpus_tindakan a'); 
		$this->db->join('simpus_master_pemeriksaan_lab b','a.pemeriksaanId=b.idPemeriksaan','inner');  
		$this->db->join('simpus_permohonan_lab c','c.idPermohonan=a.permohonanId','inner');   
		$this->db->where('c.loketId',$idLoket);
		$this->db->order_by('c.createdDate','asc');
		$query = $this->db->get();

		return $query;
	}*/
	public function getTenagaMedis($kdtenagaMedis)
	{
		$this->db->select('*');
		$this->db->from('master_dokter');
		$this->db->where('kdDokter',$kdtenagaMedis);
		$query = $this->db->get();
		return $query;
	}
	public function getPoli($kdPoli)
	{
		$this->db->select('*');
		$this->db->from('simpus_poli_fktp');
		$this->db->where('kdPoli',$kdPoli);
		$query = $this->db->get();
		return $query;
	}
	public function getKesadaran($kdSadar)
	{
		$this->db->select('*');
		$this->db->from('simpus_kesadaran');
		$this->db->where('kdSadar',$kdSadar);
		$query = $this->db->get();
		return $query;
	}
	public function getHeader()
	{
		$this->db->select('*');
		$this->db->from('simpus_master_header_lab');
		$query = $this->db->get();
		return $query;
	}
	public function getSubheader($idHeader)
	{
		$this->db->select('*');
		$this->db->from('simpus_master_subheader_lab');
		$this->db->where('headerId',$idHeader);
		$query = $this->db->get();
		return $query;
	}
	public function getJenisPemeriksaan($idSubheader,$nmPemeriksaan=null)
	{	
		if($nmPemeriksaan <> '0')
		{
			$like="and (nmPemeriksaanInd like '%".$nmPemeriksaan."%' or nmPemeriksaan like '%".$nmPemeriksaan."%')";
		}
		else
		{
			$like='';
		}
		$sql="select * from simpus_master_pemeriksaan_lab where subheaderId ='".$idSubheader."' $like and status ='1' order by subheaderId,noUrut asc";
		$query=$this->db->query($sql);    
		return $query;
	}
	public function getCountHeader($idHeader,$nmPemeriksaan=null)
	{
		if($nmPemeriksaan <> '0')
		{
			$like="and (nmPemeriksaanInd like '%".$nmPemeriksaan."%' or nmPemeriksaan like '%".$nmPemeriksaan."%')";
		}
		else
		{
			$like='';
		}
		$sql="SELECT count(idHeader) jmlHeader
		FROM simpus_master_pemeriksaan_lab a
		INNER JOIN simpus_master_subheader_lab b ON b.idSubheader=a.subheaderId
		INNER JOIN simpus_master_header_lab c ON c.idHeader=b.headerId AND c.idHeader=a.headerId
		WHERE idHeader='".$idHeader."'$like ";
		$query=$this->db->query($sql);
		return $query;
	}

	public function getCountSubHeader($idHeader,$idSubheader,$nmPemeriksaan=null)
	{
		if($nmPemeriksaan <> '0')
		{
			$like="and (nmPemeriksaanInd like '%".$nmPemeriksaan."%' or nmPemeriksaan like '%".$nmPemeriksaan."%')";
		}
		else
		{
			$like='';
		}
		$sql="SELECT count(idHeader) jmlSubHeader
		FROM simpus_master_pemeriksaan_lab a
		INNER JOIN simpus_master_subheader_lab b ON b.idSubheader=a.subheaderId
		INNER JOIN simpus_master_header_lab c ON c.idHeader=b.headerId AND c.idHeader=a.headerId
		WHERE idHeader='".$idHeader."' and idSubheader='".$idSubheader."' $like ";
		$query=$this->db->query($sql);
		return $query;
	}
	public function getPaketPemeriksaan($paket)
	{
		$sql="SELECT nmHeader,nmSubheader,kode,nmPemeriksaan,nmPemeriksaanInd,nilaiNormal,nilaiKritis,satuan,a.status
		FROM simpus_master_pemeriksaan_lab a
		INNER JOIN simpus_master_subheader_lab b ON b.idSubheader=a.subheaderId
		INNER JOIN simpus_master_header_lab c ON c.idHeader=b.headerId AND c.idHeader=a.headerId
		WHERE $paket = '1'";
		$query=$this->db->query($sql);
		return $query;
	}
	public function getCountByIdLoket($idHeader,$idSubheader=null,$idLoket,$idPermohonan=null)
	{
		if($idSubheader)
		{
			$this->db->where('idSubheader',$idSubheader);
		}
		if($idPermohonan)
		{
			$this->db->where('sp.idPermohonan',$idPermohonan);
		}

		$this->db->select('count(idHeader) jml');
		$this->db->from('simpus_tindakan st ');	
		$this->db->join('simpus_permohonan_lab sp','sp.idPermohonan=st.permohonanId','inner');
		$this->db->join('simpus_master_pemeriksaan_lab a','st.pemeriksaanId=a.idPemeriksaan','inner');
		$this->db->join('simpus_master_subheader_lab b','b.idSubheader=a.subheaderId','inner');
		$this->db->join('simpus_master_header_lab c','c.idHeader=b.headerId AND c.idHeader=a.headerId','inner');
		$this->db->where('b.headerId',$idHeader);
		$this->db->where('st.loketId',$idLoket);
		$query = $this->db->get();
		return $query;
	

	}
	public function getDataPemeriksaan($idHeader,$idSubheader,$idLoket,$idPermohonan=null)
	{
		if($idPermohonan)
		{
			$this->db->where('idPermohonan',$idPermohonan);
		}
		$this->db->select('idPemeriksaan,idTindakan,kdTindakan,nmTindakan,nmTindakanInd,nilaiLab,nilaiNormal,nilaiKritis,satuan,sp.statusLayanan,statusNilaiKritis');
		$this->db->from('simpus_tindakan st ');
		$this->db->join('simpus_permohonan_lab sp','sp.idPermohonan=st.permohonanId','inner');
		$this->db->join('simpus_master_pemeriksaan_lab a','st.pemeriksaanId=a.idPemeriksaan','inner');
		$this->db->join('simpus_master_subheader_lab b','b.idSubheader=a.subheaderId','inner');
		$this->db->join('simpus_master_header_lab c','c.idHeader=b.headerId AND c.idHeader=a.headerId','inner');
		$this->db->where('idHeader',$idHeader);
		$this->db->where('idSubheader',$idSubheader);
		$this->db->where('st.loketId',$idLoket);
		$this->db->order_by('sp.createdDate,noUrut','asc');
		$query = $this->db->get();
		return $query;


	}
}



