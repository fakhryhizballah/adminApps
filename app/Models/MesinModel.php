<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinModel extends Model
{
    protected $table            = 'new_mesin';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'nama',
        'faktor',
        'harga',
    ];
}
