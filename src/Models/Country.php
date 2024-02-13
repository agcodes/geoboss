<?php
namespace App\Models;
class Country
{
	public string $name;
	public array $names;
	public string $status;
	public int $unMember;
	public array $idd;
	public array $capitals;
	public string $capital;
	public array $altSpellings;
	public string $region;
	public array $languages;
	public array $translations;
	public array $latlng;
	public int $area;
	public string $flag;
	public array $maps;
	public int $population;
	public array $car;
	public array $timezones;
	public array $continents;
	public array $flags;
	public array $coatOfArms;
	public array $capitalInfo;

	public function __construct(array $data)
	{
		if (!empty($data)) {
			$this->initializeWithData($data);
		}
	}

	public function initializeWithData(array $data)
	{
		$this->names = isset($data['name']) ? $data['name'] : [];
		$this->name = isset($this->names['common']) ? $this->names['common'] : null;
		$this->status = isset($data['status']) ? $data['status'] : null;
		$this->unMember = isset($data['unMember']) ? $data['unMember'] : null;
		$this->idd = isset($data['idd']) ? $data['idd'] : [];
		$this->capitals = (isset($data['capital']) &&  is_array($data['capital'])) ? $data['capital'] : [];
		if (count($this->capitals) > 0){
			$this->capital = $this->capitals[0];
		}
		$this->altSpellings = isset($data['altSpellings']) ? $data['altSpellings'] : [];
		$this->region = isset($data['region']) ? $data['region'] : null;
		$this->languages = isset($data['languages']) ? $data['languages'] : [];
		$this->translations = isset($data['translations']) ? $data['translations'] : [];
		$this->latlng = isset($data['latlng']) ? $data['latlng'] : null;
		$this->area = isset($data['area']) ? $data['area'] : null;
		$this->flag = isset($data['flag']) ? $data['flag'] : null;
		$this->maps = isset($data['maps']) ? $data['maps'] : null;
		$this->population = isset($data['population']) ? $data['population'] : null;
		$this->car = isset($data['car']) ? $data['car'] : [];
		$this->timezones = isset($data['timezones']) ? $data['timezones'] : [];
		$this->continents = isset($data['continents']) ? $data['continents'] : [];
		$this->flags = isset($data['flags']) && $data['flags'] !== null ? $data['flags'] : [];
		$this->coatOfArms = isset($data['coatOfArms']) ? $data['coatOfArms'] : [];
		$this->capitalInfo = isset($data['capitalInfo']) ? $data['capitalInfo'] : [];
	}
}
