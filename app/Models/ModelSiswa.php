<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model 
{
    protected $table = "siswa";
    protected $primarykey = "id";
    protected $allowedFields = ['nama', 'umur', 'kelas'];

    protected $validationRules = [
        'nama' =>'required',
        'umur' =>'required',
        'kelas' =>'required'
    ];
    protected $validationMessages = [
        'nama' =>[
            'required'=>'Sliahkan masukkan nama'
        ],
        'umur' =>[
            'required'=>'Silahkan masukkan umur'
        ],
        'kelas' =>[
            'required'=>'Silahkan masukkan kelas'
        ]
    ];
}

?>