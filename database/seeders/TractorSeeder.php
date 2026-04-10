<?php

namespace Database\Seeders;

use App\Models\Tractor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Tractor::create([
            'id' => 1,
            'label' => 'LTTR674AQ'
        ]);
        Tractor::create([
            'id' => 2,
            'label' => 'LTTR264AU'
        ]);
        Tractor::create([
            'id' => 3,
            'label' => 'LTTR978AO'
        ]);
        Tractor::create([
            'id' => 4,
            'label' => 'LTTR800AV'
        ]);
        Tractor::create([
            'id' => 5,
            'label' => 'ESTR383AA'
        ]);
        Tractor::create([
            'id' => 6,
            'label' => 'ESTR565A'
        ]);
        Tractor::create([
            'id' => 7,
            'label' => 'CETR465AE'
        ]);
        Tractor::create([
            'id' => 8,
            'label' => 'CETR471AE'
        ]);
        Tractor::create([
            'id' => 9,
            'label' => 'CETR027AE'
        ]);
        Tractor::create([
            'id' => 10,
            'label' => 'LTTR435AQ'
        ]);
    }
}
