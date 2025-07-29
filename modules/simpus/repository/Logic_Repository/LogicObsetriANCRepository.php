<?php
require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

class LogicObsetriANCRepository  extends BaseLogicAbstract
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('Obstetri_model');
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('PemeriksaanRecordDetail_model');
        $this->CI->load->model('MasterSubLayanan_model');
    }
    public function get($post) {}
    public function set($post, $data = null)
    {
        try {
            $pasien_id = $post['pasienId'];
            $loket_id = $post['loketId'];
            $id_pemeriksaan_record =  $post['actv_service'];
            $id_dokter =  $post['id_dokter'];
            $start =  $post['start'];
            $result = [];

            $id_subLayanan =  $this->CI->MasterSubLayanan_model->getByName('obstetri');
            if ($this->check($pasien_id) != null) {

                if (!empty($this->CI->PemeriksaanRecordDetail_model->getByLoket($loket_id, $id_subLayanan->id))) {

                    $this->CI->PemeriksaanRecordDetail_model->update($start, $id_subLayanan->id, $loket_id);
                    $result = $this->update($post, $data);
                } else {

                    $this->CI->PemeriksaanRecordDetail_model->create($loket_id, $id_pemeriksaan_record, $id_dokter, $id_subLayanan->id, $start);
                   $result =  $this->update($post, $data);
                }
            } else {

                $this->CI->PemeriksaanRecordDetail_model->create($loket_id, $id_pemeriksaan_record, $id_dokter, $id_subLayanan->id, $start);
                $result = $this->create($post, $data);
            }

            return $result;

        } catch (ServiceException $e) {
            throw new ServiceException('failed Request', 500, $e->get_message());
        }
    }

    protected function batchImunisasi($data = null)
    {
        $imunisasiRecords = [];

        for ($i = 1; $i <= 5; $i++) {
            if (!empty($data['tanggal_imunisasi_' . $i])) {
                $dossData = [
                    'doss' => $i,
                    'tanggal' => $data['tanggal_imunisasi_' . $i] ?? null,
                    'no_batch' => $data['no_batch_' . $i] ?? null,
                    'nama_vaksin' => $data['nama_vaksin_' . $i] ?? null,
                ];
                $imunisasiRecords['imunisasi_doss_' . $i] = json_encode($dossData);
            } else {
                $imunisasiRecords['imunisasi_doss_' . $i] = null;
            }
        }

        return $imunisasiRecords;
    }
    public function create($post, $data = null)
    {
        // Main data using $post array access
        $formPusat = [
            'pasienId' => $post['pasienId'],
            'gravida' => $post['gravida'],
            'partus' => $post['partus'],
            'abortus' => $post['abortus'],
            'tphtDate' => $post['tphtDate'],
            'bbSebelumHamil' => $post['bbSebelumHamil'],
            'tinggiBadan' => $post['tinggiBadan'],
            'bb_target' => $post['bb_target'],
            'imt' => $post['imt'],
            'status_imt' => $post['status_imt'],
            'jarak_hamil' => $post['jarak_hamil'],
            'imunisasiTtStatus' => $post['imunisasiTtStatus'] === 'sudah pernah' ? 1 : 0,
        ];

        // Imunisasi data using $data array access
        $imunisasi = [
            'tanggal_imunisasi_1' => $data['tanggal_imunisasi_1'] ?? null,
            'no_batch_1' => $data['no_batch_1'] ?? null,
            'nama_vaksin_1' => $data['nama_vaksin_1'] ?? null,
            'tanggal_imunisasi_2' => $data['tanggal_imunisasi_2'] ?? null,
            'no_batch_2' => $data['no_batch_2'] ?? null,
            'nama_vaksin_2' => $data['nama_vaksin_2'] ?? null,
            'tanggal_imunisasi_3' => $data['tanggal_imunisasi_3'] ?? null,
            'no_batch_3' => $data['no_batch_3'] ?? null,
            'nama_vaksin_3' => $data['nama_vaksin_3'] ?? null,
            'tanggal_imunisasi_4' => $data['tanggal_imunisasi_4'] ?? null,
            'no_batch_4' => $data['no_batch_4'] ?? null,
            'nama_vaksin_4' => $data['nama_vaksin_4'] ?? null,
            'tanggal_imunisasi_5' => $data['tanggal_imunisasi_5'] ?? null,
            'no_batch_5' => $data['no_batch_5'] ?? null,
            'nama_vaksin_5' => $data['nama_vaksin_5'] ?? null,
        ];
        $imunisasi = $this->batchImunisasi($imunisasi);
        $this->CI->Obstetri_model->create($formPusat);
        return [
            'code' => 201,
            'status' => 'success',
            'message' => 'Data berhasil dicreate',
         ];
    }


    public function update($post, $data = null)
    {
        // Mengambil data dari POST request menggunakan $post->post()
        $pasien_id = $post['pasienId']; // Diubah ke bentuk array

        $obsetri = [
            'gravida'           => $post['gravida'],
            'partus'            => $post['partus'],
            'abortus'           => $post['abortus'],
            'tphtDate'          => $post['tphtDate'],
            'bbSebelumHamil'    => $post['bbSebelumHamil'],
            'tinggiBadan'       => $post['tinggiBadan'],
            'bb_target'         => $post['bb_target'],
            'imt'               => $post['imt'],
            'status_imt'        => $post['status_imt'],
            'jarak_hamil'       => $post['jarak_hamil'],
            'imunisasiTtStatus' => $post['imunisasiTtStatus'] === 'sudah pernah' ? 1 : 0,
        ];


        $imunisasi = [
            'tanggal_imunisasi_1' => $data['tanggal_imunisasi_1'] ?? null,
            'no_batch_1' => $data['no_batch_1'] ?? null,
            'nama_vaksin_1' => $data['nama_vaksin_1'] ?? null,
            'tanggal_imunisasi_2' => $data['tanggal_imunisasi_2'] ?? null,
            'no_batch_2' => $data['no_batch_2'] ?? null,
            'nama_vaksin_2' => $data['nama_vaksin_2'] ?? null,
            'tanggal_imunisasi_3' => $data['tanggal_imunisasi_3'] ?? null,
            'no_batch_3' => $data['no_batch_3'] ?? null,
            'nama_vaksin_3' => $data['nama_vaksin_3'] ?? null,
            'tanggal_imunisasi_4' => $data['tanggal_imunisasi_4'] ?? null,
            'no_batch_4' => $data['no_batch_4'] ?? null,
            'nama_vaksin_4' => $data['nama_vaksin_4'] ?? null,
            'tanggal_imunisasi_5' => $data['tanggal_imunisasi_5'] ?? null,
            'no_batch_5' => $data['no_batch_5'] ?? null,
            'nama_vaksin_5' => $data['nama_vaksin_5'] ?? null,
        ];
        $imunisasi = $this->batchImunisasi($imunisasi);
        $finalData =  array_merge($obsetri, $imunisasi);


        // Update data ke database menggunakan model
         $this->CI->Obstetri_model->update($finalData, $pasien_id);
         return [
            'code' => 200,
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
         ];
    }
    public function delete($post) {}

    protected function check($key)
    {
        return ($this->CI->Obstetri_model->getById($key))->row();
    }
}