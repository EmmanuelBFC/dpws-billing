<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagingUserController extends Controller
{

        public function index(){

            $breadcrumb = "Utilisateur";
            $users = User::all();

            return view('account.index',compact('users','breadcrumb'));
    }


}
