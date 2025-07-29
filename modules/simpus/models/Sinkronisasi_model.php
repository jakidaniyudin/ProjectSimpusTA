<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sinkronisasi_model extends CI_Model
{

    public function get_data_kunjungan($tahun, $limit)
    {
        $this->db->select([
            'lok.idLoket AS id_loket',
            'pas.ID AS id_pasien',
            'lok.tglKunjungan AS tanggal_kunjungan',
            'pas.NIK AS nik',
            'pas.NAMA_LGKP AS nama_pasien',
            'pas.JENIS_KLMIN AS jenis_kelamin',
            'pas.TGL_LHR AS tanggal_lahir',
            'lok.umur',
            'lok.kelUmur AS kelompok_umur',
            'pas.alamat',
            'pas.NO_RT AS rt',
            'pas.no_rw AS rw',
            'pas.no_prop',
            'prop.nama_prop',
            'kab.no_kab',
            'kab.nama_kab',
            'kec.no_kec',
            'kec.nama_kec',
            'kel.no_kel',
            'kel.nama_kel',
            'lok.tglKunjungan',
            "IF(lok.kdTkp = '10', 'TRUE', 'FALSE') AS rawat_jalan",
            'lok.kunjBaru AS kunjungan_baru',
            "IF(lok.noKartu != '', 'BPJS', 'NON BPJS') AS kepesertaan",
            'pas.noKartu AS no_bpjs',
            'pas.kdProvider AS kode_faskes_bpjs',
            'lok.providerKartu AS nama_faskes_bpjs',
            'dmu.kategori',
            'unitDetail.nama_unit AS nama_faskes_pemeriksa',
            'lok.createdBy AS created_by_aplikasi',
            'lok.createdDate AS created_date_aplikasi'
        ]);

        $this->db->from('simpus_loket lok');
        $this->db->join('simpus_pasien pas', 'pas.ID = lok.pasienId', 'inner');

        $this->db->join('setup_prop prop', 'prop.NO_PROP = pas.NO_PROP', 'left');
        $this->db->join('setup_kab kab', 'kab.NO_PROP = prop.NO_PROP AND kab.NO_KAB = pas.NO_KAB', 'left');
        $this->db->join('setup_kec kec', 'kec.NO_PROP = prop.NO_PROP AND kec.NO_KAB = kab.NO_KAB 
            AND kec.NO_PROP = pas.NO_PROP AND kec.NO_KAB = pas.NO_KAB AND kec.NO_KEC = pas.NO_KEC', 'left');
        $this->db->join('setup_kel kel', 'kel.NO_PROP = prop.NO_PROP AND kel.NO_KAB = kel.NO_KAB 
            AND kel.NO_KEC = kec.NO_KEC AND kel.NO_PROP = pas.NO_PROP AND kel.NO_KAB = pas.NO_KAB 
            AND kel.NO_KEC = pas.NO_KEC AND kel.NO_KEL = pas.NO_KEL', 'left');
        $this->db->join('unit_profiles up', 'lok.puskId = up.unit_id', 'inner');
        $this->db->join('data_master_unit_detail unitDetail', 'unitDetail.id_detail = lok.unitId', 'inner');
        $this->db->join('data_master_unit dmu', 'dmu.id_kategori = unitDetail.id_kategori', 'inner');
        //where filter
        $this->db->where('YEAR(lok.tglKunjungan)', $tahun);
        $this->db->where('idResponRekamMedik', NULL);
        $this->db->order_by('lok.tglKunjungan', 'ASC');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result();
    }
    function get_data_pelayanan($id_loket)
    {
        $this->db->select('sp.idPelayanan, poli.kdPoli, poli.nmPoli, md.nmDokter');
        $this->db->from('simpus_pelayanan sp');
        $this->db->join('simpus_poli_fktp poli', 'sp.kdPoli = poli.kdPoli', 'inner');
        $this->db->join('master_dokter md', 'md.kdDokter = sp.tenagaMedis', 'left');
        $this->db->where('sp.loketId', $id_loket);
        $this->db->order_by('sp.createdDate', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    function get_data_diagnosa($id_pelayanan)
    {
        $this->db->select('pel.idpelayanan, 
            pel.loketId, 
            sdd.kdDiagnosa, 
            sdd.nmDiagnosa,
            sd.kategori_penyakit,
            sdk.kasus');
        $this->db->from('simpus_pelayanan pel');
        $this->db->join('simpus_poli_fktp poli', 'poli.kdPoli = pel.kdPoli', 'inner');
        $this->db->join('simpus_data_diagnosa sdd', 'sdd.pelayananId = pel.idpelayanan', 'inner');
        $this->db->join('simpus_diagnosa sd', 'sd.kdDiag=sdd.kdDiagnosa', 'inner');
        $this->db->join('master_diagnosa_kasus sdk', 'sdd.diagnosaKasus=sdk.id', 'inner');
        $this->db->where('sdd.pelayananId', $id_pelayanan);
        $this->db->order_by('pel.createdDate', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_data_obat($id_pelayanan)
    {
        $this->db->select('o.NAMA, d.jumlah, d.dosis_pakai');
        $this->db->from('simpus_resep_obat r');
        $this->db->join('simpus_resep_detail d', 'r.id_resep = d.resep_id', 'inner');
        $this->db->join('simpus_master_obat o', 'o.OBAT_ID = d.obat_id', 'inner');
        $this->db->where('pelayananId', $id_pelayanan);

        $query = $this->db->get();
        return $result = $query->result();
    }
    public function get_data_tindakan($id_pelayanan)
    {
        $this->db->select('kdTindakan,nmTindakan,ketGigi');
        $this->db->from('simpus_tindakan');
        $this->db->where('idPelayanan', $id_pelayanan);
        $this->db->where('deskripsi', 'icd9cm');


        $query = $this->db->get();
        return $result = $query->result();
    }

    public function get_data_anamnesa($loketId)
    {
        $this->db->select('loketId,sk.nmSadar, sa.keadaanUmum, sa.tinggiBadan, sa.beratBadan, sa.lingkarPerut, sa.sistole, sa.diastole, sa.heartRate, sa.respRate, sa.imt, sa.imtKet, sa.keluhan, sa.keluhanTambahan,nmDokter');
        $this->db->from('simpus_anamnesa sa');
        $this->db->join('simpus_kesadaran sk', 'sa.kdSadar = sk.kdSadar');
        $this->db->join('master_dokter md', 'sa.tenagaMedisAskep=md.kdDokter', 'left');
        $this->db->where('sa.loketId', $loketId);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }
    public function get_data_rujukan($loketId)
    {
        $this->db->select('loketID,jnsRujukLanjut as jenis_rujuk,tglEstRujuk,kdppk as kode_faskes_rujukan,nmppk as nama_faskes_rujukan,catatan');
        $this->db->from('simpus_rujuk_lanjut rjl');
        $this->db->where('rjl.loketID', $loketId);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }
    function get_data_lab($loketId)
    {
        $this->db->select("spl.loketId, smpl.kode, smpl.nmPemeriksaan, st.nilaiLab, smpl.nilaiNormal, smpl.nilaiKritis, 
                   IF(st.statusNilaiKritis = '1', 'Nilai kritis', '-') AS keterangan");
        $this->db->from('simpus_permohonan_lab spl');
        $this->db->join('simpus_tindakan st', 'st.permohonanId = spl.idPermohonan', 'inner');
        $this->db->join('simpus_master_pemeriksaan_lab smpl', 'smpl.idPemeriksaan = st.pemeriksaanId', 'inner');
        $this->db->where('spl.loketId', $loketId);

        $query = $this->db->get();
        return $result = $query->result();
    }

    public function update_response_id($id_loket, $id_response)
    {
        // Update tabel kunjungan
        $this->db->where('idLoket', $id_loket);
        $this->db->update('simpus_loket', ['idResponRekamMedik' => $id_response]);
    }
}
