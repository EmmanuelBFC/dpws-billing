<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModePayment extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
