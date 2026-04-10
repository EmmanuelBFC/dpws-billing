<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'weighbridge_id'
    ];

    public function weighbridge(){

        return $this->belongsTo(Weighbridge::class, 'weighbridge_id');
    }
}
