<?php

namespace Database\Seeders;

use App\Models\TypeWeighing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeWeighingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       TypeWeighing::create([
           'id' => 1,
           'label' => 'Pesée normale',
           'price' => 10000,
           'tax_amount' => 1925,
           'total_amount' => 11925,
       ]);
       TypeWeighing::create([
           'id' => 2,
           'label' => 'Pesée test',
           'price' => 5000,
           'tax_amount' => 962,
           'total_amount' => 5962,
       ]);
       TypeWeighing::create([
           'id' => 3,
           'label' => 'Pesée test RCA/TCHAD',
           'price' => 3750,
           'tax_amount' => 721,
           'total_amount' => 4502,
       ]);
        TypeWeighing::create([
            'id' => 4,
            'type' => 'Direction',
            'label' => 'Import/Export RCA/TCHAD',
            'price' => 7500,
            'tax_amount' =>1443,
            'total_amount' => 8945,
        ]);
        TypeWeighing::create([
            'id' => 5,
            'type' => 'Direction',
            'label' => 'Pesée normale',
            'price' => 10000,
            'tax_amount' => 1925,
            'total_amount' => 11925,
        ]);
        TypeWeighing::create([
            'id' => 6,
            'type' => 'Direction',
            'label' => 'Pesée test normale',
            'price' => 5000,
            'tax_amount' => 962,
            'total_amount' => 5965,
        ]);
        TypeWeighing::create([
            'id' => 7,
            'type' => 'Direction',
            'label' => 'Pesée test RCA/TCHAD',
            'price' => 3750,
            'tax_amount' => 721,
            'total_amount' => 4502,
        ]);
        TypeWeighing::create([
            'id' => 8,
            'type' => 'Direction',
            'label' => 'Import vrac RCA/TCHAD',
            'price' => 250,
            'tax_amount' => 48,
            'total_amount' => 298,
        ]);
        TypeWeighing::create([
            'id' => 9,
            'type' => 'Direction',
            'label' => 'GIRC (RIZ)',
            'price' => 333,
            'tax_amount' => 64,
            'total_amount' => 397,
        ]);
        TypeWeighing::create([
            'id' => 10,
            'type' => 'Direction',
            'label' => 'GPDSC (SEL)',
            'price' => 250,
            'tax_amount' => 48,
            'total_amount' => 298,
        ]);
        TypeWeighing::create([
            'id' => 11,
            'type' => 'Direction',
            'label' => 'GIMC (MEUNIERS)',
            'price' => 250,
            'tax_amount' => 48,
            'total_amount' => 298,
        ]);
        TypeWeighing::create([
            'id' => 12,
            'type' => 'Direction',
            'label' => 'AFISA BLE',
            'price' => 333,
            'tax_amount' => 64,
            'total_amount' => 397,
        ]);
        TypeWeighing::create([
            'id' => 13,
            'type' => 'Direction',
            'label' => 'SOJA',
            'price' => 250,
            'tax_amount' => 48,
            'total_amount' => 298,
        ]);
        TypeWeighing::create([
            'id' => 14,
            'type' => 'Direction',
            'label' => 'AUTRE PRODUITS VRAC',
            'price' => 333,
            'tax_amount' => 64,
            'total_amount' => 397,
        ]);
    }
}
