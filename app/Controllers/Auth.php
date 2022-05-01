<?php

namespace App\Controllers;


use App\Models\AdminModel;
use App\Models\OtpModel;
use CodeIgniter\I18n\Time;
use \Firebase\JWT\JWT;
use App\Models\TokenModel;


class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->AdminModel = new AdminModel();
		$this->OtpModel = new OtpModel();
		$this->TokenModel = new TokenModel();
		$this->Time = new Time('Asia/Jakarta');
		$this->email = \Config\Services::email();
		helper('text');
		helper('cookie');
	}
	public static string $key = 'ss';

	public function index()
	{
		if (empty($_COOKIE['X-Sparum-Token'])) {
			$data = [
				'title' => 'Login - Spairum',
				'validation' => \Config\Services::validation()
			];
			return view('auth/login', $data);
		} else {
			if ($_COOKIE['X-Sparum-Token'] == 'Logout') {
				$data = [
					'title' => 'Login - Spairum',
					'validation' => \Config\Services::validation()
				];
				return view('auth/login', $data);
			}
			return redirect()->to('/admin');
		}
	}

	//--------------------------------------------------------------------

	public function login()
	{
		// dd($this->request->getVar());
		$nama = $this->request->getVar('nama');
		// $password = password_verify($this->request->getVar('password'), PASSWORD_BCRYPT);
		$pas = ($this->request->getVar('password'));
		//validasi
		if (!$this->validate([
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Username/email/no telpon wajib di isi'
				]
			],
		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/')->withInput()->with('validation', $validation);
		}
		$cek = $this->AdminModel->cek_login($nama);
		// dd($cek);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun tidak terdaftar');
			return redirect()->to('/');
		}
		$password = password_verify($pas, ($cek['password']));

		if (($cek['password'] == $password)) {

			$token = random_string('alnum', 28);
			$key = $this->TokenModel->Key()['token'];
			$payload = array(
				'Key' => $token,
				'id_user' => $cek['id_akun'],
				'nama' => $cek['nama']
			);
			$jwt = JWT::encode($payload, $key,);

			$this->TokenModel->save([
				'id_user' => $cek['id_akun'],
				'token'    => $token,
				'status' => 'Login'
			]);
			$arr_cookie_options = array(
				'expires' => time() + 60 * 60 * 24 * 30,
				'path' => '/',
				'domain' => "", // leading dot for compatibility or use subdomain
				'secure' => true,     // or false
				'httponly' => false,    // or false
				'samesite' => 'None' // None || Lax  || Strict
			);
			setCookie("X-Sparum-Token", $jwt, $arr_cookie_options);

			return redirect()->to('/Admin');
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
		$jwt = $_COOKIE['X-Sparum-Token'];
		$key = $this->TokenModel->Key()['token'];
		$decoded = JWT::decode($jwt, $key, array('HS256'));
		$token = $decoded->Key;
		$id = $this->TokenModel->cek($token)['id'];
		$this->TokenModel->update($id, [
			'token'    => "Keluar",
			'status' => 'logout'
		]);
		$arr_cookie_options = array(
			'expires' => time() + 60 * 60 * 24 * 30,
			'path' => '/',
			'domain' => "", // leading dot for compatibility or use subdomain
			'secure' => true,     // or false
			'httponly' => false,    // or false
			'samesite' => 'None' // None || Lax  || Strict
		);
		session()->setFlashdata('flash', 'Berhasil Logout');
		setCookie("X-Sparum-Token", "Logout", $arr_cookie_options);
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
