<?php

namespace App\Services;

use App\Models\Country;
use GuzzleHttp\Client;

final class RestCountriesService
{
	private $httpClient;
	private $baseUrl;

	public function __construct(string $url)
	{
		$this->httpClient = new Client();
		$this->baseUrl = $url;
	}

	public function getCountries(): array
	{
		$response = $this->httpClient->get($this->baseUrl . 'all');
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

	public function getRandomCountry(): Country
	{
		$countries = $this->getCountries();
		if (is_array($countries)) {
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
			shuffle($countries);
			for ($i = 0; $i < $nb; $i++) {
				$selectedCountries[] = $countries[$i];
			}
		}
		return $selectedCountries;
	}

	public function getCountryByName($name)
	{
		$response = $this->httpClient->get($this->baseUrl . 'name/' . $name);
		return json_decode($response->getBody()->getContents(), true);
	}
}
