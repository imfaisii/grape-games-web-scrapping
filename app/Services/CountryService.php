<?php

namespace App\Services;

use App\Models\Country;
use MenaraSolutions\Geographer\Earth;

class CountryService
{
    protected $countries = [];
    
    public function __construct()
    {
        $earth = new Earth();
        $this->countries = $earth->getCountries()->toArray();
    }

    public function populateDatabase()
    {
        $countries = $this->countries;

        foreach ($countries as $country) {
            Country::updateOrCreate([
                'name' => $country['name'],
            ], [
                'code' => $country['code'],
                'code3' => $country['code3'],
                'currency' => $country['currency'],
                'phone_prefix' => $country['phonePrefix']
            ]);
        }
    }
}
