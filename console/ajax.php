<?php
include($_SERVER['DOCUMENT_ROOT'] . '/classes/Console.class.php');

$console = new Console();
$type = $_GET['type'];


if ($type == "send") {
    if ($console->is_auth() && $console->is_perm("console")) {
        echo $console->send_cmd(str_replace('*', '', $_REQUEST['cmd']));
    }
} elseif ($type == "get_log") {
    if ($console->is_auth() && $console->is_perm("console")) {
        echo $console->get_log();
    }
}