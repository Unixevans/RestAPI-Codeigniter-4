<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelData;

class Data extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelData();
    }
    public function index()
    {
        $datas = $this->model->orderBy('id', 'asc')->findAll();
        return $this->respond($datas, 200);
    }

    public function show($id = null)
    {
        $datas = $this->model->where('id', $id)->findAll();
        if ($datas) {
            return $this->respond($datas, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan");
        }
    }

    public function create()
    {
        $datas = [
            'nilai' => $this->request->getVar('nilai')
        ];
        // $this->model->save($datas);
        if (!$this->model->save($datas)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Berhasil memasukkan data ke dalam tabel Data"
            ]
        ];
        return $this->respond($response);
    }

    public function update($id = null)
    {
        $datas = $this->request->getRawInput();
        $datas['id'] = $id;

        $isExist = $this->model->where('id', $id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }

        if (!$this->model->save($datas)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Data siswa dengan id $id berhasil diupdate"
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $datas = $this->model->where('id', $id)->findAll();
        if ($datas) {
            $this->model->delete($id);
            $response = [
                'status'=> 200,
                'error'=>null,
                'messages'=>[
                    'success'=>"Data berhasil dihapus"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}



?>