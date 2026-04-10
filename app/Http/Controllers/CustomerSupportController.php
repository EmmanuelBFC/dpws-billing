<?php

namespace App\Http\Controllers;


class CustomerSupportController extends Controller
{

    public function create(){

        $breadcrumb = "support client";

        return view('customer-support', compact('breadcrumb'));
    }

}
