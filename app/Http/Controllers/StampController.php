<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Weighbridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StampController extends Controller
{
    public function index(){

        $breadcrumb = "cachet";
        $stamps = Stamp::all();

        return view('stamp.index',compact('breadcrumb','stamps'));
    }

    public function create(){
        $breadcrumb = "Creer cachet";
        $weighbridges = Weighbridge::all();
        return view('stamp.create',compact('breadcrumb','weighbridges'));
    }

    public function store(Request $request){


        $request->validate([
            'weighbridge_id' => 'required',
            'path' => 'required'
        ]);

        $stamp = Stamp::create([
            'path' => '',
            'weighbridge_id' => $request->weighbridge_id,
        ]);

        $bridge = $stamp->weighbridge->label;

        tap($stamp)->update(['path' => $request->path->store('Stamp/'.$bridge,'public')]);

        return redirect()->route('stamp.index')->with('message','cachet enregistré avec succès');
    }

    public function show(){

    }

    public function edit($id){

        $breadcrumb = "Modifier le cachet";
        $weighbridges = Weighbridge::all();
        $stamp = Stamp::where('id',$id)->first();
        return view('stamp.edit',compact('breadcrumb','weighbridges','stamp'));
    }

    public function update(Request $request, Stamp $stamp){

            $request->validate([
                'weighbridge_id' => 'required',
                'path' => 'required'
            ]);

            Storage::delete('stamp/'.$stamp->label);

            $stamp =  tap($stamp)->update([
                'path' => '',
                'weighbridge_id' => $request->weighbridge_id,
            ]);

            $bridge = $stamp->weighbridge->label;
            tap($stamp)->update(['path' => $request->path->store('Stamp/'.$bridge,'public')]);


        return redirect()->route('stamp.index')->with('message','cachet modifié avec succès');

    }
}
