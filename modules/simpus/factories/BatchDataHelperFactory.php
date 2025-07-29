<?php

require_once(APPPATH . 'modules/simpus/interfaces/interfaceBatchDataPacket.php');


class BatchDataHelperFactory
{
    public function batchData($type)
    {
        if ($type === 'kala_4_detail') {
            return new Kala4DetailBatchData();
        } else if ($type === 'apgar') {
            return new ApgarBatchData();
        }
    }
}