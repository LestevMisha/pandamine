<?php
require_once('classes/Rcon.php');
require_once('config.php');
use Thedudeguy\Rcon;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $dataIndex = $_POST["dataIndex"]; // Get the data-index value from the POST request
    $timeout = 10; // How long to timeout.
    
    if ($dataIndex == 1) {
        $data = $cfg['servers']["Выживание"]['servers'];
    } else if ($dataIndex == 2) {
        $data = $cfg['servers']["Кейсы"]['servers'];
    } else if ($dataIndex == 3) {
        $data = $cfg['servers']["SkyPvP"]['servers'];
    } else if ($dataIndex == 4) {
        $data = $cfg['servers']["Другое"]['servers'];
    } else {
        $data = $cfg['servers']["Выживание"]['servers'];
    }
    
    // set-up server's details
    $host = $data[0]['rcon_ip'];
    $port = $data[0]['rcon_port'];
    $password = $data[0]['rcon_pass'];
    
    // connect and send a command
    $rcon = new Rcon_root($host, $port, $password, $timeout);
    if ($rcon->connect()) {
        $response = $rcon->send_command("list");
      
        // Remove color codes from the response and get normalized text -->
        $colorCodesToDelete = ['§4', '§C', '§c', '§6', '§E', '§e', '§2', '§A', '§a', '§B', '§b', '§3', '§1', '§9', '§D', '§d', '§5', '§F', '§f', '§7', '§8', '§0', '§R', '§r', '§L', '§l', '§O', '§o', '§N', '§n', '§M', '§m', '§K', '§k'];
        $normalized_text = str_replace($colorCodesToDelete, '', $response);
        
        // get amount of players on current server mode -->
        $exploded_norm_txt = explode('.', $normalized_text);
        $players_amount = $exploded_norm_txt[0];
        
        // get users with respect to their privileges
        $players = $exploded_norm_txt[1];
        $format_players = str_replace([': ', ', '], [":", ","], $players);
        $format_players_arr = explode("|", preg_replace('/\s+/', '|', $format_players));
        
        $users = [];
        foreach ($format_players_arr as $item) {
            $parts = explode(":", $item);
            if (isset($parts[0]) && isset($parts[1])) {
                $privelege = $parts[0];
                $nicks_nick = $parts[1];
                if (stripos($nicks_nick, ',') !== false) {
                    $nicks_arr = explode(',', $nicks_nick);
                    foreach ($nicks_arr as $nick) {
                        $users[] = [$privelege, $nick];
                    }
                } else {
                    $users[] = [$privelege, $nicks_nick];
                }   
            }
        }
        $data = json_encode([$players_amount, $users]);
        echo $data;
    }
}
?>
