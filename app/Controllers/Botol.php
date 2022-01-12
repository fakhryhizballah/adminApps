<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\AuthLibaries;
use App\Models\BotolModel;


class Botol extends Controller
{
    public function __construct()
    {
        $this->AuthLibaries = new AuthLibaries();
        $this->BotolModel = new BotolModel();
    }

    public function admbotol()
    {
        $akun = $this->AuthLibaries->authCek();
        $botol = $this->BotolModel;
        // $all = $this->StasiunModel->lastStatus();
        // $ceks = $this->StasiunModel->statusCek("Office");
        // dd($all);
        // echo json_encode($query);
        $data = [
            'title' => 'Botol',
            'botol' => $botol->findAll(),
            'pager' => $botol->pager,
            // 'stasiun' => $stasiun,

            'akun' => $akun
        ];
        return view('admin/botol', $data);
    }

    public function deletebotol($id)
    {
        $this->BotolModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to("/admbotol");
    }

    public function editbotol($id)
    {
        session();
        $data = [
            'title' => 'Edit Botol',
            'botol' => $this->BotolModel->where(['id' => $id])->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/editbotol', $data);
    }

    public function updatebotol($id)
    {
        // dd($this->request->getVar());
        $this->BotolModel->save([
            'id' => $id,
            'nama_botol' => $this->request->getVar('nama_botol'),
            'jenis_botol' => $this->request->getVar('jenis_botol'),
            'ukuran_botol' => $this->request->getVar('ukuran_botol')
        ]);

        // dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to("/admbotol");
    }

    public function addidbotol($jumlah)
    {
        $akun = $this->AuthLibaries->authCek();
        helper('text');
        $i = 0;
        $G = 0;
        $B = 0;

        while ($i < $jumlah) {
            // $angkarandom = (rand(1000, 5000));
            // $enkripsi = hash('sha256', $angkarandom);
            // $nilaidepanenkripsi = substr($enkripsi, 2, 10);
            // $upcase = strtoupper($nilaidepanenkripsi);
            // $newidbotol = 'SPA' . $upcase;

            $rand = random_string('alnum', 16);
            $rand2 = random_string('alnum', 5);
            $enkripsi = hash('sha256', $rand);
            $nilaidepanenkripsi = substr($enkripsi, 2, 6);
            $upcase = strtoupper($nilaidepanenkripsi . substr($rand2, 1, 4));
            // dd($upcase);
            $newidbotol = 'SPA' . $upcase;
            $myTime = date("Y-m-d H:i:s");
            $cekidbotol = $this->BotolModel->cek_botol($newidbotol);

            if (empty($cekidbotol)) {
                $this->BotolModel->save([
                    'id_botol' => $newidbotol,
                    'created_at' => $myTime,
                ]);
                $i++;
                $B++;
                // echo ("Berhasil " . $newidbotol);
            } else {
                $G++;
                // echo ("GAGAL " . $newidbotol);
            }
        }
        echo ("Berhasil = " . $B);
        echo "<br/>";
        echo ("Gagal = " . $G);
    }

    public function qrcodeprint($page)
    {

        $data = [
            'title' => 'QR Print',
            'botol' => $this->BotolModel->paginate(48, '', $page),
            'pager' => $this->BotolModel->pager,
            // 'stasiun' => $stasiun,
        ];
        return view('layout/qr_print', $data);
    }
    public function count()
    {
        dd($this->BotolModel->findAll());
    }
}
