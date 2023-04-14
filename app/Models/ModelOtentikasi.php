<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;


class ModelOtentikasi extends Model 
{
    protected $table = "otentikasi";
    protected $primaryKey = "id";
    protected $allowedFields = ['email', 'password'];


    function getEmail($email) 
    {
        $builder = $this->table("otentikasi");
        $data = $builder->where("email", $email)->first();
        if (!$data) {
            throw new Exception("Data Otentikasi Tidak Ditemukan");
        }
        return $data;
    }
}



?>