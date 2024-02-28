<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once 'DB.class.php';
include_once 'Main.class.php';
include_once 'Rcon.php';

class Rcon
{
    public $rcon = array();
    public $status;
    private $db;
    private $pay_cmd = false;
    private $pay_name = false;
    private $pay_id = false;
    private $img_url;

    public function __construct($info, $img_url = null)
    {
        $this->db = new DB();
        $group = Main::get_group($info['pid'], $info['srv_id']);
        $srv = Main::get_srv($info['srv_id']);
        $this->pay_cmd = $group['cmd'];
        $this->pay_name = $info['name'];
        $this->pay_id = (int)$info['id'];
        $this->img_url = $img_url;

        foreach ($srv['servers'] as $r_srv) {
            try {
                // Attempt to create a new instance of the Rcon_root class
                $rcon_instance = new Rcon_root($r_srv['rcon_ip'], $r_srv['rcon_port'], $r_srv['rcon_pass'], 30);
                // Attempt to establish a connection to the RCON server
                $status_connect_rcon = $rcon_instance->connect();
                // Update the $status property with the connection status
                $this->status = $this->status && $status_connect_rcon;

                // Add the Rcon_root instance to the $rcon array
                $this->rcon[] = $rcon_instance;
            } catch (Exception $e) {
                // Handle any exceptions that may occur during connection setup
                // You can log or handle the error here as needed
                // For example, you can use error_log() to log the error
                error_log("Error connecting to RCON server: " . $e->getMessage());
            }
        }
    }

    public function privilege_pay()
    {
        if (empty($this->pay_cmd)) return false;

        $request = '';
        $respond = '';

        foreach (explode(';', $this->pay_cmd) as $cmd) {
            $cmd = str_replace(['<user>', '<link>'], [$this->pay_name, $this->img_url], $cmd);

            $request .= $cmd;
            $respond .= $this->cmd($cmd);
        }

        $this->db->query("UPDATE `pay` SET status = 1, request = '" . $request . "', respond = '" . $respond . "' WHERE `id` = " . (int)$this->pay_id);

        echo "request: ";
        print_r($request);
        return $respond;
    }


    public function get_list()
    {
        $respond = "";
        if (empty($this->pay_cmd)) return false;
        $respond .= $this->cmd('list');
        // echo "request: " . $request . "</pre>";
        return $respond;
    }

    public function cmd($cmd)
    {
        $responses = [];
        foreach ($this->rcon as $item) {
            $response = $item->send_command($cmd);
            $trimmedResponse = trim($response);
            if (!empty($trimmedResponse)) {
                $responses[] = $trimmedResponse;
            }
        }

        if (empty($responses)) {
            return "donate accepted and applied";
        } else {
            return implode(' ; ', $responses);
        }
    }


    public function disconnect()
    {
        return $this->rcon->disconnect();
    }
}
