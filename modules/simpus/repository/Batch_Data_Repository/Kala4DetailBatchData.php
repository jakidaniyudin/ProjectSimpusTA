<?php

require_once(APPPATH . 'modules/simpus/interfaces/interfaceBatchDataPacket.php');

class Kala4DetailBatchData implements interfaceBatchDataPacket
{

    protected $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function batchHelper($data, $parameter)
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
}