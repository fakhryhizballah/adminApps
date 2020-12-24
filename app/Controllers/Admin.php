<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ExploreModel;
use App\Models\StasiunModel;
use App\Models\DriverModel;
use App\Models\HistoryModel;


class Admin extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->UserModel = new UserModel();
        $this->ExploreModel = new ExploreModel();
        $this->StasiunModel = new StasiunModel();
        $this->DriverModel = new DriverModel();
        $this->HistoryModel = new HistoryModel();
    }
    public function index()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $tuser = $this->UserModel->findAll();
        $tstasiun = $this->StasiunModel->findAll();
        $takeair = $this->UserModel->takeWater();
        foreach ($takeair as $row) {
            $totKerd[] = $row->kredit;
        }
        foreach ($takeair as $row) {
            $totDebit[] = $row->debit;
        }

        $tkerdit = (array_sum($totKerd));
        $tdebit = (array_sum($totDebit));
        //dd($akun);
        $data = [
            'title' => 'Dashboard',
            'akun' => $akun,
            'tuser' => $tuser,
            'tstasiun' => $tstasiun,
            'tkerdit' => $tkerdit,
            'tdebit' => $tdebit
        ];
        return view('admin/index', $data);
    }

    public function admdriver()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $driver = $this->DriverModel->findAll();
        $data = [
            'title' => 'Driver',
            'akun' => $akun,
            'driver' => $driver
        ];
        return view('admin/driver', $data);
    }

    public function ptcv()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'PT / CV',
            'akun' => $akun
        ];
        return view('admin/ptcv', $data);
    }

    public function admuser()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $UserModel = $this->UserModel;
        $user = $UserModel->findAll();

        // dd($user);
        $data = [
            'title' => 'User',
            'user' => $user,
            'pager' => $UserModel->pager,
            'akun' => $akun

        ];
        return view('admin/user', $data);
    }

    public function admstasiun()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $stasiun = $this->StasiunModel;
        $data = [
            'title' => 'Stasiun',
            'stasiun' => $stasiun->findAll(),
            'pager' => $stasiun->pager,
            // 'stasiun' => $stasiun,

            'akun' => $akun
        ];
        return view('admin/stasiun', $data);
    }

    public function addStasiun()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        //validasi
        if (!$this->validate([
            'nama' => [
                'rules'  => 'required|alpha_dash|is_unique[mesin.lokasi]',
                'errors' => [
                    'required' => '{field} wajid di isi',
                    'is_unique' => 'Nama Account sudah terdaftar'
                ]
            ],
            'lat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'lng' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'link' => [
                'rules'  => 'required|alpha_dash|is_unique[mesin.link]',
                'errors' => [
                    'required' => '{field} wajid di isi',
                    'alpha_dash' => 'Tidak boleh mengunakan spasi',
                    'is_unique' => 'Link sudah terdaftar'
                ]
            ],
        ])) {
            $validation = \config\Services::validation();

            return redirect()->to('/crtstasiun')->withInput()->with('validation', $validation);
        }
        $lokasi = $this->request->getVar('nama');
        $lat = $this->request->getVar('lat');
        $lng = $this->request->getVar('lng');
        $link = $this->request->getVar('link');
        $id_mesin = substr(sha1($lokasi), 0, 8);
        $this->StasiunModel->save([
            'id_mesin' => strtoupper("SP$id_mesin"),
            'lokasi' => ucfirst($lokasi),
            'lat' => $lat,
            'lng' => $lng,
            'link' => $link,
            'status' => '1',
            'isi' => '0',
            'indikator' => '0',
            'ket' => 'Belum Beroperasi',

        ]);
        $this->HistoryModel->save([
            'id_master' => $akun['id_akun'],
            'Id_slave' => strtoupper("SP$id_mesin"),
            'Lokasi' => $lokasi,
            'status' => 'Stasiun Baru'
        ]);
        session()->setFlashdata('Berhasil', 'Stasiun Berhasil Di tambahkan, Perlu Konfigurasi');
        return redirect()->to('/admstasiun');
    }

    public function crtmitra()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Mitra',
            'akun' => $akun
        ];
        return view('admin/crt_mitra', $data);
    }

    public function crtdriver()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Driver',
            'akun' => $akun
        ];
        return view('admin/crt_driver', $data);
    }

    public function crtstasiun()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Stasiun',
            'akun' => $akun,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/crt_stasiun', $data);
    }
}
