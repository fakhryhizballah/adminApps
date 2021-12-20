<?php

namespace App\Models;

use CodeIgniter\Model;


class FlushModel extends Model
{
    protected $table            = 'new_mesin';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'id_mesin',
        'new_id',
        'nama',
        'faktor',
        'harga',
        'created_at',
        'updated_at',
    ];
    public function getFlush($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_mesin' => $id])->getRowArray();
        }
    }

    public function updateFlush($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_mesin' => $id]);
    }

    public function cek_mesin($id_mesin)
    {
        return $this->db->table('new_mesin')
            ->where(array('id_mesin' => $id_mesin))
            ->get()->getRowArray();
    }
    // public function lastStatus()
    // {
    //     return $this->db->table('new_mesin')
    //         ->select('*')->join('log_mesin', 'log_mesin.id_mesin=mesin.id_mesin')
    //         ->get()->getResult();
    // }
    // public function statusCek($keyword)
    // {
    //     return $this->table('log_mesin')->like('id_mesin', $keyword)->get()->getResult();
    // }
}
