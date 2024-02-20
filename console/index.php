<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/smarty/Smarty.class.php');
include($_SERVER['DOCUMENT_ROOT'].'/classes/Console.class.php');

$console = new Console();
$smarty = new Smarty;

$smarty->debugging = false;
$smarty->caching = false;
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/console/templates/');
if(!$_GET['page']) $page = "console";
else $page = $_GET['page'];

switch($page) {
	case "console":
		$smarty->assign('commands', $console->commands());
	break;
	case "cmd":
		$smarty->assign('log', $console->commands_log());
	break;
	default:
		$smarty->assign('error', "404");
}
if(!$console->is_auth()) $smarty->assign('error', "auth");
elseif(!$console->is_perm($page)) $smarty->assign('error', "403");
else {
	$smarty->assign('get_buttons', $console->get_buttons());
	$smarty->assign('user', $console->user());
	$smarty->assign('page', $page);
}

//$smarty->assign('messages_list', $console->engine->messages);
$smarty->assign('cfg', $console->cfg);

$smarty->display('main.html');
