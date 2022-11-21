<?php

namespace App\Controllers;


class Oauth extends BaseController
{
    public function login()
    {
        try {
            $admin = $this->loginAuth->ceklogin();
            if ($admin != false) {
                return redirect()->to('/admin/home');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        $client = new \Google_Client();

        $clientID = getenv('google.clientID');
        $clientSecret = getenv('google.clientSecret');
        $redirectUri = getenv('google.redirectUri');
        $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        $client->setHttpClient($guzzleClient);
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        $authUrl = $client->createAuthUrl();
        // dd($authUrl);
        $data = [
            'title' => 'login |Spairum.com',
            'urlOauth' => $authUrl

        ];
        return view('admin/login', $data);
    }
    public function redirect()
    {
        $client = new \Google_Client();
        $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        $clientID = getenv('google.clientID');
        $clientSecret = getenv('google.clientSecret');
        $redirectUri = getenv('google.redirectUri');
        $client->setHttpClient($guzzleClient);
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        if (isset($_GET["code"])) {

            $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
            $client->setAccessToken($token);
            $gauth = new \Google_Service_Oauth2($client);
            $data = $gauth->userinfo->get();
            dd($data);
            $admin = $this->AdminModel->findAdmin($data->email);
            if ($admin != false) {
                $new = [
                    'id' => $admin->id,
                    'id_admin'  => $data->id,
                    'picture' => $data->picture,
                    'username' => $data->givenName,
                    'fullname' => $data->name
                ];
                $this->AdminModel->save($new);
                $this->AdminModel->save([
                    'id' => $data->id,
                    'id_admin'  => $data->id,
                    'picture' => $data->picture,
                    'username' => $data->givenName,
                    'fullname' => $data->name
                ]);
                $this->loginAuth->login($data->id);
                return redirect()->to('/admin/home');
            }
        }
        return redirect()->to('/');
    }
}
