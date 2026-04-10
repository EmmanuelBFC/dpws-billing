<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Signature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SignatureController extends Controller
{

    public function index(){

        $breadcrumb = "signature";
        $signatures = Signature::all();
        return view('signature.index',compact('signatures','breadcrumb'));
    }

    public function create(){

        $breadcrumb = "Creer une signature";
        $users = User::all();
        return view('signature.create',compact('users','breadcrumb'));
    }

    public function store(Request $request){

            $request->validate([
                'user_id' => 'required',
                'path' => 'required'
            ]);

        $signature = Signature::create([
            'path' => '',
            'user_id' =>  $request->user_id,
        ]);
       // $user = Str::substr( str_replace(" ",'',$signature->user->name),0,14);
        tap($signature)->update(['path'=> $request->path->store('signature/'.$signature->user->id,'public')]);

        return redirect()->route('signature.index')->with('message','signature enregistré avec succès');
    }

    public function edit($id){

        $breadcrumb = "Modifier la signature";
        $signature = Signature::where('id',$id)->first();
        $users = User::all();
        return view('signature.edit',compact('signature','breadcrumb','users'));
    }

    public function update(Request $request, Signature $signature){

        $request->validate([
            'user_id' => 'required',
            'path' => 'required'
        ]);

        $signature = Signature::where('id',$signature->id)->first();
        // dd($signature->user->name);
        //on efface l'ancien repertoire
        $user = Str::substr($signature->user->name,0,15);
        Storage::deleteDirectory($user);

        // on crée un nouveau repertoire avec le nouveau nom de l'utilisateur choisi
        $userUpdated = User::firstWhere('id',$request->user_id);
        $newDirectory = Str::substr($userUpdated->name,0,15);

        $signature->update([
            'user_id' => $request->user_id,
            'path' =>  $request->path->store('signature/'.$newDirectory,'public'),
        ]);

        return redirect()->route('signature.index')->with('message','mise à jour réussi avec succès');

    }

    public function show(){

    }
}
