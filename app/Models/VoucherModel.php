<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table      = 'voucher';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $useTimestamps    = true;

    protected $allowedFields    =
    [
        'id_akun',
        'id_user',
        'kvoucher',
        'nominal',
        'ket',
    ];

    public function carivocher($cari)
    {
        // $builder = $this->tabel('history');
        // $builder->like('id_master', $keyword);
        // return $builder;

        return $this->table('voucher')->like('ket', $cari);
    }

    public function addvocher($data)
    {
        return $this->table('voucher')->insert($data);
    }
    public function search($keyword)
    {
        return $this->table('voucher')->like('ket', $keyword)->get()->getResultArray();
    }
}
