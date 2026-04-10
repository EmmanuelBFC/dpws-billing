<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'invoice_no',
        'subtotal',
        'tax_amount',
        'total_amount',
        'amount_paid',
        'remains',
        'mode_payment_id',
        'weighbridge_id',
        'user_id',
        'tractor_id',
        'status_invoice',
        'trailer_id',
        'customer_id',
        'type_weighing_id',
        'path_qrcode',
        'isRefunded',
        'who_paid_back',
        'who_paid_back_id',
        'bridge_that_paid_off',
        'date_payback',
        'deposit',
        'export',
        'slug',
        'status_cancel',
        'seen_entry_control',
        'name_controleur_input',
        'date_entry',
        'seen_exit_control',
        'name_controleur_ouput',
        'date_exit',
        'weight',
        'weighbridge_entry',
        'weighbridge_exit',
    ];
    
    protected $casts =[
      'date_entry' => 'date:d-m-Y',
      'date_exit' => 'date:d-m-Y',
  ];
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['myTractor','myTrailer','typeWeighing','modePayment','weighbridge','user','customer'];


    public function weighbridge(){
        return $this->belongsTo(Weighbridge::class);
    }

    public function modePayment()  {
        return $this->belongsTo(ModePayment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function myTractor(){
        return $this->belongsTo(Tractor::class,'tractor_id');
    }

    public function myTrailer(){

        return $this->belongsTo(Trailer::class, 'trailer_id');
    }

    public function customer(){

        return $this->belongsTo(Customer::class);
    }

    public function typeWeighing(){

        return $this->belongsTo(TypeWeighing::class,'type_weighing_id');
    }
}
