<?php

namespace App\Models;

use CodeIgniter\Model;


class StasiunModel extends Model
{
    protected $table            = 'mesin';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'id_mesin',
        'lokasi',
        'lat',
        'lng',
        'link',
        'status',
        'isi',
        'indikator',
        'ket',
    ];
    public function getStasiun($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_mesin' => $id])->getRowArray();
        }
    }

    public function updateStasiun($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_mesin' => $id]);
    }

    public function cek_mesin($id_mesin)
    {
        return $this->db->table('mesin')
            ->where(array('id_mesin' => $id_mesin))
            ->get()->getRowArray();
    }
    public function lastStatus()
    {
        return $this->db->table('mesin')
            ->select('*')->join('log_mesin', 'log_mesin.id_mesin=mesin.id_mesin')
            ->get()->getResult();
    }
    public function statusCek($keyword)
    {
        return $this->table('log_mesin')->like('id_mesin', $keyword)->get()->getResult();
    }
}
