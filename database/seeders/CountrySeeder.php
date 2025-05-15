<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $response = Http::get('https://api.first.org/data/v1/countries');

            if ($response->successful()) {
                $countries = $response->json()['data'] ?? [];

                foreach ($countries as $country) {
                    Country::create([
                        'name' => $country['country'],
                        'code' => $country['code'] ?? null,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Failed to fetch countries: '.$e->getMessage());
        }
    }
}
