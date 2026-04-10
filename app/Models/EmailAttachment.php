<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAttachment extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    protected $fillable=['name','path','report_id','mime_type'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
