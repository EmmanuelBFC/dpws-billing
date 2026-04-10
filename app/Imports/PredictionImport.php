<?php

namespace App\Imports;

use App\Models\Prediction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PredictionImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /**
     ** on fais un isset pour rattraper le mauvais template envoyé au client avec la mauvaise entête 
     * ! ajouter le created_at 
     ** row indique les colonnes du fichier excel
    */
    public function model(array $row)
    {  
             return new Prediction([
                'partenaire'     => $row['partenaires'],
                'tractor'     => $row['vehicules'],
                'trailer'    => $row['remorques'], 
                'container_number'    => $row['n_conteneur'], 
                'seal_number'    => $row['n_plomb'],
                'loader'    => $row['chargeur'], 
                'product'    => $row['produit'], 
                'user_id' => auth()->user()->id,
                'operation' => $row['operations'],
                'weighing_status' => 'En attente',
                'created_at' => now(),
                'updated_at' => now(),
                ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    
}
