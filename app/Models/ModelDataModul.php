<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDataModul extends Model
{
    protected $table = "datamodul";
    protected $primarykey = "id";
    protected $allowedFields = ['tagId', 'latitude', 'longitude', 'timestamp'];

    protected $validationRules = [
        'tagId' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'timestamp' => 'required'
    ];

    protected $validationMessages = [
        'tagId' =>[
            'required' => 'Silahkan masukkan tagId'
        ],
        'latitude' =>[
            'required' => 'Silahkan masukkan latitude'
        ],
        'longitude' =>[
            'required' => 'Silahkan masukkan longitude'
        ],
        'timestamp' =>[
            'required' => 'Silahkan masukkan timestamp'
        ]
    ];
}



?>