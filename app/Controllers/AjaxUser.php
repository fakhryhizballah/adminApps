<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ExploreModel;
use App\Models\StasiunModel;
use App\Models\DriverModel;
use App\Models\HistoryModel;
use App\Models\VoucherModel;
use App\Models\TransaksiModel;
use CodeIgniter\I18n\Time;


class AjaxUser extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->UserModel = new UserModel();
        $this->ExploreModel = new ExploreModel();
        $this->StasiunModel = new StasiunModel();
        $this->DriverModel = new DriverModel();
        $this->HistoryModel = new HistoryModel();
        $this->VoucherModel = new VoucherModel();
        $this->TransaksiModel = new TransaksiModel();
    }

    public function GetTotalUser()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }

        $tuser = $this->VoucherModel->selectSum('nominal')->search('Baru');

        echo json_encode($tuser);
    }
}
