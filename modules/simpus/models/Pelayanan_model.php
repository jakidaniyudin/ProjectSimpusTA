<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan_model extends CI_Model
{

    var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP', 'pasien.ALAMAT', 'nama_unit', 'NIK', 'loket.noKartu', 'NO_MR', 'NO_KK'); //set column field database for datatable searchable 
    var $order = array('pel.createdDate' => 'asc'); // default order 



    public function getId()
    {
        $user_id = $this->session->userdata('user_id');
        $this->id = $this->db->query("SELECT unit FROM users WHERE id='" . $user_id . "'")->row('unit');
        return $this->id;
    }
    private function _get_datatables_query($pol, $lansia)
    {

        $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, pel.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,pel.kunjSakitPel,id_encounter,loket.idLoket,loket.umur');


        if ($this->input->post('id_detail')) {
            $this->db->where('unit.id_detail', $this->input->post('id_detail'));
        }

        if ($this->input->post('tglKunjungan')) {
            $tglKunjungan = date("Y-m-d", strtotime($this->input->post('tglKunjungan')));
            $this->db->where('pel.tglPelayanan', $tglKunjungan);
        }

        //condition khusus pkm sumberberas
        if ($this->getId() == '21') {
            if ($lansia == 'true') {
                $this->db->where('kelUmur >=', '12');
            } else {
                $this->db->where('kelUmur <', '13');
                //if($this->getId().$this->id!=46){
                //  $this->db->where('puskId', $this->getId());

                //}
            }
        }

        if ($this->getId() . $this->id != 46) {
            $this->db->where('puskId', $this->getId());
            $where = "(pel.kdPoli='" . $pol . "')";
            $this->db->where($where);
        }

        $this->db->join('simpus_loket as loket', 'pel.loketId = loket.idLoket');
        $this->db->join('simpus_pasien as pasien', 'pasien.ID = loket.pasienId');
        $this->db->join('data_master_unit_detail as unit', 'unit.id_detail = loket.unitId');
        $this->db->join('simpus_statuspulang as plg', 'pel.kdStatusPulang = plg.kdStatusPulang', 'left');



        $this->db->from($this->table);
        $i = 0;


        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end(); //close bracket
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($pol, $lansia)
    {
        $this->_get_datatables_query($pol, $lansia);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    public function count_filtered($pol, $lansia)
    {
        $this->_get_datatables_query($pol, $lansia);
        $query = $this->db->get();
        return $query->num_rows();
    }


    //------------- list rujukan -------------/
    function getDataRujuk($idLoket)
    {
        $this->db->select('b.loketId,b.idpelayanan,b.pelIdSebelum,sp.kdStatusPulang,sp.nmStatusPulang,b.kdPoli,pol.nmPoli AS asal,b.tujuanPoli,pol2.nmPoli AS tujuan,b.startTime,b.sudahDilayani,b.endTime,b.createdBy,b.tglPindah,md.nmDokter');
        $this->db->join('simpus_pelayanan AS b', 'a.idLoket=b.loketId', 'inner');
        $this->db->join('simpus_poli_fktp AS pol', 'b.kdPoli=pol.kdPoli', 'left');
        $this->db->join('simpus_statuspulang AS sp', 'b.kdStatusPulang=sp.kdStatusPulang', 'left');
        $this->db->join('simpus_poli_fktp AS pol2', 'b.tujuanPoli=pol2.kdPoli', 'left');
        $this->db->join('master_dokter AS md', 'b.tenagaMedis=md.kdDokter', 'left');
        $this->db->where('loketId', $idLoket);
        $this->db->order_by('b.createdDate', 'asc');
        return $this->db->get('simpus_loket AS a');
    }

    //-- veset
    function getDataVisit($idLoket)
    {
        $this->db->select('a.*,b.*,c.nmPoli');
        $this->db->join('simpus_dokter AS b', 'a.kdDokter=b.kdDokter', 'inner');
        $this->db->join('simpus_poli_fktp AS c', 'a.kdPoli=c.kdPoli', 'left');
        $this->db->where('loketId', $idLoket);
        $this->db->where('pusk_id', $this->getId());
        return $this->db->get('simpus_visit AS a');
    }

    //-- anam reset
    function getDataAnam($idLoket)
    {
        $this->db->select('idAnamnesa,tglAnamnesa,nmSadar,tinggiBadan,beratBadan,sistole,diastole,respRate,heartRate,suhu,
    	a.keluhan,thoraxJantung,thoraxPulmo,abdomanAtas,abdomanBawah,extrimitasAtas,extrimitasBawah,nmDokter');
        $this->db->join('simpus_dokter AS b', 'a.tenagaMedisAskep=b.kdDokter', 'inner');
        $this->db->join('simpus_kesadaran AS c', 'a.kdSadar=c.kdSadar', 'left');
        $this->db->join('simpus_loket AS d', 'a.loketId=d.idLoket', 'left');
        $this->db->where('loketId', $idLoket);
        $this->db->order_by('d.tglKunjungan', 'ASC');
        return $this->db->get('simpus_anamnesa AS a');
    }
    function getDataAnamByIdAnamnesa($idAnamnesa)
    {
        $this->db->select('*');
        $this->db->where('idAnamnesa', $idAnamnesa);
        return $this->db->get('simpus_anamnesa AS a');
    }

    function getDataPasien($idPasien, $tglKunjungan)
    {
        $sql = "select c.ID,IHS_NUMBER,c.ALERGI,c.TGL_LHR, c.NO_MR,c.NIK,c.noKartu,c.kdProvider,c.NAMA_LGKP,
        c.JENIS_KLMIN,a.umur,a.umur_bulan,a.umur_hari,
        c.ALAMAT,c.NO_PROP,c.NO_KAB,c.NO_KEC,c.NO_KEL,e.kategori,b.nama_unit,a.tglKunjungan,e.id_kategori,a.unitId,d.UKK from simpus_loket a 
                inner join data_master_unit_detail b on a.unitId=b.id_detail
                inner join simpus_pasien c on a.pasienId=c.ID
                left join pkrjn_master d on d.NO=c.JENIS_PKRJN
                inner join data_master_unit e on e.id_kategori=b.id_kategori where c.ID  = '" . $idPasien . "' and a.tglKunjungan='" . $tglKunjungan . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataPoli($idLoket, $kdPoli)
    {
        $sql = "SELECT b.nmPoli AS poliAsal FROM simpus_pelayanan a 
                LEFT JOIN simpus_poli_fktp b ON a.kdPoli=b.kdPoli
                WHERE a.loketId='" . $idLoket . "' AND a.tujuanPoli='" . $kdPoli . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataDiare($id)
    {
        $sql = "SELECT count(*) as cek FROM simpus_data_diagnosa sdd
                LEFT JOIN simpus_diagnosa sd ON sd.kdDiag=sdd.kdDiagnosa
                WHERE sd.diare='1' AND sdd.pelayananId='" . $id . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataKatarak($id)
    {
        $sql = "SELECT count(*) as cekKatarak FROM simpus_data_diagnosa sdd
                LEFT JOIN simpus_diagnosa sd ON sd.kdDiag=sdd.kdDiagnosa
                WHERE sd.katarak='1' AND sdd.pelayananId='" . $id . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataObat($id)
    {
        $sql = "SELECT * FROM simpus_resep_obat sro WHERE sro.pelayananId='" . $id . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataAlergi($idPasien)
    {
        $sql = "SELECT * FROM simpus_alergi_data where pasienId ='" . $idPasien . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataKunjungan($idPelayanan)
    {
        $sql = "SELECT pel.sudahDilayani,pel.*,sa.*,b.*,pel.idpelayanan,lok.keluhan as keluhan_loket,lok.pasienId,lok.tglKunjungan,lok.umur,lok.unitId,lok.kunjSakit,lok.idLoket,pel.kdPoli AS polpel,pel.tujuanPoli,lok.tglKunjungan,p.nmPoli,lok.kdKegiatan,resep_diambil,sg.*,lok.idLoket  
    FROM simpus_pelayanan pel
    LEFT JOIN simpus_loket lok ON lok.idLoket=pel.loketId           
    LEFT JOIN simpus_anamnesa sa ON sa.loketId=pel.loketId 
    LEFT JOIN simpus_gizi sg ON sg.loketId=pel.loketId
    LEFT JOIN simpus_dokter b ON b.kdDokter=sa.tenagaMedis
    LEFT JOIN simpus_poli_fktp p on pel.kdPoli=p.kdPoli
    WHERE pel.idpelayanan = '" . $idPelayanan . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function getDataRiwayatTerakhir($idLoketLalu)
    {
        $sql = "select * from simpus_anamnesa where loketId='" . $idLoketLalu . "'";
        $query = $this->db->query($sql);
        return $query;
    }
    function getTestData()
    {
        $sql = "select * from simpus_pasien limit 5";
        $query = $this->db->query($sql);
        return $query;
    }
    function getTestDataById($id)
    {
        $sql = "select * from simpus_pasien where ID='" . $id . "'";
        $query = $this->db->query($sql);
        return $query;
    }
}