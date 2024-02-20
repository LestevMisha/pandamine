<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Console.class.php';
$console = new Console();
if (isset($_GET['code'])) {
    $params = array(
        'client_id' => $console->cfg['console']['vk_id'],
        'client_secret' => $console->cfg['console']['vk_secret'],
        'code' => $_GET['code'],
        'v' => '5.71',
        'redirect_uri' => 'http://' . $console->cfg['console']['auth_url'] . '/auth.php'
    );
    $token = json_decode(@file_get_contents('https://oauth.vk.com/access_token?' . urldecode(http_build_query($params))), true);
    if (isset($token['access_token'])) {
        $params = array(
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,photo_200_orig,photo_200',
            'v' => '5.71',
            'access_token' => $token['access_token']
        );
        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo['response'][0]['id'])) $userInfo = $userInfo['response'][0];

        $q = $console->db->query_result("SELECT * FROM `console_users` WHERE uid = '" . $userInfo['id'] . "'");
        $hash = md5($console->generate_hash());
        if (isset($q->uid)) {
            $console->db->query("UPDATE `console_users` SET hash = '" . $hash . "' WHERE uid = '" . $userInfo['id'] . "'");
            $_SESSION['phpmc_id'] = $q->id;
            $_SESSION['phpmc_uid'] = $q->uid;
            $_SESSION['phpmc_hash'] = $hash;
        } else {
            $console->db->query("INSERT INTO `console_users`(`first_name`, `last_name`, `hash`, `uid`) VALUES ('{$userInfo['first_name']}', '{$userInfo['last_name']}', '{$hash}', '{$userInfo['id']}')");
            $_SESSION['phpmc_id'] = $console->db->insert_id();
            $_SESSION['phpmc_uid'] = $userInfo['id'];
            $_SESSION['phpmc_hash'] = $hash;
        }
        header("Location: http://" . $console->cfg['console']['auth_url']);
        exit;
    }
    header("Location: /console/");
}