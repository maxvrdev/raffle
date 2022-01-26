<?php

namespace Database\Seeders;

use App\Models\RaffleType;
use Illuminate\Database\Seeder;

class RaffleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raffle_types = [
            'Raffle A',
            'Raffle B',
            'Raffle C'
            ];

        foreach ($raffle_types as $type) {
            RaffleType::create(['name' => $type]);
        }
    }
}
