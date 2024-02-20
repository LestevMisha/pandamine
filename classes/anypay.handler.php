<?php
require_once "anypay.config.php";
include_once 'Config.class.php';
include_once 'DB.class.php';
include_once 'Rcon.class.php';
include_once 'Main.class.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include 'config_.php';

$status = 'paid';
error_reporting(0);

function getClientIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

$allowedIPs = array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79');
$clientIP = getClientIP();

if (!in_array($clientIP, $allowedIPs)) {
    // Log the unauthorized access attempt
    error_log("Unauthorized access attempt from IP: $clientIP", 0);
}

$sign = md5($_REQUEST['MERCHANT_ID'].':'.$_REQUEST['AMOUNT'].':]w5[@%AfLbCl&db:'.$_REQUEST['MERCHANT_ORDER_ID']);
if($sign != $_REQUEST['SIGN']) {
	die('wrong sign');
}


$db = new DB();
$db_srv = new DB($srv['db']);

// get name
$name = $_REQUEST['us_name'];

// get custom fields (id/privilege/server_id)
$account_field = $_REQUEST['us_custom_field'];
$account = explode('_', $account_field);


if ($db_srv->status !== true)
    return $this->getResponseError('Ошибка подключения к БД сервера!' . $db_srv->status);

$data = $db->get("select * from pay where id = {$account[0]}");

// Выдача кейсов
if ($srv_id == 2) {
    $cases = $db_srv->get("SELECT * FROM `megacase` WHERE `name`= '" . $data[0]['name'] . "' LIMIT 1");

    if ($cases)
        $setc = $db_srv->query("UPDATE `megacase` SET `count` = `count` + " . $group['coint_case'] . " WHERE `name` = '" . $data[0]['name'] . "'");
    else
        $setc = $db_srv->query("INSERT INTO `megacase` (`name`,`count`) VALUES ('" . $data[0]['name'] . "','" . $group['coint_case'] . " ')");

    if ($setc)
        return $this->getResponseSuccess('Платёж завершён, кейс выдан');
    else
        return $this->getResponseError('Не удалось выдать кейс, из-за ошибки сервера, id платежа: ' . $data[0]['id'] . '; db_erros: ' . $db_srv->mysqli->error);
} else {
    $rcon = new Rcon($data[0]);
    $cmd_data = $rcon->privilege_pay($data[0]['id']);
    $srv_id = $account[2];
    if ($srv_id == 1) {
        
        $parent = $cfg['servers']['Выживание']['privileges']['Привилегии'][$account[1]]['role'];
        echo "here";
        echo $parent;
        // Generate a UUID for the 'name' field
        $new_query = "SELECT `name` FROM permissions_surv WHERE `value` = '$name'";
        $result = $mysqli->query($new_query);
        $uuid = 0;
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $uuid = $row['name'];
                }
            }
            // Define the new user data
            $newUser = array(
                'child' => $uuid,
                'parent' => $parent,
                'type' => 1,
                'world' => '',
            );
            $checkQuery = "SELECT COUNT(*) as count FROM permissions_inheritance WHERE child = '$uuid'";
            // Execute the query
            $result = $mysqli->query($checkQuery);

            if ($result) {
                // Fetch the count from the result
                $row = $result->fetch_assoc();
                $count = $row['count'];
                // Close the result set
                $result->close();
                // Check if there are no elements with the specified parent
                if ($count == 0) {
                    // Generate the SQL query for inserting the new user
                    $columns = implode(', ', array_keys($newUser));
                    $values = "'" . implode("', '", array_values($newUser)) . "'";
                    $insertQuery = "INSERT INTO permissions_inheritance ($columns) VALUES ($values)";
                    // Execute the insert query
                    if ($mysqli->query($insertQuery)) {
                        echo "New user inserted successfully with name '$name'.";
                    } else {
                        echo "Error inserting user: " . $mysqli->error;
                    }
                } else {
                    // Elements with parent equal to $uuidToCheck exist, do not perform the insertion
                    echo "Insertion canceled because elements with parent equal to $uuidToCheck already exist.";
                    $update_query = "UPDATE permissions_inheritance SET parent = '$parent' WHERE child = '$uuid'";
                    if ($mysqli->query($update_query)) {
                        echo "User 'parent' was successfully updated!";
                    } else {
                        echo "Error inserting user: " . $mysqli->error;
                    }
                }
            } else {
                // Query execution failed
                echo "Query failed: " . $mysqli->error;
            }
        } else {
            echo "Error inserting user..";
        }
    }

    if ($cmd_data) {
        echo 'Платёж завершён, ответ сервера: ' . preg_replace('![^\w\d\s]*!');
        return $this->getResponseSuccess('Платёж завершён, ответ сервера: ' . preg_replace('![^\w\d\s]*!', '', $cmd_data));
    } else {
        echo 'Не удалось выдать товар на сервере, id платежа: ' . $data[0]['id'];
        return $this->getResponseError('Не удалось выдать товар на сервере, id платежа: ' . $data[0]['id']);
    }
}

die('OK');
