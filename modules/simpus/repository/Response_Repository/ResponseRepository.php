<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/ResponseInterface.php');
class ResponseRepository implements ResponseInterface
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    public function sendMessage($type, $message, $data = null)
    {
        $response = [];
        if ($type == 200 || $type == 201) {
            $response = [
                'status' => true,
                'message' => $message,
                'data' => $data
            ];
        } else {
            $response = [
                'status' => false,
                'message' =>  'failed request',
                'errors' => $message
            ];
            $this->CI->output
                ->set_status_header($type)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }
}
