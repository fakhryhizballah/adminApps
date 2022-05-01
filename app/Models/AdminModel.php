<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // protected $table      = 'admin';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $useTimestamps    = true;
    // protected $allowedFields    =
    // [
    //     'id_akun',
    //     'nama',
    //     'email',
    //     'password',
    //     'profil',
    // ];

    public function cek_login($nama)
    {
        return $this->db->table('user')
        ->join('level', 'level.id_akun = user.id_user')
            ->where(array('nama' => $nama))
            ->orWhere(array('email' => $nama))
            ->get()->getRowArray();
    }
}
