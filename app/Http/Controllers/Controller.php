<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response as HttpResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $status_code = HttpResponse::HTTP_OK;


    public function getStatusCode()
    {
        return $this->status_code;
    }


    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }


    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }


    public function responseWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)->responseWithError($message);
    }


    public function respondInternalError($message = 'Internal server error!')
    {
        return $this->setStatusCode(HttpResponse::HTTP_INTERNAL_SERVER_ERROR)->responseWithError($message);
    }


    public function respondCreated($message, $data = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_CREATED)->respond([
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function respondDeleted($message)
    {
        return $this->respond([
            'message' => $message,
        ]);
    }

    public function respondInvalidRequest($message = 'Sorry! Required field is missing')
    {
        return $this->setStatusCode(HttpResponse::HTTP_FORBIDDEN)->responseWithError($message);
    }
}
