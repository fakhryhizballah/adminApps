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
use GuzzleHttp\Psr7;

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

        $UserModel = $this->UserModel;
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join('otp', 'otp.id_user = user.id_user');
        $builder->select('user.id_user, user.nama, user.nama_depan, user.nama_belakang, user.email, user.telp, kredit, debit, otp.status');
        $query = $builder->get()->getResultArray();
        // $user = $UserModel->select(['id_user', 'nama', 'email', 'telp'])->get()->getResultArray();
        // dd($query);
        // $data = ['data' => $user];
        $data = ['data' => $query];
        // dd($data);
        echo json_encode($data);
    }
    public function sendWA()
    {
        $client = new \GuzzleHttp\Client();
        $nohp = $this->request->getVar('noHp');

        $response = $client->request(
            'POST',
            'http://172.16.26.104:8000/send-message',
            ['form_params' => [
                'message' => 'yuhu ',
                'number' => $nohp
            ]]
        );

        echo $response->getStatusCode(); // 200
        echo $response->getHeaderLine('application/x-www-form-urlencoded'); // 'application/json; charset=utf8'
        echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

    }
}
