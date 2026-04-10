<?php

namespace App\Http\Livewire\Refund;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Refund extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.refund.refund',[

            'refunds' => Invoice::where('isRefunded',false)
                                  ->where('user_id',auth()->user()->id)
                                  ->orderByDesc('date_payback','DESC')
                                  ->paginate(10, ['*'], 'refundsPage'),

            'refunded'=> Invoice::where('isRefunded',true)
                                  ->where('user_id',auth()->user()->id)
                                  ->where('who_paid_back','<>',null)
                                  ->orderByDesc('updated_at','DESC')
                                  ->paginate(10,['*'],'refundedPage')
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

}
