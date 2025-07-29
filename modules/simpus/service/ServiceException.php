<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ServiceException extends Exception
{
    protected $httpStatusCode;
    protected $errors;
    public function __construct($message, $httpStatusCode = 500, $errors = [], Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->errors =  $errors;
        $this->httpStatusCode = $httpStatusCode;
    }
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function getErrors()
    {
        return $this->errors;
    }

     /**
     * Ekstrak dan konversi OperationOutcome.issue[] menjadi errors
     */
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