<?php

namespace App\Models;

use App\Http\Livewire\Invoice\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weighbridge extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function stamp(){

        return $this->hasOne(Stamp::class);
    }
}
