<?php

namespace App\Controllers;

class RestClient extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRla25vbGFiaWRAZ21haWwuY29tIiwiaWF0IjoxNjgxMzY2ODY3LCJleHAiOjE3MTI5MDI4Njd9.G2PTVCA4xvAN-dEJMJ94-SnSpriDeQMhql27XtHv0nM";
        $url = "http//localhost/api/RestServer/public/siswa";
        $headers = [
            'Authorization' => 'Bearer ' .$token
        ];
        $response = $client->request('GET',$url, ['headers' => $headers]);
        print_r($response);
    }
}
