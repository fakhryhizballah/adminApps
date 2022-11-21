<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ExploreModel;
use App\Models\StasiunModel;
use App\Models\LokasiModel;
use App\Models\FlushModel;
use App\Models\DriverModel;
use App\Models\HistoryModel;
use App\Models\VoucherModel;
use App\Models\TransaksiModel;
use CodeIgniter\I18n\Time;
use App\Libraries\AuthLibaries;
use App\Models\OtpModel;

class Admin extends Controller
{
    public function __construct()
    {
        helper('text');
        $this->UserModel = new UserModel();
        $this->ExploreModel = new ExploreModel();
        $this->StasiunModel = new StasiunModel();
        $this->LokasiModel = new LokasiModel();
        $this->FlushModel = new FlushModel();
        $this->DriverModel = new DriverModel();
        $this->HistoryModel = new HistoryModel();
        $this->VoucherModel = new VoucherModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->AuthLibaries = new AuthLibaries();
        $this->OtpModel = new OtpModel();
    }
    public function index()
    {
        $akun = $this->AuthLibaries->authCek();
        // dd($akun);
        $tuser = $this->OtpModel->countAllResults();
        $tstasiun = $this->StasiunModel->countAllResults();
        $stasiun = $this->StasiunModel->findAll();
        $vbaru = $this->VoucherModel->selectSum('nominal')->search('baru', $akun['id_akun']);
        $vlama = $this->VoucherModel->selectSum('nominal')->search('lama', $akun['id_akun']);
        $sbeli = $this->TransaksiModel->status('expire');
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('kredit, debit, otp.created_at');
        $builder->join('otp', 'otp.id_user = user.id_user');
        $query = $builder->get()->getResult();
        // dd($query);
        foreach ($query as $row) {
            $totKerd[] = $row->kredit;
        };
        foreach ($query as $row) {
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
            'tvbaru' => $vbaru[0]['nominal'],
            'tvlama' => $vlama[0]['nominal'],
            'tbeli' => $tbeli,
            'tambil' => $ambil,
            'total' => $tkerdit + $tdebit,
            'level' => $akun['level'],
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
            'driver' => $driver,
            'level' => $akun['level'],
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
        $data = [
            'title' => 'User',
            'akun' => $akun,
            // 'level' => $akun['level'],
            
        ];
        return view('admin/user', $data);
    }

    public function admstasiun()
    {
        $akun = $this->AuthLibaries->authCek();
        $stasiun = $this->StasiunModel;

        $data = [
            'title' => 'Stasiun',
            'stasiun' => $stasiun->findAll(),
            'pager' => $stasiun->pager,
            // 'stasiun' => $stasiun,
            'akun' => $akun,
            'level' => $akun['level'],
            'socket' => getenv('soket.url'),
        ];
        return view('admin/stasiun', $data);
    }

    public function admlokasi()
    {
        $akun = $this->AuthLibaries->authCek();
        $lokasi = $this->LokasiModel->getLokasi();
        // $all = $this->StasiunModel->lastStatus();
        // $ceks = $this->StasiunModel->statusCek("Office");
        // dd($all);
        // echo json_encode($query);
        $data = [
            'title' => 'Lokasi',
            'lokasi' => $lokasi,
            // 'stasiun' => $stasiun,
            'validation' => \Config\Services::validation(),
            'akun' => $akun,
            'level' => $akun['level'],
            'socket' => getenv('soket.url'),
        ];
        return view('admin/lokasi', $data);
    }
    public function admsetmesin()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Setting Mesin',
            'validation' => \Config\Services::validation(),
            'akun' => $akun,
            'level' => $akun['level'],
            'socket' => getenv('soket.url'),
        ];
        return view('admin/mesin', $data);
    }

    public function admflush()
    {
        $akun = $this->AuthLibaries->authCek();
        $flush = $this->FlushModel;
        // $all = $this->FlushModel->lastStatus();
        // $ceks = $this->FlushModel->statusCek("Office");
        // dd($all);
        // echo json_encode($query);
        $data = [
            'title' => 'Flush',
            'flush' => $flush->findAll(),
            'pager' => $flush->pager,
            // 'flush' => $flush,
            'akun' => $akun,
            'level' => $akun['level'],
        ];
        return view('admin/flush', $data);
    }

    public function admvoucher()
    {
        $akun = $this->AuthLibaries->authCek();
        $cari = "vocher";
        $vocher = $this->VoucherModel->search('Baru', $akun['id_akun']);
        // dd($vocher);
        $data = [
            'title' => 'Voucher',
            'vocher' => $vocher,
            'akun' => $akun,
            'level' => $akun['level'],

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

    public function addlokasi()
    {
        $akun = $this->AuthLibaries->authCek();
        if (!$this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'jenis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'geo' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'gmaps' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'keterangan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
        ])) {
            $validation = \config\Services::validation();

            // dd($validation->getError('nominal'));
            return redirect()->to('/crtlokasi')->withInput()->with('validation', $validation);
        }
        // $rdm = random_string('alnum', 16);
        $rdm = random_string('alnum', 16);
        $id_lokasi = $this->LokasiModel->where('id_lokasi', $rdm)->get()->getRowArray();
        while ($id_lokasi != null) {
            $rdm = random_string('alnum', 16);
            $id_lokasi = $this->LokasiModel->where('id_lokasi', $rdm)->get()->getRowArray();
        }

        $this->LokasiModel->save([
            'id_lokasi' => $rdm,
            'id_user' => $akun['id_akun'],
            'nama' => $this->request->getVar('nama'),
            'jenis' => $this->request->getVar('jenis'),
            'geo' => $this->request->getVar('geo'),
            'gmaps' => $this->request->getVar('gmaps'),
            'keterangan' => $this->request->getVar('keterangan'),
        ]);


        session()->setFlashdata('Berhasil', 'Lokasi Berhasil Di tambahkan');
        return redirect()->to('/admlokasi');
    }

    public function editlokasi()
    {
        $akun = $this->AuthLibaries->authCek();

        if (!$this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'jenis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'geo' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'gmaps' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
            'keterangan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajid di isi',
                ]
            ],
        ])) {
            $validation = \config\Services::validation();

            // dd($validation->getError('nominal'));
            return redirect()->to('/admlokasi')->withInput()->with('validation', $validation);
        }
        $id = $this->request->getVar('id_lokasi');

        $data = ([
            'nama' => $this->request->getVar('nama'),
            'jenis' => $this->request->getVar('jenis'),
            'geo' => $this->request->getVar('geo'),
            'gmaps' => $this->request->getVar('gmaps'),
            'keterangan' => $this->request->getVar('keterangan'),
        ]);

        $this->LokasiModel->updateLokasi($data, $id);
        session()->setFlashdata('Berhasil', 'Lokasi Berhasil Di tambahkan');
        return redirect()->to('/admlokasi');
    }

    public function addvocher()
    {
        $akun = $this->AuthLibaries->authCek();
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
        $nominal = $this->request->getVar('nominal');
        $jumlah = $this->request->getVar('jumlah');
        for ($i = 0; $i < $jumlah; $i++) {
            helper('text');
            $token = random_string('numeric', 4);
            $str = uniqid();
            $kvocher = substr(sha1($str, false), 4, 5);
            $data = [
                'nominal' => $nominal + 0,
                'id_akun' => $akun['id_akun'],
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
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/crt_stasiun', $data);
    }
    public function crtlokasi()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Lokasi',
            'akun' => $akun,
            'validation' => \Config\Services::validation(),
            'level' => $akun['level'],
        ];
        return view('admin/crt_lokasi', $data);
    }
    public function crtvocher()
    {
        $akun = $this->AuthLibaries->authCek();
        $data = [
            'title' => 'Create Stasiun',
            'akun' => $akun,
            'validation' => \Config\Services::validation(),
            'level' => $akun['level'],

        ];
        return view('admin/crt_vocher', $data);
    }
}
