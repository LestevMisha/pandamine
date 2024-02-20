<?php
session_start();
include_once 'DB.class.php';
include_once 'Rcon.php';
include_once 'Config.class.php';

class Console
{
    public function __construct()
    {
        $this->db = new DB();
        $this->cfg = Config::$cfg;
    }

    public function is_auth()
    {
        if (!$_SESSION['phpmc_id']) return false;
        $query = $this->db->query_result("SELECT `id`, `hash`, `uid` FROM `console_users` WHERE `id` = '" . (int)$_SESSION['phpmc_id'] . "'");
        if ($query == null) return false;

        if (($query->id == $_SESSION['phpmc_id']) AND ($query->uid == $_SESSION['phpmc_uid']) AND ($query->hash == $_SESSION['phpmc_hash'])) return true;

        return false;
    }

    public function is_perm($page)
    {
        $query = $this->db->query_result("SELECT * FROM `console_access` WHERE `user` = '" . (int)$_SESSION['phpmc_uid'] . "' ORDER BY id DESC");

        if (!isset($query)) return false;
        if ($query->access == "*") {
            return true;
        } else {
            foreach (explode(',', $query->access) as $p) {
                if ($p == $page) {
                    return true;
                }
            }
        }
    }

    public function generate_hash()
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max = 10;
        $size = StrLen($chars) - 1;
        $hash = null;
        while ($max--) $hash .= $chars[rand(0, $size)];
        return $hash;
    }

    public function get_buttons()
    {
        $form = "";
        if ($this->is_perm("console")) $form .= '<li><a href="/console/"><i class="fa fa-plug"></i> <span>Консоль</span></a></li>';
        if ($this->is_perm("cmd")) $form .= '<li><a href="/console/?page=cmd"><i class="fa fa-list"></i> <span>Лог</span></a></li>';

        return $form;
    }

    public function get_nick($user = '')
    {
        if (!$user) $user = (int)$_SESSION['phpmc_uid'];

        $query = $this->db->query_result("SELECT * FROM `console_access` WHERE `user` = '" . (int)$user . "' ORDER BY id DESC");

        return $query->nick;
    }

    public function user($user = '')
    {
        if (!$user) $user = (int)$_SESSION['phpmc_id'];
        $info = $this->db->query_result("SELECT * FROM `console_users` WHERE `id` = '" . (int)$user . "' ORDER BY id DESC");
        return array(
            'id' => $info->id,
            'first_name' => $info->first_name,
            'last_name' => $info->last_name,
            'uid' => $info->uid,
            'nick' => $this->get_nick((int)$info->uid)
        );
    }

    public function get_cmd($cmd)
    {
        return $this->db->query_result("SELECT * FROM `console_cmd` WHERE `cmd` = '" . $this->db->escape($cmd) . "'");
    }

    public function get_cmd_id($id)
    {
        return $this->db->query_result("SELECT * FROM `console_cmd` WHERE `id` = '" . $id . "'");
    }

    public function get_blocks()
    {
        return $this->db->query("SELECT * FROM `console_block`");
    }

    public function json_ajax($msg, $type = 'ok')
    {
        return json_encode(array('msg' => $msg, 'type' => ($type == "err") ? 'error' : 'ok'));
    }

    public function check_cmd($cmd)
    {
        $array = array();

        $cm = explode(" ", $cmd);
        $blocks = $this->get_blocks();

        foreach ($this->db->query("SELECT * FROM `console_cmd`") as $cmd_query) {
            $array['cmd'] = [];
            $i = 0;
            foreach (explode(" ", $cmd_query['query']) as $q) {
                foreach ($blocks as $n) {
                    if ($n['nick'] == $cm[$i]) return false;
                }
                if ($q == "[text]") return true;
                $array['cmd'][] = str_replace("[argument]", $cm[$i], $q);
                $i++;
            }
            $end = implode(" ", $array['cmd']);
            if ($end == $cmd) return $cmd_query['id'];
        }
        return false;
    }

    public function send_cmd($cmd)
    {
        $cmd = $this->db->escape($cmd);
        $check = $this->check_cmd($cmd);
        if (!$check) return $this->json_ajax("Неизвестная команда или неверные параметры, или запрещенный ник.", "err");
        $get_cmd = $this->get_cmd_id($check);
        if (!$get_cmd) return $this->json_ajax("Неизвестная команда.", "err");
        if ($get_cmd->use != "-1") {
            if (!$this->get_timeout($get_cmd->query, $get_cmd->use)) return $this->json_ajax("Вы исчерпали лимит выполнения за сутки, попробуйте позже.", "err");;
        }
        $rcon = new Rcon_root($this->cfg['console']['server']['ip'], $this->cfg['console']['server']['port'], $this->cfg['console']['server']['password'], 5);
        if (@$rcon->connect()) {
            if ($get_cmd->use != "-1") $this->add_timeout($get_cmd->query, $get_cmd->use);

            $rcon->send_command($cmd);
            $user = $this->user();
            $response = $this->minetext($rcon->get_response());

            $this->db->query("INSERT INTO `console_log`(`fio`, `nick`, `time`, `cmd`, `reply`) VALUES ('{$user['first_name']} {$user['last_name']}', '{$user['nick']}', '" . date("Y-m-d H:i:s") . "', '{$cmd}', '{$this->db->escape($response)}')");

            return $this->json_ajax($response);
        }
        return $this->json_ajax("Увы, сервер недоступен. Попробуйте позднее...", "err");
    }

    public function get_log()
    {
        $log = "";
        foreach ($this->db->query("SELECT * FROM `console_log` ORDER BY id DESC LIMIT 15") as $l) {
            $log .= "<li class=\"list-group-item list-group-item-info\">{$l['fio']} ({$l['nick']}) [" . $this->date($l['time']) . "]<br>Команда: <code>{$l['cmd']}</code><br>Ответ: <em>{$l['reply']}</em></li>";
        }

        return $log;
    }

    public function commands()
    {
        $array = array();

        foreach ($this->db->query("SELECT * FROM `console_cmd`") as $q) {
            if ($q['use'] == "-1") $uses = "Неограниченно";
            else {
                $use = explode("|", $q['use']);
                $time = ($use[1] == 'month') ? 'месяц' : 'сутки';
                $uses = $use[0] . " раз в " . $time;
            }
            $array[] = array("cmd" => $q['cmd'], "query" => $q['example'], "use" => $uses);
        }

        return $array;
    }

    public function commands_log()
    {
        $array = array();

        foreach ($this->db->query("SELECT * FROM `console_log`") as $q) {
            $array[] = array("user" => $q['fio'], "nick" => $q['nick'], "time" => $this->date($q['time']), "cmd" => $q['cmd'], "reply" => $q['reply']);
        }

        return $array;
    }

    public function add_timeout($cmd, $limit)
    {
        $limit = explode("|", $limit);
        $time = ($limit[1] == 'month') ? '30' : '1';
        $this->db->query("INSERT INTO `console_timeout`(`date`, `command`, `user`) VALUES (NOW()+INTERVAL {$time} DAY, '" . $cmd . "', '" . $this->user()['id'] . "')");
    }

    public function get_timeout($cmd, $limit)
    {
        $limit = explode("|", $limit);
        $query = $this->db->query("SELECT * FROM `console_timeout` WHERE `date` > NOW() AND `command` = '{$cmd}' AND `user` = '{$this->user()['id']}'");
        if ($query->num_rows < $limit[0]) return true;
        return false;
    }

    public function minetext($minetext)
    {
        preg_match_all("/[^§&]*[^§&]|[§&][0-9a-z][^§&]*/", $minetext, $brokenupstrings);
        $returnstring = "";
        foreach ($brokenupstrings as $results) {
            $ending = '';
            foreach ($results as $individual) {
                $code = preg_split("/[&§][0-9a-z]/", $individual);
                preg_match("/[&§][0-9a-z]/", $individual, $prefix);
                if (isset($prefix[0])) {
                    $actualcode = substr($prefix[0], 1);
                    switch ($actualcode) {
                        case "1":
                            $returnstring = $returnstring . '<FONT COLOR="0000AA">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "2":
                            $returnstring = $returnstring . '<FONT COLOR="00AA00">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "3":
                            $returnstring = $returnstring . '<FONT COLOR="00AAAA">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "4":
                            $returnstring = $returnstring . '<FONT COLOR="AA0000">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "5":
                            $returnstring = $returnstring . '<FONT COLOR="AA00AA">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "6":
                            $returnstring = $returnstring . '<FONT COLOR="FFAA00">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "7":
                            $returnstring = $returnstring . '<FONT COLOR="AAAAAA">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "8":
                            $returnstring = $returnstring . '<FONT COLOR="555555">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "9":
                            $returnstring = $returnstring . '<FONT COLOR="5555FF">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "a":
                            $returnstring = $returnstring . '<FONT COLOR="55FF55">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "b":
                            $returnstring = $returnstring . '<FONT COLOR="55FFFF">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "c":
                            $returnstring = $returnstring . '<FONT COLOR="FF5555">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "d":
                            $returnstring = $returnstring . '<FONT COLOR="FF55FF">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "e":
                            $returnstring = $returnstring . '<FONT COLOR="FFFF55">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "f":
                            $returnstring = $returnstring . '<FONT COLOR="FFFFFF">';
                            $ending = $ending . "</FONT>";
                            break;
                        case "l":
                            if (strlen($individual) > 2) {
                                $returnstring = $returnstring . '<span style="font-weight:bold;">';
                                $ending = "</span>" . $ending;
                                break;
                            }
                        case "m":
                            if (strlen($individual) > 2) {
                                $returnstring = $returnstring . '<strike>';
                                $ending = "</strike>" . $ending;
                                break;
                            }
                        case "n":
                            if (strlen($individual) > 2) {
                                $returnstring = $returnstring . '<span style="text-decoration: underline;">';
                                $ending = "</span>" . $ending;
                                break;
                            }
                        case "o":
                            if (strlen($individual) > 2) {
                                $returnstring = $returnstring . '<i>';
                                $ending = "</i>" . $ending;
                                break;
                            }
                        case "r":
                            $returnstring = $returnstring . $ending;
                            $ending = '';
                            break;
                    }
                    if (isset($code[1])) {
                        $returnstring = $returnstring . $code[1];
                        if (isset($ending) && strlen($individual) > 2) {
                            $returnstring = $returnstring . $ending;
                            $ending = '';
                        }
                    }
                } else {
                    $returnstring = $returnstring . $individual;
                }

            }
        }

        return $returnstring;
    }

    public function date($date)
    {
        $time = explode(" ", $date);
        $month = explode("-", $time[0]);
        if ($month[1] == 1) $month_t = "января";
        elseif ($month[1] == 2) $month_t = "Февраля";
        elseif ($month[1] == 3) $month_t = "марта";
        elseif ($month[1] == 4) $month_t = "апреля";
        elseif ($month[1] == 5) $month_t = "мая";
        elseif ($month[1] == 6) $month_t = "июня";
        elseif ($month[1] == 7) $month_t = "июля";
        elseif ($month[1] == 8) $month_t = "августа";
        elseif ($month[1] == 9) $month_t = "сентября";
        elseif ($month[1] == 10) $month_t = "октября";
        elseif ($month[1] == 11) $month_t = "ноября";
        elseif ($month[1] == 12) $month_t = "декабря";
        else return $date;
        $sec = explode(":", $time[1]);
        if ($time[0] == date("Y-m-d")) return "Сегодня в " . $sec[0] . ":" . $sec[1];
        elseif ($time[0] == date('Y-m-d', strtotime('-1 days'))) return "Вчера в " . $sec[0] . ":" . $sec[1];
        else return $month[2] . " " . $month_t . " в " . $sec[0] . ":" . $sec[1];
    }
}