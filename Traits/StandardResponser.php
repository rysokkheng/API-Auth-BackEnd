<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait StandardResponser
{
    public function getSuccessResponseArray($message = '', $data = null)
    {
        return ['success' => true, 'http_code' => Response::HTTP_OK, 'data' => $data, 'message' => $message];
    }

    public function getErrorResponseArray($httpCode, $errors, $errorCode = 1)
    {
        if (!is_array($errors)) $errors = [$errors];
        return ['success' => false, 'http_code' => $httpCode, 'error_code' => $errorCode, 'errors' => $errors];
    }
}
