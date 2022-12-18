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
use App\Models\LokasiModel;
use App\Models\FotoModel;
use App\Models\MesinModel;
use App\Controllers\BaseController;
use App\Libraries\AuthLibaries;
use GuzzleHttp\Psr7;

class AjaxUser extends BaseController
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
        $this->LokasiModel = new LokasiModel();
        $this->FotoModel = new FotoModel();
        $this->MesinModel = new MesinModel();
        $this->AuthLibaries = new AuthLibaries();
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

    public function userdate()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('kredit, debit, otp.created_at');
        $builder->join('otp', 'otp.id_user = user.id_user');
        $builder->where('otp.created_at >', date('2021-11-01'));
        $query = $builder->get()->getResult();

        foreach ($query as $row) {
            $date = date_create($row->created_at);
            $datestamp[] = date_format($date, 'd/m/y');
        };
        // dd($datestamp);;

        $array = array_map('strtolower', $datestamp);
        $data  = array_count_values($array);
        // print_r(array_count_values($array));
        // dd($data);
        // return $data;
        // echo json_encode($data);
        echo json_encode($array);
    }

    public function detailLokasi()
    {
        $id = $this->request->getVar('id');
        $foto = $this->FotoModel->getDetail($id);
        $lokasi = $this->LokasiModel->getDetail($id);
        $data = [
            'foto' => $foto,
            'lokasi' => $lokasi
        ];

        echo json_encode($data);
    }
    public function statusLokasi()
    {
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $data = [
            'status' => $status
        ];
        $this->LokasiModel->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => 'Data berhasil diubah'
        ];
        echo json_encode($response);
    }

    public function fotomap()
    {
        $image = \Config\Services::image();
        $id = $this->request->getPost();
        $id_lokasi = $id['id_lokasi'];

        $validateImage = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
                'max_size[file, 4096]',
            ],

        ]);


        if ($validateImage) {
            $imageFile = $this->request->getFile('file');

            // $imageFile->move(WRITEPATH . 'uploads');
            try {
                $db      = \Config\Database::connect();
                $db->transStart();
                $namafile = $imageFile->getClientName();
                $mime = $imageFile->getClientMimeType();
                $imageFile->move(WRITEPATH . '/img/', $namafile);
                $file = new \CodeIgniter\Files\File(WRITEPATH . "/img/$namafile");
                $link = $file->getRealPath();
                $img = new \CURLFILE($link);
                $img->setMimetype($mime);
                $img->setPostFilename($namafile);

                $curl = curl_init();
                $headers = array("Content-Type:multipart/form-data");

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://cdn.spairum.my.id/api/upload/single/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HEADER => true,
                    CURLOPT_SSL_VERIFYPEER => false, // this line makes it work under https
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POSTFIELDS => array('image' => $img),
                ));

                $response = curl_exec($curl);
                $status = curl_getinfo($curl);
                unlink(WRITEPATH . "/img/$namafile");

                if (!curl_errno($curl)) {
                    $status = curl_getinfo($curl);
                    if ($status['http_code'] == 200) {
                        $info = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
                        $body = substr($response, $info);
                    } else {

                        $response = [
                            'success' => false,
                            'data' => $status['http_code'],
                            'msg' => "Sorry Gagal - File terlalu besar"
                        ];
                        return $this->response->setJSON($response);
                    }
                } else {
                    $errmsg = curl_error($curl);
                    $response = [
                        'success' => false,
                        'msg' => $errmsg
                    ];
                    return $this->response->setJSON($response);
                }

                curl_close($curl);

                $url = json_decode($body, true)['data']['url'];

                $new = [
                    "id_lokasi" => $id_lokasi,
                    "foto" => $url

                ];
                $this->FotoModel->save($new);
                $db->transComplete();
            } catch (\Exception $e) {
                $response = [
                    'success' => false,
                    'data' => $e,
                    'msg' => "Exception"
                ];
                return $this->response->setJSON($response);
            }

            $response = [
                'success' => true,
                'data' => $url,
                'datatype' => gettype($url),
                'msg' => "Image  successfully uploaded"

            ];
        } else {
            $response = [
                'success' => false,
                'data' => $validateImage,
                'msg' => "Image could not upload"
            ];
            return $this->response->setJSON($response);
        }
        return $this->response->setJSON($response);
    }
    public function getconfigmesin()
    {
        $query = $this->MesinModel->select('id, new_id, nama,faktor,harga')->findAll();

        $data = [
            'status' => 200,
            'error' => null,
            'records' => count($query),
            'data' => $query
        ];
        echo json_encode($data);
    }
    public function updateMesin()
    {
        try {
            $id = $this->request->getVar('id');
            $pesan = $this->request->getVar();
            $data = [
                'nama' => $pesan['nama'],
                'faktor' => $pesan['faktor'],
                'harga' => $pesan['harga'],
            ];
            $this->MesinModel->update($id, $data);
            $response = [
                'status' => 200,
                'error' => null,
                'data' => $data,
                'messages' => 'Data berhasil diubah'
            ];
            echo json_encode($response);
        } catch (\Exception $e) {
            $response = [
                'status' => 401,
                'error' => $e,
                'messages' => 'Unauthorized'
            ];
            // retrun status with status code 401 and json response

            // $this->response->setStatusCode(401);
            return $this->response->setStatusCode(401, 'Unauthorized')->setJSON($response);


        }
    }
    public function userlevel()
    {
        // $id_usr = $this->request->getVar('id_usr');

        try {
            $akun = $this->AuthLibaries->authCek();

            $cek = $this->AdminModel->get_admin($akun['id_akun']);
            if ($cek['admlevel'] == "false") {
                return $this->response->setJSON([
                    'status' => 404,
                    'error' => null,
                    'messages' => 'Data tidak ditemukan'
                ])->setStatusCode(401);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 401,
                'error' => null,
                'messages' => 'unauthorized'
            ])->setStatusCode(401);
        }
        $query = $this->AdminModel->alluser();
        // dd($query);
        $data = [
            'status' => 200,
            'error' => null,
            'records' => count($query),
            'data' => $query
        ];
        echo json_encode($data);
        return;
    }
}
