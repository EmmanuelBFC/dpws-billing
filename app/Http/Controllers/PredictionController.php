<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Exception;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public function edit($id){
        
        $breadcrumb = 'Editer la prevision';
        $prediction = Prediction::where('id',$id)->first();
        return view('prediction.edit',compact('prediction','breadcrumb'));
    }

    public function update(Prediction $prediction, Request $request){

         $prediction = Prediction::where('id',$prediction->id)->first();
         
        $prediction->update([
            'partenaire' => $request->partenaire,
            'tractor' => $request->tractor,
            'trailer' => $request->trailer,
            'container_number' => $request->container_number,
            'seal_number' => $request->seal_number,
            'loader' => $request->loader,
            'product' => $request->product,
            'operation' => $request->operation,
        ]);
                return to_route('prediction.index')->with('success','Modification reussite');
    }

}
