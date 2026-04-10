<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query
            ->with('customer') // 🔁 Joindre la relation
            ->with('modePayment') // 🔁 Joindre la relation
            ->with('user') // 🔁 Joindre la relation
            ->with('modePayment') // 🔁 Joindre la relation
            ->with('myTractor') // 🔁 Joindre la relation
            ->with('myTrailer') // 🔁 Joindre la relation
            ->with('weighbridge') // 🔁 Joindre la relation
            ->with('typeWeighing') // 🔁 Joindre la relation
            ->get()
            ->map(function ($invoice) {
                return [
                    'Clé'    =>   $invoice->id?? 'Inconnu',
                    'N° facture'    => $invoice->invoice_no?? 'Inconnu',
                    'Reçu de'       => $invoice->customer->label ?? 'Inconnu',
                    'Date'          => $invoice->created_at->format('d/m/Y H:i')?? 'Inconnu',
                    'Montant TTC'   => $invoice->total_amount?? 'Inconnu',
                    'Facturé par'   => $invoice->user->name?? 'Inconnu',
                    'Mode paiement'  => $invoice->modePayment->label ?? 'Inconnu', // 🔁 Affichage du nom
                    'Code Transaction'  => $invoice->who_paid_back ?? '',
                    'tracteur'      => $invoice->myTractor->label ?? 'Inconnu',
                    'conteneur'      => $invoice->myTrailer->label ?? 'Inconnu',
                    'Statut facture'=> $invoice->status_invoice?? 'Inconnu',
                    'Pont bascule'  => $invoice->weighbridge->label?? 'Inconnu',
                    'Type de pesée' => $invoice->typeWeighing->label ?? 'Inconnu',
                    // 'amount'        => $invoice->typeWeighing->label ?? 'Inconnu',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Clé',
            'N° facture',
            'Reçu de',
            'Date',
            'Montant TTC',
            'Facturé par',
            'Mode paiement',
            'Code Transaction',
            'tracteur',
            'conteneur',
            'Statut facture',
            'Pont bascule',
            'Type de pesée',
        ];
    }
}
