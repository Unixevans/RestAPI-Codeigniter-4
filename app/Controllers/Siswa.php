<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelSiswa;

class Siswa extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelSiswa();
    }
    public function index()
    {
        $data = $this->model->orderBy('id','asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null) {
        $data = $this->model->where('id', $id)->findAll();
        if($data) {
            return $this->respond($data,200);
        }else {
            return $this->failNotFound("Data Tidak Ditemukan untuk ID $id");
        }
        
    }

    public function create() {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'umur' => $this->request->getVar('umur'),
            'kelas' => $this->request->getVar('kelas')
        ];
        // $this->model->save($data);
        if(!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Berhasil memasukkan data Siswa"
            ]
        ];
        return $this->respond($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $isExist = $this->model->where('id',$id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data tidak ditemukan untuk ID $id");
        }

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status'=>201,
            'error'=>null,
            'messages'=>[
                'success'=>"Data siswa dengan ID $id berhasil diupdate"
            ]
        ];
        return $this->respond($response);
    }
    

    public function delete($id = null)
    {
        $data = $this->model->where('id',$id)->find();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status'=>200,
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
