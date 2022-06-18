<?php

namespace App\Models;

use CodeIgniter\Model;


class LokasiModel extends Model
{
    protected $table            = 'map';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'id_lokasi',
        'id_stasiun',
        'nama',
        'jenis',
        'geo',
        'gmaps',
        'keterangan',
    ];
    public function getLokasi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_lokasi' => $id])->getRowArray();
        }
    }


    public function updateLokasi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_lokasi' => $id]);
    }

    public function cek_lokasi($id_lokasi)
    {
        return $this->db->table('map')
            ->where(array('id_lokasi' => $id_lokasi))
            ->get()->getRowArray();
    }
}
