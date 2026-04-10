<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $with = ['user'];
    protected $casts = [
        'date_weighing_entry' => 'date:d-m-Y',
        'date_weighing_output' => 'date:d-m-Y',
        'date_entry' => 'date:d-m-Y',
        'date_exit' => 'date:d-m-Y',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
