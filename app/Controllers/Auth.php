<?php

namespace App\Controllers;


use App\Models\DriverModel;
use App\Models\LoginModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\OtpModel;
// use CodeIgniter\I18n\Time;


class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->DriverModel = new DriverModel();
		$this->LoginModel = new LoginModel();
		$this->UserModel = new UserModel();
		$this->AdminModel = new AdminModel();
		$this->OtpModel = new OtpModel();
		// $this->Time = new Time('Asia/Jakarta');
		$this->email = \Config\Services::email();
	}

	public function index()
	{
		$data = [
			'title' => 'Login',
			'validation' => \Config\Services::validation()
		];
		// $myTime = Time::now('Asia/Pontianak');
		// dd($myTime);

		return view('auth/login', $data);
	}

	//--------------------------------------------------------------------

	public function login()
	{
		// dd($this->request->getVar());
		$nama = $this->request->getVar('nama');
		// $password = password_verify($this->request->getVar('password'), PASSWORD_BCRYPT);
		$pas = ($this->request->getVar('password'));
		$level = $this->request->getVar('level');

		//validasi
		if (!$this->validate([


			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		$cek = $this->UserModel->cek_login($nama);
		// dd($cek);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun tidak terdaftar');
			return redirect()->to('/');
		}
		$password = password_verify($pas, ($cek['password']));
		//dd($password);

		if (($cek['password'] == $password)) {
			//dd($cek);
			session()->set('nama', $cek['nama']);
			session()->set('id_user', $cek['id_user']);
			return redirect()->to('/user');
		} else {
			session()->setFlashdata('gagal', 'Username atau Password salah');
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

	public function logout()
	{
		// $array_items = ['nama', 'id_driver', 'id_user'];
		// $session->remove($array_items);
		session()->setFlashdata('flash', 'Berhasil Logout');
		session_destroy();
		return redirect()->to('/');
	}

	public function regis()
	{
		//session();
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/regis', $data);
	}
	public function daftar()
	{

		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/daftar', $data);
	}

	//--------------------------------------------------------------------

	public function save()
	{
		//validasi
		if (!$this->validate([

			'id_driver' => [
				'rules'  => 'required|is_unique[driver.id_driver]|is_unique[user.id_user]',
				'errors' => [
					'required' => 'ID Account wajid di isi',
					'is_unique' => 'Account sudah terdaftar'
				]
			],
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
			'cv' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
			'email' => [
				'rules'  => 'required|valid_email|is_unique[driver.email]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'valid_email' => 'alamat email tidak benar',
					'is_unique' => '{field} sudah terdaftar'
				]
			],
			'telp' => [
				'rules'  => 'required|is_natural|min_length[10]|is_unique[driver.telp]',
				'errors' => [
					'required' => 'nomor telpon wajid di isi',
					'is_natural' => 'nomor telpon tidak benar',
					'min_length' => 'nomor telpon tidak valid',
					'is_unique' => 'nomor telp sudah terdaftar'
				]
			],
			'password' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'min_length[8]' => '{field} Minimal 8 karakter'
				]
			],
			'password2' => [
				'rules'  => 'required|matches[password]',
				'errors' => [
					'required' => 'password wajid di isi',
					'matches' => 'password tidak sama'
				]
			]

		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/regis')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		//dd($this->request->getVar());
		$this->DriverModel->save([
			'id_driver' => $this->request->getVar('id_driver'),
			'nama' => $this->request->getVar('nama'),
			'cv' => $this->request->getVar('cv'),
			'email' => $this->request->getVar('email'),
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'profil' => 'user.png',
			'Trip' => '0',
			'liter' => '0',
			'poin' => '0'


		]);
		session()->setFlashdata('flash', 'Registration success.');
		return redirect()->to('/');
	}

	//--------------------------------------------------------------------

	public function userSave()
	{
		//validasi
		if (!$this->validate([
			'nama' => [
				'rules'  => 'required|alpha_dash|is_unique[user.nama]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'alpha_dash' => 'Tidak boleh mengunakan spasi',
					'is_unique' => 'Nama Account sudah terdaftar'
				]
			],
			'nama_depan' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi',
				]
			],
			'nama_belakang' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi',
				]
			],
			'email' => [
				'rules'  => 'required|valid_email|is_unique[user.email]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'valid_email' => 'alamat email tidak benar',
					'is_unique' => '{field} sudah terdaftar'
				]
			],
			'telp' => [
				'rules'  => 'required|is_natural|min_length[10]|is_unique[user.telp]',
				'errors' => [
					'required' => 'nomor telpon wajid di isi',
					'is_natural' => 'nomor telpon tidak benar',
					'min_length' => 'nomor telpon tidak valid',
					'is_unique' => 'nomor telp sudah terdaftar'
				]
			],
			'password' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'min_length[8]' => '{field} Minimal 8 karakter'
				]
			],
			'password2' => [
				'rules'  => 'required|matches[password]',
				'errors' => [
					'required' => 'password wajid di isi',
					'matches' => 'password tidak sama'
				]
			]

		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/daftar')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		//dd($this->request->getVar());
		$id = $this->request->getVar('nama');
		$id_usr = substr(sha1($id), 0, 8);
		helper('text');
		$token = random_string('alnum', 28);
		$email = $this->request->getVar('email');
		$user = $this->request->getVar('nama');
		$this->OtpModel->save([
			'id_user' => strtoupper($id_usr),
			'nama' => $user,
			'nama_depan' => $this->request->getVar('nama_depan'),
			'nama_belakang' => $this->request->getVar('nama_belakang'),
			'email' => $email,
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'link' => $token,

		]);
		$this->email->setFrom('support@apps.spairum.com', 'noreply-spairum');
		$this->email->setTo($email);
		// $this->email->setCC('teknis@rumahweb.com');
		// $this->email->setBCC('falehry88@gmail.com');
		$this->email->setSubject('OTP Verification Akun');
		$this->email->setMessage("<h1>Hallo $user </h1><p>Terimakasih telah mendaftar silahkan  melakukan verifikasi pada tautan dibawah :</p>
		<a href='https://apps.spairum.com/otp/$token' style='display:block;width:115px;height:25px;background:#0008ff;padding:10px;text-align:center;border-radius:5px;color:white;font-weight:bold'> Verivikasi</a>
		<p>Selanjutnya anda dapat melakukan login ke apps.spairum.com sebagai user</p>");
		$this->email->send();

		session()->setFlashdata('flash', 'Silakan cek kotak masuk email atau spam untuk verifikasi.');
		return redirect()->to('/');
	}

	public function otp($link)
	{
		$cek = $this->OtpModel->cek($link);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun sudah di verifikasi');
			return redirect()->to('/');
		}
		$this->UserModel->save([
			'id_user' => $cek['id_user'],
			'nama' => $cek['nama'],
			'nama_depan' => $cek['nama_depan'],
			'nama_belakang' => $cek['nama_belakang'],
			'email' => $cek['email'],
			'telp' => $cek['telp'],
			'password' => $cek['password'],
			'profil' => 'user.png',
			'debit' => '0',
			'kredit' => '0',
		]);
		$this->OtpModel->save([
			'id' => $cek['id'],
			'link' => substr(sha1($cek['link']), 0, 10),
			'status' => 'tercerivikasi',
		]);
		session()->setFlashdata('flash', 'Registration success silahkan login.');
		return redirect()->to('/');
	}

	//--------------------------------------------------------------------
	// public function kirimEmail()
	// {
	// 	helper('text');
	// 	$token = random_string('numeric', 10);

	// 	$this->email->setFrom('support@apps.spairum.com', 'Team Support');
	// 	$this->email->setTo('fakhryhiz@student.untan.ac.id');
	// 	$this->email->setSubject('Email OTP Verification');
	// 	$this->email->setMessage("<h1>Hallo </h1><p>Terimakasih telah mendaftar silahkan  melakukan verifikasi pada tautan dibawah :</p>
	// 	<a href='https://apps.spairum.com/otp/$token' style='display:block;width:115px;height:25px;background:#4e9caf;padding:10px;text-align:center;border-radius:5px;color:white;font-weight:bold' > Verivikasi</a>
	// 	<p>Selanjutnya anda dapat melakukan login ke apps.spairum.com sebagai user</p>");
	// 	$this->email->send();
	// 	if (!$this->email->send()) {
	// 		return false;
	// 	} else {
	// 		return true;
	// 	}
	// }
}
