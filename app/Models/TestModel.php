<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table      = 'test';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields    =
    [
        'test',
    ];
    public function cek_botol($id)
    {
        return $this->db->table('botol')
            ->where(array('id_botol' => $id))
            ->get()->getRowArray();
    }
    public function botol($idUser)
    {
        return $this->table('botol')->like('id_user', $idUser)->get()->getResultArray();
        // return $this->table('botol')->like('id_user', $idUser)->get()->getResultObject();
    }
}
