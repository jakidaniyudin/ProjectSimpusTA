<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/factories/LayananFactory.php');
require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/service/ServiceResponse.php');
class KIA_Navigation extends CI_Controller
{
    protected $response;
    public function __construct()
    {
        parent::__construct();
        $this->response =  new ServiceResponse();
    }
    public function checkStatusPelayanan()
    {
        try {
            $pasien_id =  $this->input->post('pasien_id');
            $result = (LayananFactory::layananManager('ANC'))->checkStatusPelayanan($pasien_id);
            $this->response->send(200, 'berhasil mengechek data', $result);
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setPelayanan()
    {
        try {
            $pasien_id =  $this->input->post('pasien_id');
            $pelayanan =  $this->input->post('pelayanan');
            $result =  Layananfactory::layananManager($pelayanan)->setPelayanan($pasien_id, $pelayanan);
            $this->response->send(200, 'berhasil setPelayanan data');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function akhiriPelayanan()
    {
        try {
            $pasien_id = $this->input->post('pasien_id');
            $pelayanan = $this->input->post('pelayanan');
            $result =  Layananfactory::layananManager($pelayanan)->update($pasien_id, $pelayanan);
            $this->response->send(200, 'berhasil setPelayanan data');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
    public function load_form($layanan, $pasien_id)
    {
        $data['pasien_id'] =  $pasien_id;
        return Layananfactory::layananManager($layanan)->load_form($this->load, $pasien_id); // Pastikan $form_name adalah nama view yang valid
    }
}
