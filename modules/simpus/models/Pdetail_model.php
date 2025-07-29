<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdetail_model extends CI_Model
{

    function getDataPasien($id_pasien)
    {
        $query = $this->db->query("SELECT sp.NO_MR,DATE(sp.created) AS TGL_REG,NIK,sp.noKartu AS NO_BPJS,PUSK_ID,NIK,NAMA_LGKP,JENIS_KLMIN,ALAMAT,NO_PROP,NO_KAB,NO_KEL,NO_KEC,TGL_LHR FROM simpus_pasien sp
            WHERE sp.ID='" . $id_pasien . "'");
        return $query;
    }

    function getRiwayatPasienSimpusLama($id_pasien)
    {
        $query = $this->db->query("SELECT sk.tglKunjungan,up.nama_unit,poli.nmPoli,poliInternal.nmPoli AS poliInternal,sk.kdProviderRujukLanjut,diagnosa1,sk.nmdiagnosa1,diagnosa2,sk.nmdiagnosa2,diagnosa3,sk.nmdiagnosa3,sk.diastole,sk.sistole,sk.heartRate,sk.respRate,sk.keluhan,sk.nmtindakan1,sk.nmtindakan2,sk.nmtindakan3,sk.nmtindakan4,sk.nmtindakan5,terapi,tinggiBadan,beratBadan
            FROM simpus_pasien sp
            INNER JOIN simpus_kunjungan sk ON sp.ID=sk.pasien_id
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sk.id_unit
            INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sk.kdPoli 
            LEFT JOIN simpus_poli_fktp poliInternal ON poliInternal.kdPoli=sk.kdPoliRujukInternal
            WHERE sp.ID='" . $id_pasien . "' order by sk.tglKunjungan asc;");
        return $query;
    }

    function getRiwayatPasienSimpus($id_pasien)
    {
        $query = $this->db->query("SELECT sl.idLoket,sl.tglKunjungan,up.nama_unit,
            sa.tinggiBadan,sa.beratBadan,sa.sistole,sa.diastole,sa.heartRate,sa.respRate,sa.lingkarPerut,
            sl.keluhan as keluhan_loket,sa.keluhan,sa.keluhanTambahan,sa.terapi
            FROM simpus_pasien sp
            INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sl.unitId
            LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
            WHERE sp.ID=" . $id_pasien . " order by sl.tglKunjungan asc;");
        return $query;
    }

    // dataabse simpus cloud
    function getRiwayatPasienSimpusLamaCloud($id_pasien)
    {
        $query = $this->db_simpus_cloud->query("SELECT sk.tglKunjungan,up.nama_unit,poli.nmPoli,poliInternal.nmPoli AS poliInternal,sk.kdProviderRujukLanjut,diagnosa1,sk.nmdiagnosa1,diagnosa2,sk.nmdiagnosa2,diagnosa3,sk.nmdiagnosa3,sk.diastole,sk.sistole,sk.heartRate,sk.respRate,sk.keluhan,sk.nmtindakan1,sk.nmtindakan2,sk.nmtindakan3,sk.nmtindakan4,sk.nmtindakan5,terapi,tinggiBadan,beratBadan
            FROM simpus_pasien sp
            INNER JOIN simpus_kunjungan sk ON sp.ID=sk.pasien_id
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sk.id_unit
            INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sk.kdPoli 
            LEFT JOIN simpus_poli_fktp poliInternal ON poliInternal.kdPoli=sk.kdPoliRujukInternal
            WHERE sp.ID='" . $id_pasien . "';");
        return $query;
    }



    function getRiwayatPasienSimpusCloud($id_pasien)
    {
        $query = $this->db_simpus_cloud->query("SELECT sl.idLoket,sl.tglKunjungan,up.nama_unit,
            sa.tinggiBadan,sa.beratBadan,sa.sistole,sa.diastole,sa.heartRate,sa.respRate,sa.lingkarPerut,
            sl.keluhan,sa.terapi
            FROM simpus_pasien sp
            INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sl.unitId
            LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
            WHERE sp.ID=" . $id_pasien . ";");
        return $query;
    }
    //end dataabse simpus cloud


    function getDataPasienID($idpasien)
    {
        $query = $this->db->query("SELECT sp.ACTIVE,sp.ID,sp.NO_MR,sp.NO_MR_LAMA,DATE(sp.created) AS TGL_REG,NIK,sp.noKartu AS NO_BPJS,PUSK_ID,NIK,NAMA_LGKP,JENIS_KLMIN,ALAMAT,NO_PROP,NO_KAB,NO_KEL,NO_KEC,TGL_LHR FROM simpus_pasien sp
            WHERE sp.ID='" . $idpasien . "'");
        return $query;
    }
    function getRiwayatPasienSimpusLamaID($idpasien)
    {
        $query = $this->db->query("SELECT pul.nmStatusPulang,sk.tglKunjungan,up.nama_unit,poli.nmPoli,poliInternal.nmPoli AS poliInternal,sk.kdProviderRujukLanjut,diagnosa1,sk.nmdiagnosa1,diagnosa2,sk.nmdiagnosa2,diagnosa3,sk.nmdiagnosa3,sk.diastole,sk.sistole,sk.heartRate,sk.respRate,sk.keluhan,sk.nmtindakan1,sk.nmtindakan2,sk.nmtindakan3,sk.nmtindakan4,sk.nmtindakan5,terapi,tinggiBadan,beratBadan
            FROM simpus_pasien sp
            INNER JOIN simpus_kunjungan sk ON sp.ID=sk.pasien_id
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sk.id_unit
            INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sk.kdPoli 
            LEFT JOIN simpus_statuspulang pul ON pul.kdStatusPulang=sk.kdStatusPulang
            LEFT JOIN simpus_poli_fktp poliInternal ON poliInternal.kdPoli=sk.kdPoliRujukInternal
            WHERE sp.ID='" . $idpasien . "';");
        return $query;
    }

    function getRiwayatPasienSimpusID($idpasien)
    {
        $query = $this->db->query("SELECT sl.idLoket,sl.tglKunjungan,up.nama_unit,
            sa.tinggiBadan,sa.beratBadan,sa.sistole,sa.diastole,sa.heartRate,sa.respRate,sa.lingkarPerut,
            sl.keluhan,sa.terapi
            FROM simpus_pasien sp
            INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sl.unitId
            LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
            WHERE sp.ID=" . $idpasien . ";");
        return $query;
    }
    // RIWAYAT NIK
    function getRiwayatPasienSimpusLamaNIK($nik)
    {
        $query = $this->db->query("SELECT sk.id as idpel,sp.NIK,sp.ID,sp.NO_MR,sk.tglKunjungan,up.nama_unit,poli.nmPoli,poliInternal.nmPoli AS poliInternal,sk.kdProviderRujukLanjut,diagnosa1,sk.nmdiagnosa1,diagnosa2,sk.nmdiagnosa2,diagnosa3,sk.nmdiagnosa3,sk.diastole,sk.sistole,sk.heartRate,sk.respRate,sk.keluhan,sk.nmtindakan1,sk.nmtindakan2,sk.nmtindakan3,sk.nmtindakan4,sk.nmtindakan5,terapi,tinggiBadan,beratBadan
            FROM simpus_pasien sp
            INNER JOIN simpus_kunjungan sk ON sp.ID=sk.pasien_id
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sk.id_unit
            INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sk.kdPoli 
            LEFT JOIN simpus_poli_fktp poliInternal ON poliInternal.kdPoli=sk.kdPoliRujukInternal
            WHERE sp.NIK='" . $nik . "';");
        return $query;
    }

    function getRiwayatPasienSimpusLamaNIK2($nik)
    {
        $query = $this->db->query("SELECT * FROM simpus_kunjungan sk WHERE sk.NIK='" . $nik . "';");
        return $query;
    }

    function getRiwayatPasienSimpusNIK($nik)
    {
        $query = $this->db->query("SELECT sl.idLoket as idpel,sp.NIK,sp.ID,sp.NO_MR,sl.idLoket,sl.tglKunjungan,up.nama_unit,
            sa.tinggiBadan,sa.beratBadan,sa.sistole,sa.diastole,sa.heartRate,sa.respRate,
            sl.keluhan,sa.terapi
            FROM simpus_pasien sp
            INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
            LEFT JOIN data_master_unit_detail up ON up.id_detail=sl.unitId
            LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
            WHERE sp.NIK=" . $nik . ";");
        return $query;
    }

    function getRiwayatPasienSimpusNIK2($nik)
    {
        $query = $this->db->query("SELECT *
            FROM simpus_pasien sp
            INNER JOIN simpus_loket sl ON sp.ID=sl.pasienId
            WHERE sp.NIK=" . $nik . ";");
        return $query;
    }
    // ======= Suket ============ //
    public function getSuketList($idpelayanan)
    {
        $query = $this->db->query("SELECT sur.id_surat,surmar.SURAT,sur.no_surat,sur.keperluan,lok.tglKunjungan,lok.kdPoli
            FROM  surat_keterangan sur 
            LEFT JOIN surat_master surmar ON surmar.ID_JNS_SURAT=sur.id_jns_surat
            LEFT JOIN simpus_pelayanan pel ON pel.idpelayanan=sur.id_pelayanan
            LEFT JOIN simpus_loket lok ON pel.loketId=lok.idLoket
            WHERE  sur.id_pelayanan='" . $idpelayanan . "';");
        return $query;
    }

    public function getSuketPasien($idpelayanan)
    {
        $query = $this->db->query("SELECT lok.idLoket,lok.pasienId,pel.idpelayanan,sp.NO_MR,sp.NAMA_LGKP, sp.TMPT_LHR,
            sp.TGL_LHR,am.DESCRIP AS AGAMA,ker.DESCRIP AS PEKERJAAN,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL, anam.beratBadan,
            anam.tinggiBadan,anam.respRate,anam.heartRate,anam.diastole,anam.sistole,lok.keluhan as keluhan_loket,anam.keluhan,anam.tenagaMedis,anam.suhu
            FROM simpus_loket lok
            INNER JOIN simpus_pelayanan pel ON lok.idLoket=pel.loketId
            INNER JOIN simpus_pasien sp ON lok.pasienId=sp.ID
            LEFT JOIN simpus_anamnesa anam ON lok.idLoket=anam.loketId
            LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
            LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
            AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
            LEFT JOIN pkrjn_master ker ON ker.NO=sp.JENIS_PKRJN
            LEFT JOIN agama_master am ON am.NO=sp.AGAMA 
            WHERE pel.idpelayanan='" . $idpelayanan . "';");
        return $query;
    }

    public function getDataSurat($id_surat)
    {
        $pusk_id = $this->ion_auth->unit();
        $query = $this->db->query("SELECT sm.ID_JNS_SURAT,sm.SURAT,sur.no_surat,sp.NAMA_LGKP,sp.TMPT_LHR,sp.TGL_LHR,am.DESCRIP AS agama,
            ker.DESCRIP AS pekerjaan,sp.ALAMAT,kec.NAMA_KEC,NAMA_PROP,NAMA_KAB,lok.kdPoli,
            kel.NAMA_KEL,sp.NO_RT,sp.NO_RW,CASE WHEN anam.rapidTes = 1 THEN 'R' WHEN anam.rapidTes = 2 THEN 'NR' ELSE '' END AS rapid,anam.igg,anam.igm,IF(sp.JENIS_KLMIN='1','Laki-laki','Perempuan') AS jnsKel,
            sur.keperluan,anam.respRate,anam.suhu,anam.heartRate,anam.tinggiBadan,anam.beratBadan,anam.sistole,anam.diastole,lok.tglKunjungan,
            sur.mata_ka_ki,sur.telinga_ka_ki,sur.test_buta_warna,sur.keterangan,sp.NIK,sd.NIP,
            sd.nmDokter,hasil_pemeriksaan,tgl_ijin_awal,tgl_ijin_akhir,tgl_kematian,ket_kematian,
            jam_kematian,DATEDIFF(tgl_ijin_akhir, tgl_ijin_awal) +1 AS selisih 
            FROM surat_keterangan sur 
            INNER JOIN surat_master sm ON sur.id_jns_surat=sm.ID_JNS_SURAT
            INNER JOIN simpus_pelayanan pel ON pel.idpelayanan=sur.id_pelayanan
            INNER JOIN simpus_loket lok ON lok.idLoket=pel.loketId
            INNER JOIN simpus_anamnesa anam ON anam.loketId=lok.idLoket
            INNER JOIN simpus_pasien sp ON sp.id=lok.pasienId 
            LEFT JOIN setup_prop prop ON prop.NO_PROP = sp.NO_PROP
            LEFT JOIN setup_kab kab ON kab.NO_prop=prop.NO_PROP AND sp.NO_kab=kab.NO_KAB
            LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
            LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
            LEFT JOIN pkrjn_master ker ON ker.NO=sp.JENIS_PKRJN
            LEFT JOIN agama_master am ON am.NO=sp.AGAMA
            LEFT JOIN master_dokter sd ON sd.kdDokter=sur.tenagaMedis
            WHERE sur.id_surat='" . $id_surat . "';");
        return $query;
    }

    public function getProfil()
    {
        $pusk_id = $this->ion_auth->unit();
        $query = $this->db->query("SELECT * FROM unit_profiles WHERE unit_id='" . $pusk_id . "';");
        return $query;
    }
    public function getProfil2($pusk_id)
    {
        $query = $this->db->query("SELECT * FROM unit_profiles WHERE unit_id='" . $pusk_id . "';");
        return $query->row();
    }

    // suket rujukk
    public function getSuketRujukPasien($idpelayanan)
    {
        $query = $this->db->query("SELECT lok.idLoket,pel.idpelayanan,sp.NIK,sp.NO_MR,sp.NAMA_LGKP, sp.TMPT_LHR,sp.TGL_LHR,sp.`JENIS_KLMIN`,am.DESCRIP AS AGAMA,
            ker.DESCRIP AS PEKERJAAN,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL,kel.`NO_KEL`,kec.`NO_KEC`,sp.`NO_RT`,sp.`NO_RW`,
            anam.`keluhan`,anam.`keadaanUmum`,anam.beratBadan,anam.tinggiBadan,anam.respRate,anam.heartRate,md.`nmDokter`,poli.`nmPoli`,up.`nama_unit`
            FROM  simpus_loket lok
            INNER JOIN simpus_pelayanan pel ON pel.loketId=lok.idLoket
            LEFT JOIN simpus_anamnesa anam ON anam.loketId=lok.idLoket
            INNER JOIN simpus_pasien sp ON lok.pasienId=sp.ID
            LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
            LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
            LEFT JOIN pkrjn_master ker ON ker.NO=sp.JENIS_PKRJN
            LEFT JOIN agama_master am ON am.NO=sp.AGAMA 
            INNER JOIN master_dokter md ON md.`kdDokter`=pel.`tenagaMedis`
            INNER JOIN simpus_poli_fktp poli ON poli.`kdPoli`=pel.`kdPoli`
            INNER JOIN unit_profiles up ON up.`unit_id`=lok.`puskId`
            WHERE pel.idpelayanan='" . $idpelayanan . "';");
        return $query;
    }

    public function getDataSuratRujukan($id_surat, $val = null)
    {
        $this->db
            ->select("respon_id, sp.NO_MR, sp.NIK, sur.no_surat, sp.NAMA_LGKP,
          IF(sp.JENIS_KLMIN='1','Laki - laki','Perempuan') AS jnsKel,
          sur.NO_HP, sp.TMPT_LHR, sp.TGL_LHR, am.DESCRIP AS agama,
          ker.DESCRIP AS pekerjaan, sp.ALAMAT, kec.NAMA_KEC, kel.NAMA_KEL,
          sp.NO_RT, sp.NO_RW, poli.nmPoli, prov.nmProvider, anam.kdSadar,
          lok.keluhan as keluhan_loket, anam.sistole, anam.diastole,
          anam.respRate, anam.heartRate, sur.NO_HP, diag.kdDiagnosa,
          diag.nmDiagnosa, anam.terapi, nmDokter, UMUR, anam.catatan,
          anam.keluhan, anam.keluhanTambahan, anam.kondisi, sadar.nmSadar,sur.alamat,sur.nama_unit")
            ->from('surat_rujukan sur')
            ->join('simpus_pelayanan pel', 'pel.idpelayanan = sur.id_pelayanan', 'left')
            ->join('simpus_loket lok', 'lok.idLoket = pel.loketId', 'inner')
            ->join('simpus_anamnesa anam', 'anam.loketId = lok.idLoket', 'left')
            ->join('simpus_data_diagnosa diag', 'diag.loketId = lok.idLoket', 'left')
            ->join('simpus_pasien sp', 'sp.id = lok.pasienId', 'inner')
            ->join('simpus_kesadaran sadar', 'anam.kdSadar = sadar.kdSadar', 'left')
            ->join('setup_kec kec', 'kec.NO_KEC = sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP = sp.NO_PROP', 'left')
            ->join('setup_kel kel', 'kel.NO_KEC = sp.NO_KEC AND kel.NO_KEL = sp.NO_KEL AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP = sp.NO_PROP', 'left')
            ->join('pkrjn_master ker', 'ker.NO = sp.JENIS_PKRJN', 'left')
            ->join('agama_master am', 'am.NO = sp.AGAMA', 'left')
            ->join('master_dokter sd', 'sd.kdDokter = sur.tenagaMedis', 'left')
            ->join('simpus_poli_fktl poli', 'poli.kdPoli = sur.kdPoliRujLan', 'left')
            ->join('simpus_provider prov', 'prov.kdProvider = sur.kdppk', 'left');

        // Filter WHERE berdasarkan $val
        if ($val === '0') {
            $this->db->where('sur.id_surat_rujukan', $id_surat);
        } else {
            $this->db->where('sur.respon_id', $id_surat);
        }

        $this->db->limit(1);
        $query = $this->db->get();

        return $query;
    }


    // ========================== CPPT NEW ============================ \\

    function getRiwayatLoket($pasienId)
    {
        $q = $this->db->query("SELECT * FROM simpus_loket a WHERE a.pasienId='" . $pasienId . "' order by a.idLoket desc;");
        return $q;
    }

    function getCountPelayanan($loketId)
    {
        $q = $this->db->query("SELECT count(*) as jmlh FROM simpus_pelayanan a WHERE a.loketId='" . $loketId . "';");
        return $q;
    }

    function getRiwayatPasienNew($loketId)
    {
        $q = $this->db->query("SELECT kp.*,kl.*,ka.*,pol.nmPoli,md.nmDokter,ka.tenagaMedis as tenagaDokter,
            kp.tenagaMedis as kdTngDokter,kp.kdPoli as poliPel FROM simpus_pelayanan kp 
            LEFT JOIN simpus_loket kl ON kp.loketId=kl.idLoket
            LEFT JOIN simpus_anamnesa ka ON ka.loketId=kl.idLoket
            LEFT JOIN master_dokter md ON kp.tenagaMedis=md.kdDokter
            INNER JOIN simpus_poli_fktp pol ON kp.kdPoli=pol.kdPoli
            WHERE kp.loketId='" . $loketId . "' 
            ORDER BY kp.idpelayanan ASC;");
        return $q;
    }

    function getRiwayatDiagnosaPasien($pelId)
    {
        $q = $this->db->query("SELECT * FROM simpus_data_diagnosa a 
            WHERE a.pelayananId='" . $pelId . "';");
        return $q;
    }

    function getRiwayatTindakanPasien($pelId)
    {
        $q = $this->db->query("SELECT a.*,b.nmProsedur FROM simpus_tindakan a 
            left join master_prosedur_gigi b on a.prosedurGigi=b.kdProsedur
            WHERE a.idPelayanan='" . $pelId . "' and a.jnsTindakan='';");
        return $q;
    }
    function getRiwayatTindakanLab($loketId)
    {
        $q = $this->db->query("SELECT a.* FROM simpus_tindakan a 
            WHERE a.loketId='" . $loketId . "' and a.jnsTindakan='Lab';");
        return $q;
    }

    function getRiwayatObatPasien($pelId)
    {
        $q = $this->db->query("SELECT a.* FROM simpus_pakai_obat a 
            WHERE a.pelayananId='" . $pelId . "';");
        return $q;
    }

    function countQrDokter($pelId)
    {
        $qrCount = $this->db->query('SELECT count(*) as jmlh FROM qr_tte qr 
            where qr.pelayananId="' . $pelId . '"');
    }

    function getSignDokter($loketId)
    {
        $sigDokter = $this->db->query('SELECT a.*,b.*,c.nmDokter FROM simpus_anamnesa a 
            LEFT JOIN signature b on a.loketId=b.loketId
            LEFT JOIN master_dokter c on a.tenagaMedis=c.kdDokter
            where a.loketId="' . $loketId . '"');
        return $sigDokter;
    }

    function countSignDokter($loketId)
    {
        $qrCount = $this->db->query('SELECT count(*) as jmlh FROM qr_tte qr 
            where qr.pelayananId="' . $pelId . '"');
    }
    //===============================
    public function getPoliRujukan($kdPoli)
    {
        return $this->db->get_where('simpus_poli_fktl', ['kdPoli' => $kdPoli])->row();
    }
    public function getFaskesRujukan($kdfaskes)
    {
        return $this->db->get_where('simpus_provider', ['kdProvider' => $kdfaskes])->row();
    }
    public function getTenagaMedis($kddokter)
    {
        return $this->db->get_where('master_dokter', ['kdDokter' => $kddokter])->row();
    }
    public function getDiagnosaByPelayananId($pelayanan_id)
    {
        return $this->db
            ->select('kdDiagnosa, nmDiagnosa')
            ->from('simpus_data_diagnosa')
            ->where('pelayananId', $pelayanan_id)
            ->get()
            ->result_array();
    }
}
