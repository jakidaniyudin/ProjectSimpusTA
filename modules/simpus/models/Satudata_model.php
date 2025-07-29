<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satudata_model extends CI_Model {

	public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;
    }


	// get data
	var $table = 'simpus_loket sl';
    var $column_order = array('timeRespon'=>'asc'); //set column field database for datatable orderable
    var $column_search = array(); //set column field database for datatable searchable 
    var $order = array('tglKunjungan'=>'asc'); // default order 

    private function _get_datatables_query()
    {
       $puskId=$this->getId();
        $tglAwal= date('Y-m-d', strtotime($this->input->post('tglAwal'))); 
        $tglAkhir= date('Y-m-d', strtotime($this->input->post('tglAkhir'))); 

        $this->db->select("tkeys.secret_keys,tkeys.kdppk AS kodeFaskes,tkeys.nama_faskes AS namaFaskes,sl.idLoket,sl.pasienId as idPasien,sl.tglKunjungan,sp.TGL_LHR AS tglLahir,
		IF(sp.noKartu !='','true','false') AS bpjs,
		IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru,
		IF(sl.kdTkp='10', 'true','false') AS rawatJalan,sp.NO_PROP AS kodeProv,sp.NO_KAB AS kodeKab,
		sp.NO_KEC AS kodeKec, sp.NO_KEL AS kodeKel,sl.statusResponSatuData,sl.idResponSatuData,timeRespon");

        $this->db->join('simpus_pasien sp','sp.ID=sl.pasienId','inner');
        $this->db->join('tb_keys tkeys','tkeys.unit_id=sl.puskId','inner');
        $this->db->from($this->table);
        $this->db->where("tglKunjungan BETWEEN '".$tglAwal."' AND '". $tglAkhir."'");
        $this->db->where("puskId",$puskId);
        $this->db->order_by('tglKunjungan','asc');
        $this->db->order_by('timeRespon','asc');
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                   $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                   $this->db->like($item, $_POST['search']['value']);
               }
               else
               {
                $this->db->or_like($item, $_POST['search']['value']);
            }

                if(count($this->column_search) - 1 == $i) //last loop
                {
                  $this->db->group_end(); //close bracket
              }
          }
          $i++;
      }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
    	$tglAwal= date('Y-m-d', strtotime($this->input->post('tglAwal'))); 
        $tglAkhir= date('Y-m-d', strtotime($this->input->post('tglAkhir'))); 
    	$this->db->where("tglKunjungan BETWEEN '".$tglAwal."' AND '". $tglAkhir."'");
        $this->db->where("puskId",$this->getId());
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //========================================================================================================
	public function getData($puskId,$tglAwal,$tglAkhir)
	{	
		$sql="SELECT sl.pasienId,sl.tglKunjungan,IF(sp.noKartu !='','true','false') AS bpjs,
		IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		WHERE (sl.tglKunjungan) BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
		AND sl.puskId='".$puskId."' ORDER BY createdDate ASC";
		$query=$this->db->query($sql);
		return $query;
	}
	// public function getDataKunjunganX($puskId,$tglKirim)
	// {
	// 	$sql="SELECT tkeys.secret_keys,tkeys.kdppk AS kodeFaskes,tkeys.nama_faskes AS namaFaskes,sl.idLoket,sl.pasienId as idPasien,sl.tglKunjungan,sp.TGL_LHR AS tglLahir,
	// 	IF(sp.noKartu !='','true','false') AS bpjs,
	// 	IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru,
	// 	IF(sl.kdTkp='10', 'true','false') AS rawatJalan,sp.NO_PROP AS kodeProv,sp.NO_KAB AS kodeKab,
	// 	sp.NO_KEC AS kodeKec, sp.NO_KEL AS kodeKel,sl.statusResponSatuData,sl.idResponSatuData
	// 	FROM simpus_loket sl 
	// 	INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
	// 	INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
	// 	WHERE (sl.tglKunjungan)  BETWEEN '2023-04-01' AND '2023-04-31'
	// 	AND sl.puskId='".$puskId."' 
	// 	AND sl.idResponSatuData IS NULL
	// 	ORDER BY createdDate ASC
	// 	LIMIT 100";
	// 	$query=$this->db->query($sql);
	// 	return $query;

	// }
	public function getDataKunjunganByDate($tglAwal,$tglAkhir)
	{
		$sql="SELECT tkeys.secret_keys,tkeys.kdppk AS kodeFaskes,tkeys.nama_faskes AS namaFaskes,sl.idLoket,sl.pasienId as idPasien,sl.tglKunjungan,sp.TGL_LHR AS tglLahir,
		IF(sp.noKartu !='','true','false') AS bpjs,
		IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru,
		IF(sl.kdTkp='10', 'true','false') AS rawatJalan,sp.NO_PROP AS kodeProv,sp.NO_KAB AS kodeKab,
		sp.NO_KEC AS kodeKec, sp.NO_KEL AS kodeKel,sl.statusResponSatuData,sl.idResponSatuData
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
		WHERE (sl.tglKunjungan) BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
		AND sl.idResponSatuData = ''
		ORDER BY tglKunjungan ASC
		LIMIT 300";
		$query=$this->db->query($sql);
		return $query;

	}
	public function getDataKunjunganAll($tglKirim)
	{
		$sql="SELECT tkeys.secret_keys,tkeys.kdppk AS kodeFaskes,tkeys.nama_faskes AS namaFaskes,sl.idLoket,sl.pasienId as idPasien,sl.tglKunjungan,sp.TGL_LHR AS tglLahir,
		IF(sp.noKartu !='','true','false') AS bpjs,
		IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru,
		IF(sl.kdTkp='10', 'true','false') AS rawatJalan,sp.NO_PROP AS kodeProv,sp.NO_KAB AS kodeKab,
		sp.NO_KEC AS kodeKec, sp.NO_KEL AS kodeKel,sl.statusResponSatuData,sl.idResponSatuData
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
		WHERE 
		(sl.tglKunjungan) ='".$tglKirim."'
		AND 
		sl.idResponSatuData = ''
		ORDER BY tglKunjungan ASC
		LIMIT 10";
		$query=$this->db->query($sql);
		return $query;

	}
	public function getDataKunjunganLastMonth($limit)
	{
		$sql="SELECT tkeys.secret_keys,tkeys.kdppk AS kodeFaskes,tkeys.nama_faskes AS namaFaskes,sl.idLoket,sl.pasienId as idPasien,sl.tglKunjungan,sp.TGL_LHR AS tglLahir,
		IF(sp.noKartu !='','true','false') AS bpjs,
		IF(sp.JENIS_KLMIN='1','L','P') AS jenisKelamin,sl.kunjBaru AS kunjunganBaru,
		IF(sl.kdTkp='10', 'true','false') AS rawatJalan,
		kunjSakit,mm.`nmMal` AS mall,sp.NO_PROP AS kodeProv,sp.NO_KAB AS kodeKab,
		sp.NO_KEC AS kodeKec, sp.NO_KEL AS kodeKel,sl.statusResponSatuData,sl.idResponSatuData
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
		LEFT JOIN simpus_data_diagnosa sdd on sdd.loketId=sl.idLoket
		LEFT JOIN simpus_master_mal mm ON sl.`kdKegiatan`=mm.`idMal`
		WHERE 
		(sl.tglKunjungan) BETWEEN '2024-03-01' AND '2024-03-31'	
		#and sl.`puskId` IN (8,10,9)
		AND sl.idResponSatuData = ''
		ORDER BY tglKunjungan,idLoket ASC
		LIMIT $limit";
		$query=$this->db->query($sql);
	

		return $query;

	}
	public function getDiagnosa($idloket)
	{
		$sql="SELECT kdDiagnosa AS kodeDiagnosa, nmDiagnosa AS namaDiagnosa
		FROM simpus_data_diagnosa as sdd
		INNER JOIN simpus_diagnosa sd ON sd.kdDiag=sdd.kdDiagnosa
		WHERE sd.klb IS NULL AND sdd.diagnosaKasus != '3'
		AND loketId='".$idloket."'";
		$query=$this->db->query($sql);
		return $query;

	}
	public function getJumlahDataKunjungan($puskId,$tglKirim)
	{
		$sql="SELECT count(*) as jumlah
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
		WHERE (sl.tglKunjungan) ='".$tglKirim."'
		AND sl.puskId='".$puskId."' 
		ORDER BY createdDate ASC";
		$query=$this->db->query($sql);
		return $query;

	}
	public function getJumlahDataBlmKirim($tglAwal,$tglAkhir)
	{
		$sql="SELECT count(*) as jumlah
		FROM simpus_loket sl 
		INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
		INNER JOIN tb_keys tkeys ON tkeys.unit_id=sl.puskId
		WHERE (sl.tglKunjungan) BETWEEN '".$tglAwal."' AND '".$tglAkhir."'		
		and sl.idResponSatuData = '' ";
		$query=$this->db->query($sql);
		return $query;

	}
}