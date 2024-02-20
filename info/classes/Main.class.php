<?php
include_once 'DB.class.php';
include_once 'Pay.class.php';
include_once 'Config.class.php';

class Main
{
    public $db;
    private $pay;
    public $cfg;
    private $query;
    public $messages = array();
    public $list_privileges = array(); //Сервер->Группа->Привилегия

    public function __construct()
    {
        $this->db = new DB();
        $this->pay = new Pay();
        $this->cfg = Config::$cfg;
        $this->events();
    }

    private function add_message($text, $err = false)
    {
        $this->messages[] = array('text' => $text, 'err' => $err);
    }

    private function events()
    {
        if (isset($_REQUEST['buy'])) $this->buy($_REQUEST['nick'], $_REQUEST['group'], $_REQUEST['srv_id']);
        if (isset($_REQUEST['successfully'])) $this->add_message('Вы успешно купили привилегию!');
        if (isset($_REQUEST['error'])) $this->add_message('Во время покупки привелегии произошла ошибка!', true);
    }

    public function get_extra($nick, $srv,$group_id = false){
		if($group_id !== false){
			$group = Main::get_group((int)$group_id, $srv);
			if($group && isset($group['no_extra']) && $group['no_extra']) return 0;
		}
        $extra = 0;
       //foreach ($this->db->query("SELECT `price`,`extra`, pr.count priv_real_price FROM `pay` pay LEFT JOIN `privileges` pr ON pay.`pid` = pr.id WHERE pay.`status` = 1 AND pay.`srv_id` = " . (int)$srv . " AND pay.`name` = '" . $this->db->escape(trim($nick)) . "'") as $e) {
		foreach ($this->db->query("SELECT `price`,`extra`,`pid` FROM `pay` WHERE `status` = 1 AND `srv_id` = " . (int)$srv . " AND `name` = '" . $this->db->escape(trim($nick)) . "'") as $e) {      
			$real_price = Main::get_group((int)$e['pid'], $srv);
			if(!$real_price) $extra += (int)$e['price'] - (int)$e['extra'];
			else $extra += (int)$real_price['price'] - (int)$e['extra'];
        }
        return $extra;
    }

    public static function get_group($id, $srv)
    {
        foreach (Main::get_srv($srv)['privileges'] as $pp) {
            foreach ($pp as $p_name => $p) {
                if ($p['id'] == $id) {
                    $p['name'] = $p_name;
                    return $p;
                }
            }
        }
        return false;
    }

    public static function get_srv($id)
    {
        foreach (Config::$cfg['servers'] as $s) {
            if ($s['srv_id'] == $id) {
                return $s;
                break;
            }
        }
        return false;
    }

    public function buy($name, $group_id, $srv_id)
    {
        $name = trim($name);
        if (empty($name)) return $this->add_message('Ник не введён!', true);
        $group = Main::get_group($group_id, $srv_id);
        if (!$group) return $this->add_message('Группы не существует!', true);
        $price = (int)$group['price'];
		$extra = $this->get_extra($name, $srv_id, $group_id);
        $this->db->query("INSERT INTO `pay` ( `name`,`pid`, `status`, `time`, `price`, `srv_id`, `extra`) VALUES ( '{$name}', '" . (int)$group['id'] . "', '0', '" . time() . "',  " . $price . ", " . (int)$srv_id . ", " . $extra . " )");
        return $this->pay->redirect($this->db->mysqli->insert_id.'|'.$name.'|'.$group['name'], $price - $extra, $group['name']);
    }
}

?>