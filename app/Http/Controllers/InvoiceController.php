<?php

namespace App\Http\Controllers;


use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function index()
    {
        $breadcrumb = "Facturation";
        return view('invoice', compact('breadcrumb'));
    }

    public function pdf($id){

        $data = Invoice::where('id',$id)->first();

        InvoiceService::invoiceBuilder($data,'preview');
    }

    public function pdfWithCoupon($id){

        $data = Invoice::where('id',$id)->first();

        InvoiceService::invoiceBuilderWithCoupon($data,'preview');
    }

    public function myInvoice(){

        $breadcrumb = "liste factures";
        $invoices = Invoice::where('user_id', Auth::user()->id)->paginate(10);

        if(Auth::user()->isAdmin() || Auth::user()->isAdministration() ){
            $invoices = Invoice::paginate(10);
            return view('list-invoice',compact('invoices','breadcrumb'));
        }

        return view('list-invoice',compact('invoices','breadcrumb'));
    }

    public function allInvoice(){
        $breadcrumb = "liste factures";
        $invoices = Invoice::orderBy('created_at','DESC')->paginate(10);
        return view('list-invoice2',compact('invoices','breadcrumb'));
    }

    public function refund(){

        $breadcrumb = "Mes remboursements";
        return view('refund',compact('breadcrumb'));
    }

    public function export(){

        $breadcrumb = "Exportation";
      //  $invoices = Invoice::whereDate('created_at',now())->get();
        return view('export',compact('breadcrumb'));
    }

    public function exportCG(){

        $data = Invoice::whereDate('created_at',now())->get();

        $cashMoney = Invoice::where('user_id', auth()->user()->id)
                            ->where('mode_payment_id',2)
                            ->whereDate('created_at',now())
                            ->sum('total_amount');
        $mobileMoney = Invoice::where('user_id', auth()->user()->id)
                            ->where('mode_payment_id',1)
                            ->whereDate('created_at',now())
                            ->sum('total_amount');
        $totalAmount = Invoice::where('user_id',auth()->user()->id)
                            ->whereDate('created_at',now())
                            ->sum('total_amount');

        InvoiceService::export($data,$cashMoney,$mobileMoney,$totalAmount,'preview');
    }
}
