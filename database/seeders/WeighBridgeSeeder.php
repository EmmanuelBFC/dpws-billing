<?php

namespace Database\Seeders;

use App\Models\Weighbridge as ModelsWeighbridge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeighBridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsWeighbridge::create([
            'id' => 1,
            'label' => 'P21',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 2,
            'label' => 'P04',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 3,
            'label' => 'P11',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 4,
            'label' => 'P02',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 5,
            'label' => 'P10',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 6,
            'label' => 'P01',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 7,
            'label' => 'P18-19',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 8,
            'label' => 'P05',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 9,
            'label' => 'P20',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 10,
            'label' => 'P17',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 11,
            'label' => 'P16',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 12,
            'label' => 'Direction',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 13,
            'label' => 'P18',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        ModelsWeighbridge::create([
            'id' => 14,
            'label' => 'P19',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
