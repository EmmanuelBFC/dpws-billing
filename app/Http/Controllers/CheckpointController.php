<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Weighbridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckpointController extends Controller
{
    public function index()
    {
        $breadcrumb = "Contrôle camion";
        return view('checkpoint.index', compact('breadcrumb'));
    }

    public function edit(Invoice $invoice)
    {

        $invoice = Invoice::where('id', $invoice->id)->first();

        if (is_null($invoice))
            throw new \Exception;

        $breadcrumb = "Détails";
        return view('checkpoint.detail', compact('breadcrumb', 'invoice'));
    }

    public function updateEntry(Invoice $invoice)
    {

        try {

            $invoice = Invoice::where('id', $invoice->id)->first();

            if (is_null($invoice))
                throw new \Exception('impossible de trouver la facture');

            $weight_bridge = Weighbridge::where('id', auth()->user()->currentBridge)->first();
            if (is_null($weight_bridge))
                throw new \Exception('Impossible de trouver le pont passé en paramètre (CheckPointController)');

            $invoice->update([
                'seen_entry_control' => 'oui',
                'name_controleur_input' => auth()->user()->name,
                'date_entry' => Carbon::now(),
                'weighbridge_entry' => $weight_bridge->label,
            ]);

            session()->flash('success', 'contrôle en entrée ok');
            return redirect()->to('/checkpoint/index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'une erreur est survenu, veuillez réessayer si besoin rapprochez-vous d\'un IT en service');
            return redirect()->back();
        }
    }

    public function updateExit(Invoice $invoice)
    {

        try {
            $invoice = Invoice::where('id', $invoice->id)->first();

            if (is_null($invoice))
                throw new \Exception('impossible de retrouver cette facture... delail');

            $weight_bridge = Weighbridge::where('id', auth()->user()->currentBridge)->first();

            if (is_null($weight_bridge))
                throw new \Exception('Impossible de trouver le pont passé en paramètre (CheckPointController)');
            
            $invoice->update([
                'seen_exit_control' => 'oui',
                'name_controleur_ouput' => auth()->user()->name,
                'date_exit' => Carbon::now(),
                'weighbridge_exit' => $weight_bridge->label,
            ]);
            session()->flash('success', 'contrôle en sortie ok');
            return redirect()->to('/checkpoint/index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'une erreur est survenu, veuillez réessayer si besoin rapprochez-vous d\'un IT en service');
            return redirect()->back();
        }
    }
}
