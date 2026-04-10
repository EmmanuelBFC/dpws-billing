<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class PowerWeightController extends Controller
{
    public function index(){

        try {
            DB::connection()->getPDO();
            echo DB::connection()->getDatabaseName();
            } catch (\Exception $e) {
            echo 'None';
        }
    }
}
