<?php
class BlockIoServeice{

	private $apiKey 	= "";	// YOUR API KEY FOR DOGECOIN, BITCOIN, OR LITECOIN 
	private $pin  		= ""; 	// YOUR SECRET PIN
	private $version 	= "2";	// the API version to use

	public function __construct(){
		if(empty($this->apiKey) || empty($this->pin) || empty($this->version)){
			try {
			    throw new Exception('apiKey, pin and version cannot be empty.');
			} catch(Exception $e) {
			    echo $e->getMessage();
			}
		}
	}

	/**
	* Main Curl Request
	**/
	private function cRequest($urlcomponent, $params = []){
		$url = 'https://block.io/api/v'.$this->version.'/'.$urlcomponent.'?api_key='.$this->apiKey.'&pin='.$this->pin;

		$curl = curl_init();
		foreach($params as $param => $value){
			if(is_array($value)){
				$value = implode(',', $value);
			}
			$url .= '&' . $param . '=' . $value;
		}
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_SSL_VERIFYPEER => false //for non ssl
		));
		$response = curl_exec($curl);
		curl_close($curl); 
		//print_r(curl_error($ch));
		return json_decode($response);
	}
	
	/**
	* Address Related
	**/
	public function get_balance(){
		return $this->cRequest('get_balance');
	}
	public function get_new_address($params = []){
		return $this->cRequest('get_new_address', $params);
	}
	public function get_my_addresses(){
		return $this->cRequest('get_my_addresses');
	}
	public function get_address_balance($params = []){
		return $this->cRequest('get_address_balance', $params);
	}
	public function get_address_by_label($params){
		return $this->cRequest('get_address_by_label', $params);
	}

	/**
	* Withdrawal Related
	**/
	public function withdraw($params){
		return $this->cRequest('withdraw', $params);
	}
	public function withdraw_from_addresses($params){
		return $this->cRequest('withdraw_from_addresses', $params);
	}
	public function withdraw_from_labels($params){
		return $this->cRequest('withdraw_from_labels', $params);
	}
	public function get_network_fee_estimate($params){
		return $this->cRequest('get_network_fee_estimate', $params);
	}

	/**
	* Archive Related
	**/
	public function archive_addresses($params){
		return $this->cRequest('archive_addresses', $params);
	}
	public function unarchive_addresses($params){
		return $this->cRequest('unarchive_addresses', $params);
	}
	public function get_my_archived_addresses($params){
		return $this->cRequest('get_my_archived_addresses', $params);
	}

	/**
	* Current price Related
	**/
	public function get_current_price($params = []){
		return $this->cRequest('get_current_price', $params);
	}

	/**
	* BlockIO Green address Related
	**/
	public function is_green_address($params){
		return $this->cRequest('is_green_address', $params);
	}
	public function is_green_transaction($params){
		return $this->cRequest('is_green_transaction', $params);
	}

	/**
	* Transaction Related
	**/
	public function get_transactions($params){
		return $this->cRequest('get_transactions', $params);
	}

	/**
	* Webhook Related
	**/
	public function create_notification($params){
		return $this->cRequest('create_notification', $params);
	}
	public function get_notifications($params){
		return $this->cRequest('get_notifications', $params);
	}
}
