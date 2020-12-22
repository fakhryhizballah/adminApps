<?php

namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_akun' => 'ADM19',
                'nama' => 'Fakhry',
                'email' => 'Fakhry@gmail.com',
                'password' => '$2y$10$qW2lRi3eNBSweV/SiGZR3uAQIsvXno2a5TuKEHQ5LcmC8n7KtCA4u', //fakhry123
                'profil' => 'user.png',
                'created_at' => '2020-07-16 09:21:28',
                'updated_at' => '2020-07-16 09:21:28'
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
