<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Elections;
use Carbon\Carbon;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $names = [
            'MPM', 'BEM', 'HMM', 'HMPM', 'HIMATIF', 'HIMA-RPL', 'HIMA-SIKC',
            'HIMRA', 'HIMATRIK', 'FORMADIKSI', 'SEBURA', 'KOTAK PENA',
            'FOLAFO', 'RPI', 'KOMPA', 'POPI'
        ];

        foreach ($names as $name) {
            $start = $faker->dateTimeBetween('-1 months', '+1 months');
            $end = (clone $start)->modify('+' . rand(1, 5) . ' days');

            Elections::create([
                'name' => $name,
                'description' => $faker->sentence(),
                'start_date' => $start,
                'end_date' => $end,
            ]);
        }
    }
}
