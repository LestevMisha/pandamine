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

    public function __construct($info)
    {
        $this->db = new DB();
        $group = Main::get_group($info['pid'], $info['srv_id']);
        $srv = Main::get_srv($info['srv_id']);
        $this->pay_cmd = $group['cmd'];
        $this->pay_name = $info['name'];
        $this->pay_id = (int)$info['id'];
        foreach ($srv['servers'] as $r_srv) {
            $this->rcon[] = @new Rcon_root($r_srv['rcon_ip'], $r_srv['rcon_port'], $r_srv['rcon_pass'], 10);
            $status_connect_rcon = end($this->rcon)->connect();
            $this->status = $this->status && $status_connect_rcon;
        }
    }

    public function privilege_pay()
    {
        if (empty($this->pay_cmd)) return false;
        $request = '';
        $respond = '';
        foreach (explode(';', $this->pay_cmd) as $cmd) {
            $cmd = str_replace('<user>', $this->pay_name, $cmd);
            $request .= $cmd . ', ';
            $respond .= $this->cmd($cmd) . ',';
        }
        if(strlen($request) > 2) $request = @substr($request, 0, -2);
        if(strlen($respond) > 2) $respond = @substr($respond, 0, -2);
        $this->db->query("UPDATE `pay` SET request = '" . $request . "', respond = '" . $respond . "' WHERE `id` = " . (int)$this->pay_id);
        return $respond;
    }

    public function cmd($cmd)
    {
        $respond = '';
        foreach ($this->rcon as $item) {
            $respond .= ' ; '.$item->send_command($cmd);
        }
        return $respond;
    }

    public function disconnect()
    {
        return $this->rcon->disconnect();
    }

}

?>