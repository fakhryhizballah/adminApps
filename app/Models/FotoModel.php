<?php

namespace App\Models;

use CodeIgniter\Model;


class FotoModel extends Model
{
    protected $table            = 'fotoMaps';
    protected $useTimestamps    = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $primaryKey = 'id';
    protected $allowedFields    = [
        'id_lokasi',
        'foto',
    ];
    public function getDetail($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_lokasi' => $id])->getResultArray();
        }
    }
}
