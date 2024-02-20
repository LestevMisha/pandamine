<?php

/*
 * UnitPay
 */
include_once 'Config.class.php';
include_once 'DB.class.php';
include_once 'Rcon.class.php';
class Pay{
    public function __construct(){
        $this->cfg = Config::$cfg;
    }
    public function if_pay($data){
        if(!isset($data['method'])) return false;
        $method = $data['method'];
        if(isset($method) && ($method == 'check' || $method == 'pay' || $method == 'error')) return true;
        else return false;
    }
    public function handler($data){
        $db = new DB();
        $method = $data['method'];
        $params = $data['params'];
		$account = $this->account_get_id($params['account']);
        if(empty($params)) return $this->getResponseError('Параметры не были переданны!');
        if(@$params['signature'] != $this->getSha256SignatureByMethodAndParams($method,$params,$this->cfg['SECRET_KEY'])) return $this->getResponseError('Подпись не совпдает!');
        if($method == 'check'){
            $data = $db->get('SELECT * FROM `pay` WHERE `id` = '.$account);
            if(!$data) return $this->getResponseError('Платёж не существует!');
            if($params['sum'] != (int)$data[0]['price'] - (int)$data[0]['extra']) return $this->getResponseError('Сумма не совподает!');
            return $this->getResponseSuccess('Платёж имеет правильные данные!');
        }
        elseif($method == 'pay'){
            $data = $db->get('SELECT * FROM `pay` WHERE `id` = '.$account);
            if(!$data) return $this->getResponseError('Платёж не существует!');
            if($data[0]['status'] == 1) return $this->getResponseError('Платёж уже оплачен!');
            $db->query('UPDATE `pay` SET status = 1 WHERE `id` = '.$account);
            $rcon = new Rcon($data[0]);
            $cmd_data = $rcon->privilege_pay($data[0]['id']);
            if($cmd_data) return $this->getResponseSuccess('Платёж завершён, ответ сервера: '.$cmd_data);
            else return $this->getResponseError('Не удалось выдать товар на сервере, id платежа: '.$data[0]['id']);
        }
        else return $this->getResponseError('Метод не поддерживается: '.$method);
    }
    public function redirect($account, $sum, $privilege_name){
        $signature = hash('sha256', $account.'{up}RUB{up}Покупка группы '.$privilege_name.'{up}'.$sum.'{up}'.$this->cfg['SECRET_KEY']);
        exit(header('Location: https://unitpay.ru/pay/'.$this->cfg['PUBLIC_KEY'].'?sum='.$sum.'&account='.$account.'&desc=Покупка группы '.$privilege_name.'&currency=RUB&signature='.$signature));

    }
    public function account_get_id($account){
		return (int)explode('|',$account)[0];
	}
    private function getResponseSuccess($message){
        return @json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }

    private function getResponseError($message){
        return @json_encode(array(
            "jsonrpc" => "2.0",
            "error" => array(
                "code" => -32000,
                "message" => $message
            ),
            'id' => 1
        ));
    }
    private function getSha256SignatureByMethodAndParams($method, array $params, $secretKey){
        $delimiter = '{up}';
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);

        return hash('sha256', $method.$delimiter.join($delimiter, $params).$delimiter.$secretKey);
    }
}

?>