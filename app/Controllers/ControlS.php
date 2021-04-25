<?php

namespace App\Controllers;

use CodeIgniter\Controller;
// use PhpMqtt\Client\Facades\MQTT;
use \PhpMqtt\Client\MqttClient;


class ControlS extends Controller
{
    public function __construct()
    {
        // $this->MQTT = new MQTT::connection();
    }

    // public function index()
    // {
    //     $server   = 'ws.spairum.my.id';
    //     $port     = 1883;
    //     $clientId = 'test-subscriber';

    //     $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
    //     $mqtt->connect();
    //     // $mqtt->subscribe('Web', function ($topic, $message) {
    //     //     echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
    //     // }, 0);
    //     $mqtt->publish('Web', 'Hello World!');
    //     $mqtt->loop(true);
    //     $mqtt->disconnect();
    // }

    public function OpenDor()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        if ($this->request->isAJAX()) {
            $server   = 'ws.spairum.my.id';
            $port     = 1883;
            $clientId = 'OpenDor';
            $id = $this->request->getVar('id');
            $data = [
                'id' => $id,
                'akun' => session()->get('id_akun')
            ];
            $myJSON = json_encode($data);

            $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
            $mqtt->connect();
            $mqtt->publish('Web',  $myJSON);
            $mqtt->disconnect();
        } else {
            exit('404');
        }
    }
}
