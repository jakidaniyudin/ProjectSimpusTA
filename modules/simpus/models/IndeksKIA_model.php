<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'core/BaseModel.php';

class IndeksKIA_model extends BaseModel
{
    protected $table = 'pemeriksaan_record';
    protected $table_detail = 'pemeriksaan_record_detail';
    protected $pasien_table = 'simpus_pasien';

    public function chekValidPasien($pasien_id)
    {
        return $this->db->select('*')->from($this->pasien_table)->where($this->pasien_table . '.ID', $pasien_id)->get()->row();
    }

    public function check($pasien_id)
    {
        try {
            $this->db->select('pemeriksaan_record.id, master_layanan.nama as pelayananStatus')
                ->from($this->table)
                ->join('master_layanan', 'pemeriksaan_record.id_layanan = master_layanan.id', 'left')
                ->where('pemeriksaan_record.id_pasien', $pasien_id)
                ->where('pemeriksaan_record.end', null)
                ->order_by('pemeriksaan_record.update_at', 'DESC');
            $data =  $this->db->get()->row();
            if ($data) {
                return $data;
            } else {
                return null;
            }
        } catch (ServiceException $e) {
            throw new  ServiceException('failed request', 500, $e->getMessage());
        }
    }

    public function cekStatusPemeriksaan($id_pasien, $id_layanan)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('id_layanan', $id_layanan);
        $this->db->order_by('update_at', 'DESC');
        $this->db->limit(1);
        $query =  $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function checkPasienTerdaftar($id_pasien, $pelayanan)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('id_layanan', $pelayanan);
        $this->db->where('end', null);
        $this->db->order_by('update_at', 'DESC');
        $this->db->limit(1);
        $query =  $this->db->get($this->table)->row();
        return $query;
    }

    public function create($pasien_id, $id_pelayanan)
    {
        try {
            $create_at = date('Y-m-d H:i:s'); // Format datetime
            $update_at = date('Y-m-d H:i:s');
            $start = date('Y-m-d H:i:s');
            //generate uuid
            $id = $this->uuid->v4();
            //proses insert
            return $this->db->insert($this->table, [
                'id' =>  $id,
                'id_pasien' => $pasien_id,
                'id_layanan' => $id_pelayanan,
                'start' => $start,
                'end' => null,
                'create_at' => $create_at,
                'update_at' => $update_at
            ]);
        } catch (ServiceException $e) {
            throw new ServiceException('request failed', 500, $e->getMessage());
        }
    }

    public function update($id, $reason)
    {
        try {
            $update_at = date('Y-m-d H:i:s');
            $end =  date('Y-m-d H:i:s');
            $this->db->where('id', $id)
                ->update($this->table, [
                    'end' => $end,
                    'reason' =>  $reason,
                    'update_at' => $update_at
                ]);

            return true;
        } catch (ServiceException $e) {
            throw new ServiceException('request failed', 500, $e->getMessage());
        }
    }

    public function akhiriPemeriksaan($id_pelayanan, $reason)
    {
        $data = [
            'end'        => date('Y-m-d H:i:s'),
            'reason'     => $reason,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id_pelayanan);
        return $this->db->update($this->table, $data);
    }

    public function getDetailPemeriksaan($id_pemeriksaan_record)
    {
        $this->db->where('id_pemeriksaan_record', $id_pemeriksaan_record);
        $query = $this->db->get($this->table_detail);
        return $query->result();
    }

    public function countPemeriksaanDetail($id_pemeriksaan_record)
    {
        $this->db->where('id_pemeriksaan_record', $id_pemeriksaan_record);
        $query = $this->db->get($this->table_detail);
        return $query->num_rows();
    }

    public function getCountWeek($pemeriksaan_record)
    {
        $this->db->select('start')->where('id_pemeriksaan_record', $id_pemeriksaan_record);
        $query = $this->db->get($this->table)->row();

        $start = strtotime($query->start);

        //timestamp sekarang
        $now =  time();

        $diff = $now - $start;
        $diff_weeks =  floor($diff / (60 * 60 * 24 * 7));
        return $diff_weeks;
    }

    public function sinkronize($id_pasien, $id_loket, $id_sub_layanan)
    {
        $this->db->select('
        hasil_pemeriksaan.*,
        pemeriksaan_record.id_pasien
       ');
        $this->db->from('pemeriksaan_record');
        $this->db->join('pemeriksaan_record_detail', 'pemeriksaan_record.id = pemeriksaan_record_detail.id_pemeriksaan_record');
        $this->db->join('hasil_pemeriksaan', 'pemeriksaan_record_detail.id = hasil_pemeriksaan.id_pemeriksaan_record_detail');
        $this->db->where('pemeriksaan_record.id_pasien', $id_pasien); // Filter berdasarkan id_pasien
        $this->db->where('pemeriksaan_record_detail.id_loket', $id_loket); // Filter berdasarkan id_loket
        $this->db->where('pemeriksaan_record_detail.id_sub_layanan', $id_sub_layanan); // Filter berdasarkan id_sub_layanan
        $query = $this->db->get();

        return $query->result();
    }
}
