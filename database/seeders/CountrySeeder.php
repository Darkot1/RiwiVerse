<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Rinvex\Country\CountryLoader;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = CountryLoader::countries();

        foreach ($countries as $countryData) {
            Country::create([
                'name' => $countryData['name']
            ]);
        }
    }
}
