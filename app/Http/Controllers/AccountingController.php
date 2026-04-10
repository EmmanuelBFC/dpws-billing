<?php

namespace App\Http\Controllers;


use App\Models\Invoice;
use Illuminate\Http\Request;

class AccountingController extends Controller
{

    public function billPending(){

        $breadcrumb = "Facture en attente";
        $invoices = Invoice::all()->reject(function($invoice){
            return $invoice->approved == "validated";
        });

        return view('accounting.bill-pending',compact('invoices','breadcrumb'));
    }

    public function edit($id){

        $breadcrumb = "editer facture";
        $bill = Invoice::where('id',$id)->first();
        return view('accounting.edit',compact('breadcrumb','bill'));
    }

    public function update(Request $request,  $id){

       // dd($request->approved);

        $invoice = Invoice::where('id',$id)->first();

        $invoice->update(['approved' => $request->approved]);

        return to_route('bill-pending')->with('succès','facture approuvé avec succès');

    }

}
