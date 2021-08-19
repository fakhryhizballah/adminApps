<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;



class faker extends Controller
{
    public function __construct()
    {

        $this->UserModel = new UserModel();

        $this->email = \Config\Services::email();
        helper('text');
        helper('cookie');
    }
    public function fake()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {

            // dd($items);
            // for ($x = 0; $x < count($nama); $x++) {
            //     echo $nama[$x] . "<br />";
            // }
            // $depan = $nama[0];
            // echo $nama[$items];
            // $belakang = $nama[$x];
            // dd($belakang);
            $depan =  $faker->firstNameFemale;
            $belakang = $faker->lastName;
            // . "<br />"
            helper('text');
            $id = $faker->name;
            // dd($id);
            // $nama = explode(" ", $id);
            $gen = random_string('alnum', 4);
            $id_usr = substr(sha1($id), 0, 8);
            // dd("$gen$id_usr");freeEmail

            // echo $faker->biasedNumberBetween($min = 10, $max = 100, $function = 'sqrt');
            $a = $faker->biasedNumberBetween($min = 10, $max = 100, $function = 'sqrt');
            $b = $faker->biasedNumberBetween($min = 10, $max = 100, $function = 'sqrt');
            // d($faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years'));
            // d($faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'));

            $this->UserModel->save([
                'id_user' => "$gen$id_usr",
                'nama' => "$depan $belakang",
                'nama_depan' => $depan,
                'nama_belakang' => $belakang,
                'email' => "$depan$b@gmail.com",
                'telp' => $faker->PhoneNumber,
                'password' => password_hash($depan, PASSWORD_BCRYPT),
                'profil' => 'user.png',
                'debit' =>  $b * 10,
                'kredit' =>  $a * 10,
                'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years'),
                'updated_at' =>  $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            ]);
        }
        echo ("berhasil ditabah 100");
        // dd($namadepan);
    }
}
