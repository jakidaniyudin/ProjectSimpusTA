<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian_model extends CI_Model {

  function getDataAntrian($tgl,$puskId)
  {
    $sql="SELECT id_antrian,kode_booking,poli,nama_poli,nik,tgl_periksa,kode_antrian,no_antrian,sumber FROM antrian a
      INNER JOIN master_poli b ON a.`poli`=b.`kode_poli`
      WHERE pusk_id='".$puskId."' AND tgl_periksa='".$tgl."' and status_panggil='0' order by id_antrian";
      $query=$this->db_antrian->query($sql);
 
      return $query;
  }

      //========================= Start Get Token=======================\\
    public function auth($username, $password)
    {
        /* encode dulu username nya, karena di db_antrian di encrypt */
        //$username = base64_encode($username);
       //$password = base64_encode($password);
        $this->db_antrian->select('*');
        $this->db_antrian->where('x_username', $username);
        $this->db_antrian->where('x_password', $password);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
           //echo $this->db_antrian->last_query();
        return $query->result();
    }

     public function get_noDokter($kd_dokter)
    {
        $this->db->select('a.nomor');
        $this->db->where('kdDokter', $kd_dokter);
        $this->db->from('master_dokter as a');
        $query = $this->db->get();
        return $query->result();
    }

    public function auth_token($token)
    {
        /* encode dulu username nya, karena di db_antrian di encrypt */
        //$username = base64_encode($username);
       //$password = base64_encode($password);
        //$this->db_antrian->where('x_username', $username);
        $this->db_antrian->where('x_token', $token);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
        return $query->result();
    }

       public function cekUsername($username)
    {   
        $this->db_antrian->select('x_password');
        $this->db_antrian->where('x_username', $username);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
        return $query->result();
    }

       public function cekPassword($password)
    {
        $this->db_antrian->where('x_password', $password);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function get_users($username)
    {
        $this->db_antrian->select('x_username,x_password');
        $this->db_antrian->where('username', $username);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
        return $query->result();
    }

       public function cek_xToken($token)
    {
        $this->db_antrian->select('x_username,x_password');
        $this->db_antrian->where('x_token', $token);
        $this->db_antrian->from('users');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    //========================= End Get Token=======================\\

    public function cek_terdaftar($kdPpk, $nomorkartu, $kodepoli, $tgl_periksa)
    {
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('no_peserta', $nomorkartu);
        $this->db_antrian->where('poli', $kodepoli);
        $this->db_antrian->where('tgl_periksa', $tgl_periksa);
        $this->db_antrian->from('antrian');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function terdaftar_by_nik($nik,$kdPpk, $kodepoli, $tgl_periksa)
    {
        $this->db_antrian->select('b.kode_antrian,a.no_antrian');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('nik', $nik);
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('poli', $kodepoli);
         $this->db_antrian->where('status_poli!="3"');
        $this->db_antrian->where('tgl_periksa', $tgl_periksa);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function cek_pasien($nik)
    {
        $this->db_antrian_simpus->select('*');
        $this->db_antrian_simpus->where('NIK', $nik);
        $this->db_antrian_simpus->from('simpus_pasien');
        $query = $this->db_antrian_simpus->get();
        return $query->result();
    }

     public function get_kel($kdPpk,$kec,$kel)
    {
        $this->db_antrian_simpus->select('*');
        $this->db_antrian_simpus->where('kd_ppk', $kdPpk);
        $this->db_antrian_simpus->where('NO_KEC', $kec);
        $this->db_antrian_simpus->where('NO_KEL', $kel);
        $this->db_antrian_simpus->from('setup_kel_bwi_new');
        $query = $this->db_antrian_simpus->get();
        return $query->result();
    }

    public function get_poli($kodepoli)
    {
        $this->db_antrian->where('kode_poli', $kodepoli);
        $this->db_antrian->from('master_poli');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function input($no_antrian, $nomorkartu, $nik, $notelp, $tanggalperiksa, $kodepoli, $nomorreferensi, $jenisreferensi, $jenisrequest, $polieksekutif)
    {
        $data = array(
            'no_antrian' => $no_antrian,
            'no_peserta' => $nomorkartu,
            'nik' => $nik,
            'notelp' => $notelp,
            'tgl_periksa' => $tanggalperiksa,
            'poli' => $kodepoli,
            'no_referensi' => $nomorreferensi,
            'jns_referensi' => $jenisreferensi,
            'jns_req' => $jenisrequest,
            'poli_eksekutif' => $polieksekutif,
        );
        $this->db_antrian->insert('antrian', $data);
        $insert_id = $this->db_antrian->insert_id();
        return  $insert_id;
    }

    public function get_estimasi($kodepoli, $tanggalperiksa)
    {
        /* perhitungan estimasi disesuaikan sendiri dengan sistem antrian RS */
        date_default_timezone_set('Asia/Jakarta');
        $stamp = strtotime($tanggalperiksa);
        $time_in_ms = $stamp * 1000;
        return $time_in_ms;
    }

    public function get_antrian_terakhir($kdPpk,$kodepoli,$kodedokter, $tanggalperiksa)
    {
        $this->db_antrian->select('no_antrian');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('poli', $kodepoli);
        $this->db_antrian->where('kd_dokter', $kodedokter);
        $this->db_antrian->where('tgl_periksa', $tanggalperiksa);
        $this->db_antrian->order_by('no_antrian', 'DESC');
        $this->db_antrian->limit(1);
        $this->db_antrian->from('antrian');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function get_dilayani($kodepoli, $tanggalperiksa, $layan = '0')
    {
        $this->db_antrian->select('count(*) as jml');
        $this->db_antrian->where('poli', $kodepoli);
        $this->db_antrian->where('tgl_periksa', $tanggalperiksa);
        $this->db_antrian->where('poli_eksekutif', '0');
        $this->db_antrian->where('status_loket', $layan);
        $this->db_antrian->group_by('status_loket');
        $this->db_antrian->from('antrian');
        $query = $this->db_antrian->get();
        return $query->result();
    }


    
    public function get_sisa_antrian($kdPpk,$tanggal_periksa)
    {
        $this->db_antrian->select('COUNT(*) AS sisaAntrian');
        $this->db_antrian->where('status_poli', '0');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->from('antrian');
        $query = $this->db_antrian->get();
        return $query->result();
    }

     public function list_daftar_antrian($kdPpk,$poli,$tanggal_periksa)
    {
        $this->db_antrian->select('c.`nama_unitt`,a.`kode_booking`,a.`nik`,b.`kode_antrian`,
            a.`no_antrian`,b.`nama_poli`,a.`tgl_periksa`,a.`status_poli` as panggil');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->join('unit_profiles as c','a.kd_ppk=c.unit_id','INNER');
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function get_panggil_antrian($kdPpk,$tanggal_periksa)
    {
        $this->db_antrian->select('b.kode_antrian');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->order_by('a.id_antrian','ASC');
        $this->db_antrian->limit('1');
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function panggil_antrian($kdPpk,$tanggal_periksa)
    {
        $this->db_antrian->select('a.no_antrian,b.kode_antrian');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('status_panggil', '1');
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function get_antrian_poli($kdPpk,$poli,$tanggal_periksa)
    {

        $this->db_antrian->where('status_poli !=""');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function ttl_antrian_poli($kdPpk,$poli,$tanggal_periksa)
    {
        $this->db_antrian->select('b.`kode_antrian`,b.`nama_poli`, COUNT(*) AS total');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('status_poli !=""');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function ss_antrian_poli($kdPpk,$poli,$tanggal_periksa)
    {
        $this->db_antrian->select('COUNT(*) AS ttl_sisa');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('status_poli','0');
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function getPgl_antrian_poli($kdPpk,$poli,$tanggal_periksa)
    {
        $this->db_antrian->where('status_poli','1');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli); 
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function pgl_antrian_poli($kdPpk,$poli,$tanggal_periksa)
    {
        $this->db_antrian->select('b.`kode_antrian`,a.`no_antrian`');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('status_poli','1');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->order_by('id_antrian','DESC');
        $this->db_antrian->limit(1);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function sisa_peserta_poli($kdPpk,$no_peserta,$poli,$tanggal_periksa)
    {
        $this->db_antrian->select('b.`kode_antrian`,a.`no_antrian`,b.`nama_poli`');
        $this->db_antrian->join('master_poli as b','a.poli=b.kode_poli','INNER');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->where('poli', $poli);
        $this->db_antrian->where('no_peserta', $no_peserta);
        $this->db_antrian->from('antrian as a');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function getSisaAntrian_poli($kdPpk,$tanggal_periksa)
    {
        $this->db_antrian->select('SUM(IF(poli="001" AND status_panggil="0", 1, 0)) AS umum,
       SUM(IF(poli="002" AND status_panggil="0", 1, 0)) AS gigi,
       SUM(IF(poli="003" AND status_panggil="0", 1, 0)) AS kia, 
       COUNT(*) AS total_antrian');
        $this->db_antrian->where('kd_ppk', $kdPpk);
        $this->db_antrian->where('tgl_periksa', $tanggal_periksa);
        $this->db_antrian->from('antrian');
        $query = $this->db_antrian->get();
        return $query->result();
    }

    public function master_poli()
    {
        $this->db_antrian->select('kode_poli,nama_poli');
        $this->db_antrian->where('kode_poli!=','');
        $this->db_antrian->from('master_poli');
        $query = $this->db_antrian->get();
        return $query->result();
    }


}