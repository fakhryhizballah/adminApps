<?php

namespace App\Controllers;

use CodeIgniter\Controller;
// use PhpMqtt\Client\Facades\MQTT;
use \PhpMqtt\Client\MqttClient;
use App\Libraries\AuthLibaries;


class ControlS extends Controller
{
    public function __construct()
    {
        // $this->MQTT = new MQTT::connection();
        $this->AuthLibaries = new AuthLibaries();
    }

    // public function index()
    // {
    //     $server   = 'ws.spairum.my.id';
    //     $port     = getenv('mqtt.port');
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
        $akun = $this->AuthLibaries->authCek();
        $admin = $akun['nama'];
        if ($this->request->isAJAX()) {
            $server    = getenv('mqtt.server');
            $port     = getenv('mqtt.port');
            $clientId =  $admin;
            $id = $this->request->getVar('id');
            $data = [
                'id' => $id,
                'akun' => session()->get('id_akun')
            ];
            $myJSON = json_encode($data);
            $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
                ->setUsername(getenv('mqtt.username'))
                ->setPassword(getenv('mqtt.password'));

            $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
            $mqtt->connect($connectionSettings, true);
            $mqtt->publish("opendor/$id",  $myJSON);
            $mqtt->disconnect();
        } else {
            exit('404');
        }
    }
    public function log()
    {
        // if (session()->get('id_akun') == '') {
        //     session()->setFlashdata('gagal', 'Login dulu');
        //     return redirect()->to('/');
        // }
        $akun = $this->AuthLibaries->authCek();
        // $admin = session()->get('nama');

        $id = $this->request->getVar('id');
        $db      = \Config\Database::connect();
        $builder = $db->table('log_mesin');
        $builder->select('*')->where('id_mesin', $id);
        // $builder->join('mesin', 'mesin.id_mesin = log_mesin.id_mesin')->where('lokasi', $id)->orderBy('updated_at', 'DESC');
        $query = $builder->orderBy('created_at', 'DESC')->get(15)->getResult();
        echo json_encode($query);
        // $server   = 'ws.spairum.my.id';
        // $port     = getenv('mqtt.port');
        // $clientId =  $admin;
        // $data = [
        //     'id' => $id,
        //     'akun' => session()->get('id_akun')
        // ];
        // $myJSON = json_encode($data);
        // $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
        //     ->setUsername('spairum')
        //     ->setPassword('broker');

        // $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
        // $mqtt->connect($connectionSettings, true);
        // $mqtt->publish("RSSI/$id",  $myJSON);
        // $mqtt->disconnect();
    }
    public function rssi()
    {
        $akun = $this->AuthLibaries->authCek();
        $admin = $akun['nama'];

        $id = $this->request->getVar('id');
        $server    = getenv('mqtt.server');
        $port     = getenv('mqtt.port');
        $clientId =  $admin;
        $data = [
            'id' => $id,
            'akun' => session()->get('id_akun')
        ];
        $myJSON = json_encode($data);
        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(getenv('mqtt.username'))
            ->setPassword(getenv('mqtt.password'));

        $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
        $mqtt->connect($connectionSettings, true);
        $mqtt->publish("RSSI/$id",  $myJSON);
        $mqtt->disconnect();
    }
    public function flush()
    {
        $akun = $this->AuthLibaries->authCek();
        $admin = $akun['nama'];
        if ($this->request->isAJAX()) {
            $server    = getenv('mqtt.server');
            $port     = getenv('mqtt.port');
            $clientId =  $admin;
            $id = $this->request->getVar();
            $myJSON = json_encode($id);
            $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
                ->setUsername(getenv('mqtt.username'))
                ->setPassword(getenv('mqtt.password'));

            $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
            $mqtt->connect($connectionSettings, true);
            $mqtt->publish("cleanUp",  $myJSON);
            $mqtt->disconnect();
        } else {
            exit('404');
        }
    }
}
