<?php
require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

class LogicKala4DetailRepository  extends BaseLogicAbstract
{

    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->library('uuid');
        $this->CI->load->model('PemeriksaanRecordDetail_model');
        $this->CI->load->model('HasilPemeriksaan_model');
        $this->CI->load->model('MasterSubLayanan_model');
    }

    public function get($post) {}
    public function set($post, $data)
    {
        try {
            //load for input
            $loket_id =  $post->post('loket_id');
            $start = $post->post('start');
            $id_pemeriksaan_record =  $post->post('actv_service');
            $id_dokter =  $post->post('id_dokter');
            // mengambil id_subLayanan
            $id_subLayanan =  $this->CI->MasterSubLayanan_model->getByName('kala4Detail');

            //set pemerisaan record set
            $id_record_detail = $this->setRecordDetail($loket_id, $start, $id_subLayanan->id, $id_pemeriksaan_record, $id_dokter);
            //check id record detail
            if ($id_record_detail != null) {
                // check id tersedia ? 
                if (!empty($this->check($id_record_detail))) {
                    $this->delete($id_record_detail);
                    return $this->create($data, $id_record_detail);
                } else {
                    // buat baru
                    return $this->create($data, $id_record_detail);
                }
            } else {
                throw new ServiceException('tidak ditemukan data yang id record', 500);
            }
        } catch (Exception $e) {
            throw new  ServiceException('failed sistem ', 500, $e->getMessage());
        }
    }

    public function create($data, $id_record_detail)
    {

        $batchResult = $this->BatchDataHelper($data, $id_record_detail);
        $this->CI->HasilPemeriksaan_model->create($batchResult);
    }

    protected function setRecordDetail($loket_id, $start, $id_subLayanan, $id_pemeriksaan_record, $id_dokter)
    {
        $id_record_detail =  null;

        if (!empty($this->CI->PemeriksaanRecordDetail_model->getByLoket($loket_id, $id_subLayanan))) {
            $id_record_detail = ($this->CI->PemeriksaanRecordDetail_model->getByLoket($loket_id, $id_subLayanan))->id;
            //melakukan proses update
            $this->CI->PemeriksaanRecordDetail_model->update($start, $id_subLayanan, $loket_id);
        } else {
            //melakukan proses create baru jika loket berbeda
            $id_record_detail =  $this->CI->PemeriksaanRecordDetail_model->create($loket_id, $id_pemeriksaan_record, $id_dokter, $id_subLayanan, $start);
        }
        return $id_record_detail;
    }


    protected function BatchDataHelper($data, $id_record_detail)
    {
        $batchData = [];
        $create_at = date('Y-m-d H:i:s');
        $update_at = date('Y-m-d H:i:s');

        foreach ($data as $key => $detail) {
            if (!isset($detail['value']) || !is_array($detail['value'])) {
                continue; // Skip jika tidak valid
            }

            $jsonValue = json_encode($detail['value']);

            $batchData[] = [
                'id' => $this->CI->uuid->v4(),
                'id_pemeriksaan_record_detail' => $id_record_detail,
                'atribut' => $key, // seperti 'waktuKe2'
                'jawaban' => $jsonValue, // seluruh value jadi JSON string
                'create_at' => $create_at,
                'update_at' => $update_at
            ];
        }

        return $batchData;
    }


    protected function BatchUpdateDataHelper($data)
    {
        $batchData = [];
        $update_at = date('Y-m-d H:i:s');

        // Loop melalui setiap elemen dalam $data
        foreach ($data as $index => $detail) {
            // Loop melalui setiap atribut dalam elemen detail
            foreach ($detail as $atribut => $value) {
                // Pastikan 'value' ada dan tidak kosong
                if (isset($atribut['value']) && isset($atribut['id'])) {
                    $batchData[] = [
                        'id' => $value['id'] ?? null, // Jika 'id' tidak ada, gunakan null
                        'atribut' => $atribut, // Menyimpan nama atribut (misalnya, 'waktuKe', 'waktu', dll.)
                        'jawaban' => json_encode(['value' => $value['value']]),
                        'update_at' => $update_at
                    ];
                } {
                    break;
                }
            }
        }

        return $batchData;
    }

    public function update($data, $id_record_detail = null)
    {
        // $batchResult = $this->BatchUpdateDataHelper($data);

        // if (empty($batchResult)) {
        //     throw new ServiceException('not found for collection id and value in logic kala 4 Detail', 400);
        // }
        // return $this->CI->HasilPemeriksaan_model->update($batchResult);
    }
    public function delete($post)
    {
        return $this->CI->HasilPemeriksaan_model->deleteByPemeriksaanRecordDetail($post);
    }
    protected function check($id_pemeriksaan_record_detail)
    {
        return $this->CI->HasilPemeriksaan_model->getByRecordDetail($id_pemeriksaan_record_detail);
    }
}