<?php
include_once 'DB.class.php';
include_once 'Pay.class.php';
include_once 'Config.class.php';
error_reporting(0);

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
        if (isset($_REQUEST['buy']) or $_REQUEST['buy'] == 1) {

            if (preg_match('/[^a-zA-Z0-9_]/', $_REQUEST['nick'])) {
                $this->add_message('Во время покупки привелегии произошла ошибка!', true);
                header('Location: .');
                die();
            }

            $serv_id = $_REQUEST['srv_id'];
            $nick       = $_REQUEST['nick'];
            $group   = $_REQUEST['group'];
            $promo   = $_REQUEST['promocode'];

            // +++++++++ load image +++++++++
            $uniqueFileName = null;
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $uniqueFileName = time() . '_' . uniqid();
                $uploadPath = $uploadDir . $uniqueFileName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);
                $this->resizeImage($uploadPath, 1152, 640);
            }
            // +++++++++ end +++++++++

            $a = $this->buy($nick, $group, $serv_id, $promo, $uniqueFileName);
        }
        if (isset($_REQUEST['successfully'])) $this->add_message('Вы успешно купили привилегию!');
        if (isset($_REQUEST['error'])) $this->add_message('Во время покупки привелегии произошла ошибка!', true);
    }


    // Function to resize the image
    public function resizeImage($filePath, $width, $height)
    {
        list($originalWidth, $originalHeight, $imageType) = getimagesize($filePath);

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $imageOriginal = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $imageOriginal = imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_GIF:
                $imageOriginal = imagecreatefromgif($filePath);
                break;
            default:
                die("Unsupported image type");
        }

        $imageResized = imagecreatetruecolor($width, $height);

        imagecopyresampled($imageResized, $imageOriginal, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

        // Save the resized image back to the original file path
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($imageResized, $filePath);
                break;
            case IMAGETYPE_PNG:
                imagepng($imageResized, $filePath);
                break;
            case IMAGETYPE_GIF:
                imagegif($imageResized, $filePath);
                break;
        }

        // Free up memory
        imagedestroy($imageResized);
        imagedestroy($imageOriginal);
    }

    public static function find_group_for_list($name, $list)
    {
        $el = false;
        $name = str_replace('case_', '', strtolower($name));
        foreach ($list as $prev_groups) {
            foreach ($prev_groups as $prev_name => $prev) {
                $group_name = strtolower(@end(explode(' ', $prev['cmd'])));
                if ($group_name == $name) {
                    $prev['name'] = $prev_name;
                    $el = $prev;
                    break 2;
                }
            }
        }
        return $el;
    }
    private function get_extra_permissions($nick, $srv)
    {
        $server = Main::get_srv($srv);
        if (!$server) return 0;
        $db_server = new DB($server['db']);
        $uuid = $db_server->get("SELECT `name` AS uuid FROM `permissions_surv` WHERE `permission` = 'name' AND `value` = '" . $db_server->escape($nick) . "'");
        if (empty($uuid) || !isset($uuid[0]['uuid'])) return 0;
        else $uuid = $uuid[0]['uuid'];
        $permissions = $db_server->get("SELECT * FROM `permissions_inheritance` WHERE `child` = '$uuid'"); // `parent` LIKE 'case_%' AND
        if (empty($permissions)) return 0;
        $privileges_all = $server['privileges'];
        $sum = 0;
        foreach ($permissions as $perm) {
            $privilege = Main::find_group_for_list($perm['parent'], $privileges_all);
            if ($privilege) {
                $sum += (int)$privilege['price'];
            }
        }
        return $sum;
    }
    public function get_extra($nick, $srv, $group_id = false)
    {
        if ($group_id !== false) {
            $group = Main::get_group((int)$group_id, $srv);
            if ($group && isset($group['no_extra']) && $group['no_extra']) return 0;
        }
        return $this->get_extra_permissions($nick, $srv);
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

    public function buy($name, $group_id, $srv_id, $promo, $img_name)
    {
        $name = trim($name);
        if (empty($name)) return $this->add_message('Ник не введён!', true);
        $group = Main::get_group($group_id, $srv_id);
        if (!$group) return $this->add_message('Группы не существует!', true);
        $price = (int)$group['price'];
        $extra = $this->get_extra($name, $srv_id, $group_id);



        // insert into server's db <------ START ------>
        $server = Main::get_srv($srv_id);
        if (!$server) return 0;
        $db_server = new DB($server['db']);
        // Check if the connection was successful
        if (!$db_server->status) {
            die("Failed to connect to MySQL: " . $db_server->status);
        }

        if ($srv_id == 1) {
            $parent = Config::$cfg['servers']['Выживание']['privileges']['Привилегии'][$group['name']]['role'];

            // Generate a UUID for the 'name' field
            $new_query = "SELECT `name` FROM permissions_surv WHERE `value` = '$name'";
            $result = $db_server->query($new_query);
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $uuid = $row['name'];
                    }
                }
                if ($uuid == "") {
                    // echo "user doesn't  exists..";
                    // Generate a UUID for the 'name' field
                    $uuid = uniqid();

                    // Define the new user data
                    $newUser = array(
                        'name' => $uuid,
                        'type' => $srv_id,
                        'permission' => 'name',
                        'world' => '',
                        'value' => $name,
                    );

                    // Generate the SQL query for inserting the new user
                    $tableName = 'permissions_surv'; // Specify the table name
                    $columns = implode(', ', array_keys($newUser));
                    $values = "'" . implode("', '", array_values($newUser)) . "'";
                    $insertQuery = "INSERT INTO $tableName ($columns) VALUES ($values)";
                    $db_server->query($insertQuery);
                } else {
                    // echo $uuid . "user exists!";
                }
            } else {
                echo 'error occured..';
            }
        }

        // insert into server's db <------ END ------>


        // Perform the INSERT operation
        $result = $this->db->mysqli->query("INSERT INTO `pay` ( `name`,`pid`, `status`, `time`, `price`, `srv_id`, `extra`) VALUES ( '{$name}', '" . (int)$group['id'] . "', '0', '" . time() . "',  " . $price . ", " . (int)$srv_id . ", " . $extra . " )");
        // Check if the INSERT operation was successful
        if ($result) {
            $price_ = 0;
            if ($price - $extra <= 0) {
                $_SESSION['price'] = $price;
                $price_ = $price;
            } else {
                $_SESSION['price'] = $price - $extra;
                $price_ = $price - $extra;
            }

            return $this->pay->redirect($this->db->mysqli->insert_id . '_' . $group['name'] . '_' . $srv_id, $price_, $group['name'], $promo, $name, $img_name);
        } else {
            return $this->add_message('Failed to insert data into the database', true);
        }
    }
}
