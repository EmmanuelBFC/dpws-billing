<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
