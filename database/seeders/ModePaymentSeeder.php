<?php

namespace Database\Seeders;

use App\Models\ModePayment as modePay;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        modePay::create([
            'id' => 1,
            'label' => 'Paiement Mobile',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        modePay::create([
            'id' => 2,
            'label' => 'Espèce',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
