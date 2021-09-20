<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ExploreModel;
use App\Models\StasiunModel;
use App\Models\DriverModel;
use App\Models\HistoryModel;
use App\Models\VoucherModel;
use App\Models\TransaksiModel;
use CodeIgniter\I18n\Time;
use App\Libraries\AuthLibaries;

class Admin extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ExploreModel = new ExploreModel();
        $this->StasiunModel = new StasiunModel();
        $this->DriverModel = new DriverModel();
        $this->HistoryModel = new HistoryModel();
        $this->VoucherModel = new VoucherModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->AuthLibaries = new AuthLibaries();
    }
    public function index()
    {
        $akun = $this->AuthLibaries->authCek();
        $tuser = $this->UserModel->countAllResults();
        $tstasiun = $this->StasiunModel->countAllResults();
        $stasiun = $this->StasiunModel->findAll();
        $takeair = $this->UserModel->takeWater();
        $vbaru = $this->VoucherModel->selectSum('nominal')->search('baru');
        $vlama = $this->VoucherModel->selectSum('nominal')->search('lama');
        $sbeli = $this->TransaksiModel->status('expire');

        foreach ($takeair as $row) {
            $totKerd[] = $row->kredit;
        };
        foreach ($takeair as $row) {
            $totDebit[] = $row->debit;
        };
        $ambil =  array_sum($totKerd);

        if (!empty($sbeli)) {
            foreach ($sbeli as $row) {
                // dd($row);
                $totbeli[] = $row->harga;
            };
            $tbeli = array_sum($totbeli);
            // dd($tbeli);
        } else {
            $tbeli = 0;
        }

        $tkerdit = (array_sum($totKerd));
        $tdebit = (array_sum($totDebit));
        // dd($vlama[0]->nominal);
        $data = [
            'title' => 'Dashboard',
            'akun' => $akun,
            'tuser' => $tuser,
            'tstasiun' => $tstasiun,
            'stasiun' => $stasiun,
            'tkerdit' => $tkerdit,
            'tdebit' => $tdebit,
            'tvbaru' => $vbaru[0]->nominal,
            'tvlama' => $vlama[0]->nominal,
            'tbeli' => $tbeli,
            'tambil' => $ambil,
        ];
        return view('admin/index', $data);
    }

    public function admdriver()
    {
        $akun = $this->AuthLibaries->authCek();
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
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'PT / CV',
            'akun' => $akun
        ];
        return view('admin/ptcv', $data);
    }

    public function admuser()
    {
        $akun = $this->AuthLibaries->authCek();
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
        $akun = $this->AuthLibaries->authCek();
        $stasiun = $this->StasiunModel;
        // $all = $this->StasiunModel->lastStatus();
        // $ceks = $this->StasiunModel->statusCek("Office");
        // dd($all);
        // echo json_encode($query);
        $data = [
            'title' => 'Stasiun',
            'stasiun' => $stasiun->findAll(),
            'pager' => $stasiun->pager,
            // 'stasiun' => $stasiun,

            'akun' => $akun
        ];
        return view('admin/stasiun', $data);
    }

    public function admvoucher()
    {
        $akun = $this->AuthLibaries->authCek();
        $cari = "vocher";
        $vocher = $this->VoucherModel->findAll();
        $data = [
            'title' => 'Voucher',
            'vocher' => $vocher,
            'akun' => $akun,

        ];
        return view('admin/voucher', $data);
    }

    public function addStasiun()
    {
        $akun = $this->AuthLibaries->authCek();
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

    public function addvocher()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        if (!$this->validate([
            'nominal' => [
                'rules'  => 'required|min_length[4]|is_natural',
                'errors' => [
                    'required' => '{field} wajid di isi',
                    'min_length' => 'nominal Minimal 1000 mL',
                    'is_natural' => 'Hanya nomor',
                ]
            ],
            'jumlah' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
        ])) {
            $validation = \config\Services::validation();

            // dd($validation->getError('nominal'));
            return redirect()->to('/crtvoucher')->withInput()->with('validation', $validation);
        }
        $myTime = new Time('now');
        $nominal = $this->request->getVar('nominal');
        $jumlah = $this->request->getVar('jumlah');
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < $jumlah; $i++) {
            helper('text');
            $token = random_string('numeric', 4);
            $str = "$faker->city $myTime";
            $kvocher = substr(sha1($str, false), 4, 5);
            $data = [
                'nominal' => $nominal + 0,
                'id_akun' => session()->get('id_akun'),
                'kvoucher' => strtoupper("$token $kvocher"),
                'ket' => "Baru",

            ];
            $this->VoucherModel->addvocher($data);
        }
        return redirect()->to('/admvoucher');
    }

    public function crtmitra()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Mitra',
            'akun' => $akun
        ];
        return view('admin/crt_mitra', $data);
    }

    public function crtdriver()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Driver',
            'akun' => $akun
        ];
        return view('admin/crt_driver', $data);
    }

    public function crtstasiun()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Stasiun',
            'akun' => $akun,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/crt_stasiun', $data);
    }
    public function crtvocher()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Stasiun',
            'akun' => $akun,
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/crt_vocher', $data);
    }
}
