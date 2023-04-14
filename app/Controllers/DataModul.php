<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelDataModul;


class DataModul extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelDataModul();
    }
    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk ID $id");
        }

    }

    public function create()
    {
        $data = [
            'tagId' => $this->request->getVar('tagId'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'timestamp' => $this->request->getVar('timestamp')
        ];

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Berhasil memasukkan data ke datamodul"
            ]
        ];
        return $this->respond($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $isExist = $this->model->where('id', $id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Data datamodul dengan Id $id berhasil diupdate"
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data berhasil dihapus"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}




?>