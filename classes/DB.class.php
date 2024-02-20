<?php
include_once 'Config.class.php';

class DB
{
    public $mysqli;
    public $cfg;
    public $status = false;

    public function __construct($cfg = false)
    {
        if (!$cfg) $this->cfg = Config::$cfg;
        else $this->cfg = $cfg;
        $this->mysqli = @new mysqli($this->cfg['mysql_host'], $this->cfg['mysql_user'], $this->cfg['mysql_pass'], $this->cfg['mysql_db']);
        if ($this->mysqli->connect_errno) $this->status = "Невозможно подключиться к базе данных. Код ошибки: " . $this->mysqli->connect_error;
        else return $this->status = true;
        echo "db " . $this->status;
        die();
    }

    public function querys($qs)
    {
        if ($this->mysqli->connect_error) return false;
        $status = true;
        foreach (explode(';', $qs) as $q) {
            if (!$this->mysqli->query($q)) $status = false;
        }
        return $status;
    }

    public function query($q)
    {
        if ($this->mysqli->connect_error) return false;
        return $this->mysqli->query($q);
    }

    public function get($q)
    {
        if ($this->mysqli->connect_error) return false;
        $res = $this->mysqli->query($q);
        if ($res) {
            $results_array = array();
            while ($row = $res->fetch_assoc()) {
                $results_array[] = $row;
            }
            return $results_array;
        } //if($res) return $res->fetch_all(MYSQLI_ASSOC);
        else return false;
    }

    public function escape($str)
    {
        if ($this->mysqli->connect_error) return false;
        return $this->mysqli->real_escape_string($str);
    }

    public function query_result($query) {
        return $this->mysqli->query($query)->fetch_object();
    }

    public function insert_id() {
        return $this->mysqli->insert_id;
    }
}