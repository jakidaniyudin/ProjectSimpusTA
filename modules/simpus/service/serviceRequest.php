<?php


class serviceRequest
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        (!class_exists('RequestFactoryForm') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/RequestFactoryForm.php'));
    }

    public function  ManajemenRequest($requestType, $formName, $request)
    {
        if ($requestType == 'form') {
            return (new RequestFactoryForm())->manajemenRequestForm($formName, $request);
        } else {
            throw new Exception('Layanan Not Found Layanan Utama', 404);
        }
    }
}
