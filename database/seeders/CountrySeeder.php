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
            $response = Http::withoutVerifying()->get('https://api.first.org/data/v1/countries');

            if ($response->successful()) {
                $countriesData = $response->json()['data'] ?? [];

                foreach ($countriesData as $countryCode => $countryInfo) {
                    Country::create([
                        'name' => $countryInfo['country'],
                        'code' => $countryCode, // The key is the country code
                    ]);
                }
                
                $this->command->info('Successfully seeded ' . count($countriesData) . ' countries.');
            } else {
                Log::error('Failed to fetch countries. HTTP Status: ' . $response->status());
                $this->command->error('Failed to fetch countries. HTTP Status: ' . $response->status());
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Failed to fetch countries: '.$e->getMessage());
            $this->command->error('Failed to fetch countries: '.$e->getMessage());
        }
    }
}