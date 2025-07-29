<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ServiceResponse
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function send($statusCode, $message, $data = [], $errors = [])
    {
        $response  = [
            'status' => $statusCode >= 200 && $statusCode < 300 ? 'success' : 'error',
            'message' =>  $message,
        ];

        if (!empty($data)) {
            $response['data'] =  $data;
        }

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        $this->CI->output
            ->set_status_header($statusCode)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function parseIssues(array $response)
    {
        $errors = [];

        if (isset($response['resourceType']) && $response['resourceType'] === 'OperationOutcome' && isset($response['issue'])) {
            foreach ($response['issue'] as $issue) {
                $errors[] = [
                    'severity' => $issue['severity'] ?? 'error',
                    'code' => $issue['code'] ?? '',
                    'details' => $issue['details']['text'] ?? '',
                    'expression' => $issue['expression'][0] ?? null
                ];
            }
        }

        return $errors;
    }
}