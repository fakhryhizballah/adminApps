<?php

namespace App\Libraries;

use \Firebase\JWT\JWT;
use App\Models\TokenModel;
use App\Models\AdminModel;
use Exception;

class AuthLibaries
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->TokenModel = new TokenModel();
    }

    public function authCek()
    {
        if (empty($_COOKIE['X-Sparum-Token'])) {
            session()->setFlashdata('gagal', 'Anda belum Login');
            return;
        }
        $jwt = $_COOKIE['X-Sparum-Token'];
        try {
            $key = getenv('tokenkey');
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $token = $decoded->Key;
            // dd($token);
            if (empty($this->TokenModel->cek($token))) {
                session()->setFlashdata('gagal', 'Anda sudah Logout, Silahkan Masuk lagi');
                return;
            }
            $nama = $decoded->nama;
            $akun = $this->AdminModel->cek_login($nama);
            return $akun;
        } catch (Exception $exception) {
            session()->setFlashdata('gagal', 'Login Dulu');
            return;
        }
      
    }
}
