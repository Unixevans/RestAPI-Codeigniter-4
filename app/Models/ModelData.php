<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelData extends model
{
    protected $table = "data";
    protected $primaryKey = "id";
    protected $allowedFields = ['nilai'];

    protected $validationRules = [
        'nilai' => 'required'
    ];
    protected $validationMessages = [
        'nilai' =>[
            'required'=>'Silahkan masukkan nilai'
        ]
    ];
}


?>