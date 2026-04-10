<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWeighing extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'type',
        'price',
        'tax_amount',
        'total_amount'
    ];

    public function invoices(){

        return $this->hasMany(Invoice::class);
    }
}
