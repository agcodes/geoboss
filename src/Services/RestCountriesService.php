<?php

namespace App\Services;

use App\Models\Country;
use GuzzleHttp\Client;

final class RestCountriesService
{
	private $httpClient;
	private $baseUrl;

	public function __construct(string $url, bool $mockAPI)
	{
		$this->httpClient = new Client();
		$this->baseUrl = $url;
		if ($mockAPI){
			$this->baseUrl = str_replace("SERVER_NAME", $this->getServerUrl(), $this->baseUrl);
		}
	}

	private function getServerUrl() : string
	{
	  $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
	  $server = $_SERVER['SERVER_NAME'];
	  
	 return $protocol.$server;
	  //$port = $_SERVER['REMOTE_PORT'] ;
	  //return $protocol.$server.$port;
	}

	public function getCountries(): array
	{
		$response = $this->httpClient->get($this->baseUrl);
		$results = json_decode($response->getBody()->getContents(), true);

		$countries = [];
		if ($results != null) {
			foreach ($results as $result) {
				if (is_array(($result))) {
					$country = new Country($result);
					if (count($country->capitals) > 0) {
						$countries[] = $country;
					}
				}
			}
		}
		return $countries;
	}

	public function getCountry(string $name): Country
	{
		$countries = $this->getCountries();
		if (is_array($countries)) {
			$foundKey = array_search( $name, array_column($countries, 'name'));
			if ($foundKey>0){
				return $countries[$foundKey];
			}
		}
		return new Country([]);
	}

	public function getRandomCountry(): Country
	{
		$countries = $this->getCountries();
		if (is_array($countries)) {
			// todo : best random ?
			shuffle($countries);
			return $countries[0];
		}
		return new Country([]);
	}

	public function getRandomCountries(int $nb): array
	{
		$countries = $this->getCountries();
		$selectedCountries = [];
		if (is_array($countries) && count($countries) >= $nb) {
			// todo : best random ?
			shuffle($countries);
			// take nb countries
			for ($i = 0; $i < $nb; $i++) {
				$selectedCountries[] = $countries[$i];
			}
		}
		return $selectedCountries;
	}
}
