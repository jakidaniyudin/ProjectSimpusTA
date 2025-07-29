<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class satusehat_model extends CI_Model {

    public function getId()
    {
        $user_id = $this->session->userdata('user_id');
        $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
        return $this->id;

    }
    function get_list_unit()
    {
        if($this->getId() < 46)
        {
            $where = "where unit_id='".$this->getId()."' ";
        }
        else
        {
            $where = "where unit_id < 46";
        }
        $sql="select * from unit_profiles $where";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_data_id_satu_sehat($id)
    {       
        $query= $this->db->query('select * from unit_profiles where UNIT_ID = "'.$id.'" ')->row();
        return $query;
    }

    public function get_data_dummy_patient()
    {
        $sql="select * from data_dummy where kategori ='1' order by nama";
        $query=$this->db->query($sql);
        return $query;
    }
    public function get_data_dummy_practitioner()
    {
        $sql="select * from data_dummy where kategori ='2' order by nama";
        $query=$this->db->query($sql);
        return $query;
    }
    public function get_data_organization()
    {
         $sql="select unit_id,replace(nama_unit,'PUSKESMAS','') AS nama_unit,alamat,'35' as no_prov,'Jawa Timur' as nama_prov,'10' as no_kab,'Banyuwangi' as nama_kab,kec.no_kec, 
        kec.nama_kec,kel.no_kel, kel.nama_kel,up.kode_pos,kode_puskesmas,org_id,
        up.response_organization
        from unit_profiles up
        left join setup_kec_bwi_new kec on up.no_kec=kec.no_kec
        left join setup_kel_bwi_new kel on kel.NO_KEC=kec.NO_KEC and kel.NO_KEL=up.NO_KEL
        where unit_id < 46 
        order by nama_unit";
        $query=$this->db->query($sql);
        return $query;
    }
    public function get_data_organization_by_id($org_id)
    {
         $sql="select unit_id,replace(nama_unit,'PUSKESMAS','') AS nama_unit,alamat,'35' as no_prov,'Jawa Timur' as nama_prov,'10' as no_kab,'Banyuwangi' as nama_kab,kec.no_kec, 
        kec.nama_kec,kel.no_kel, kel.nama_kel,up.kode_pos,kode_puskesmas,org_id,pusk_rawat,telp,email,
        up.response_organization
        from unit_profiles up
        left join setup_kec_bwi_new kec on up.no_kec=kec.no_kec
        left join setup_kel_bwi_new kel on kel.NO_KEC=kec.NO_KEC and kel.NO_KEL=up.NO_KEL
        where org_id ='".$org_id."'
        order by nama_unit";
        $query=$this->db->query($sql);
        return $query;
    }
    public function get_data_encounter_list($jenis,$id)
    {
        if($jenis == '1')
        {
            $where="sp.NIK='".$id."'";
        }
        else
        {
            $where="sp.IHS='".$id."'";
        }
        $sql="SELECT sl.idLoket,sp.ALAMAT,sp.nik,sp.NAMA_LGKP,ihs,sl.tglKunjungan,sl.unitId,up.nama_unit,encounter_id 
        FROM simpus_loket sl
        INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
        INNER JOIN unit_profiles up ON up.unit_id=sl.unitId
        WHERE $where AND sl.puskId='".$this->getId()."'";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_location()
    {
        if($this->getId() < 46)
        {
            $where = "where id_unit='".$this->getId()."' ";
        }
        else
        {
            $where = "";
        }
        $sql="SELECT l.id,l.id_location_satu_sehat,up.unit_id,up.nama_unit,mrp.name,mrp.description FROM location l
        INNER JOIN master_ruang_layanan mrp ON mrp.id_ruang_layanan=l.id_ruang_layanan
        LEFT JOIN unit_profiles up ON up.unit_id=l.id_unit
        $where
        ORDER BY id_unit,mrp.id_ruang_layanan ASC ";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_data_location_by_id($id)
    {
        $sql="SELECT l.id_location_satu_sehat,up.org_id,mrl.name,mrl.description,up.telp,up.email,fax,site,
        alamat,up.kode_pos,no_prov,no_kab,no_kec,no_kel,up.lat AS latitude,up.lng AS longitude,rt,rw
        FROM location l 
        INNER JOIN unit_profiles up ON up.unit_id=l.id_unit
        INNER JOIN master_ruang_layanan mrl ON mrl.id_ruang_layanan=l.id_ruang_layanan
        WHERE l.id='".$id."'";
        $query=$this->db->query($sql);
        return $query;
    }


}