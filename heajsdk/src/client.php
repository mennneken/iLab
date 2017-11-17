<?php
use GuzzleHttp\Client as HttpClient;
session_start();
class HEAJSDK{

	const DEFAULT_BASE_URI = 'http://ilab.garith.xyz/';
	const DEFAULT_TIMEOUT = 2.0;
	protected $clientId;
	protected $clientSecret;

	protected $baseUri;
	protected $timeout;
	protected $httpClient;
	protected $accessToken;

	public function __construct($clientId, $clientSecret){
		$this->baseUri = self::DEFAULT_BASE_URI;
		$this->timeout = self::DEFAULT_TIMEOUT;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->accessToken = '';
		$this->httpClient = new HttpClient([
		    'base_uri' => $this->baseUri,
		    'timeout'  => $this->timeout,
		]);
	}

	public function request($path){
		$params = array(
			'headers' => [
		        'Accept' => 'application/json',
		        'Content-Type' => 'application/json'
		    ]
		);

		$accessToken = $this->getAccessToken();
		if(!empty($accessToken)){
			$params['headers']['Authorization'] = 'Bearer '.$accessToken;
		}

		try{
			$response = $this->httpClient->request('GET', 'api/'.$path, $params);
			$result = $response->getBody();
			return json_decode($result, true);
		}catch(\Exception $e){
			return json_decode((string)$e->getResponse()->getBody(), true);
		}
	}

	public function login($login, $password, $scope = '*'){
		$params = array(
			'form_params' => [
		        'grant_type' => 'password',
		        'client_id' => $this->clientId,
		        'client_secret' => $this->clientSecret,
		        'username' => $login,
		        'password' => $password,
		        'scope' => $scope
	    	]
		);
		try{
			$response = $this->httpClient->request('POST', 'oauth/token', $params);
			$result = $response->getBody();
			$json =  json_decode($result, true);
			if(!empty($json['access_token'])){
				$_SESSION['access'] = $json['access_token'];
				return true;
			}
		}catch(\Exception $e){
			return false;
		}
		
	}

	public function logout(){
		unset($_SESSION['access']);
	}

	public function isConnected(){
		return !empty($_SESSION['access']);
	}

	protected function getAccessToken(){
		if(!empty($this->accessToken)){
			return $this->accessToken;
		}else if(!empty($_SESSION['access'])){
			return $_SESSION['access'];
		}else{
			return false;
		}
	}
}
