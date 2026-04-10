<?php

namespace App\Services;


use App\Helpers\Numbers\MoneyHelper;
use App\Models\Invoice;
use App\Models\Weighbridge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceService extends Fpdi
{

    private $angle = 0;
    private int $id = 0;
    public function Header(){
        $this->Image(public_path('assets\images\logo\logo-dpws.png'),05,05,30);
        $this->Ln(3);

        // $this->Image(public_path('\assets\images\logo\lotecs.png'),15,109,17);

//        if ($data->status_invoice == "cancelling"){
//            //Affiche le filigrane
//            $pdf->SetFont('Arial','B',50);
//            $pdf->SetTextColor(255,192,203);
//            $pdf->RotatedText(35,190,'Facture annulée',45);
//        }

        // $this->Image(public_path('assets\images\logo\logo-dpws.png'),65,90,60);
    }

    private function RotatedText($x, $y, $txt, $angle)
    {
        //Rotation du texte autour de son origine
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }
    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    public static function invoiceBuilder($data,$type){

        $pdf = new InvoiceService('P','mm','A4');
        $pdf->SetMargins(05,02,1); // starting margin
        $pdf->AddPage();
        $pdf->SetFont('Arial','',11);
        $pdf->Image(public_path( 'storage'.$data->path_qrcode),85,23,20);
        $pdf->Image(public_path( 'storage/'.$data->weighbridge->stamp->path),65,80,40);
        $pdf->Image(public_path('storage/'.optional($data->user->signature)->path),05,92,38);
        $pdf->Cell(200 ,5,utf8_decode('FACTURE ACQUITTEE N° '.$data->invoice_no),0,0,'R');
        $pdf->Ln(10);
        $pdf->Cell(200 ,5,utf8_decode('Date : '.$data->created_at->format('d/m/y H:i:s')),0,0,'R');
        $pdf->Cell(-173 ,10,utf8_decode('www.dpws.cm'),0,0,'R');
        $pdf->Ln(10);
        if($data->weighbridge->label =="Direction"){
            $pdf->Cell(200 ,5,utf8_decode($data->weighbridge->label),0,0,'R');
        }else{
            $pdf->Cell(200 ,5,utf8_decode('Pont bascule : '.$data->weighbridge->label),0,0,'R');
        }
        $pdf->SetFont('Arial','',10);
        $pdf->Ln(20);
        $pdf->Cell(20,10,utf8_decode('Reçu de : '),0,0,'L');
        $pdf->Cell(60,10,utf8_decode($data->customer->label),0,0,'L');
        $pdf->Ln(10);
        $pdf->Cell(99,10,utf8_decode('Droit de pesage attelage : N° Tracteur : '
        .optional($data->myTractor)->label),0,0,'L');
        $pdf->Cell(85,10,utf8_decode('N° Conteneur : '.optional($data->myTrailer)->label),0,0,'L');
        $pdf->Ln(10);
        // $pdf->Cell(99,10,utf8_decode(''),0,0,'L'); // Cell vide pour créer l'espace à gauche
        // $pdf->Cell(85,10,utf8_decode('Code Transaction : '.$data->who_paid_back),0,0,'L');
        // $pdf->Ln(10);
        // $pdf->Cell(35,10,utf8_decode('Mode de paiement : '),0,0,'L');
        // $pdf->Cell(80,10,utf8_decode($data->modePayment->label),0,0,'L');
        // $pdf->Ln(10);
        // if($data->weighbridge->label =="Direction"){

        //     $pdf->Cell(138,10,utf8_decode('Emise par :'),0,0,'L');
        // }else{
        //     $pdf->Cell(138,10,utf8_decode('Chef de Guerite :'),0,0,'L');
        // }
        // // $pdf->Cell(400,10,utf8_decode($data->user->name),0,0,'L');
        // $pdf->text(41,81,utf8_decode($data->user->name));

        // if ($data->deposit){
        //     $pdf->text(144,81,utf8_decode('Montant TTC : '.MoneyHelper::price($data->total_amount)),0,0,'L');
        //     $pdf->text(144,86,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)),0,0,'L');
        // }else{
        //     $pdf->text(144,99,utf8_decode('Montant HT : '.MoneyHelper::price($data->typeWeighing->price)),0,0,'L');
        //     $pdf->text(144,104,utf8_decode('TVA 19.25% : '.MoneyHelper::price($data->typeWeighing->tax_amount)));
        //     $pdf->text(144,109,utf8_decode('Montant TTC : '.MoneyHelper::price($data->typeWeighing->total_amount)));
        //     $pdf->text(144,114,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)));
        //     $pdf->text(06,90,utf8_decode('Signature et cachet'));
        //     if ($data->isRefunded){
        //         if ($data->weighbridge->label =="Direction"){
        //             $pdf->text(144,119,utf8_decode('Montant remboursé : '.MoneyHelper::price($data->remains)));
        //         }else{
        //             $pdf->text(144,119,utf8_decode('Montant à rembourser : 0,00 FCFA'));
        //         }
        //     }else{
        //         $pdf->text(144,119,utf8_decode('Montant à rembourser : '.MoneyHelper::price($data->remains)));
        //     }
        // }
        // $pdf->Cell(35,10,utf8_decode('Mode de paiement : '),0,0,'L');
        // $pdf->Cell(80,10,utf8_decode($data->modePayment->label),0,0,'L');
        // $pdf->Ln(20);  // ← 20mm au lieu de 10mm
        $pdf->Cell(35, 10, utf8_decode('Mode de paiement : '), 0, 0, 'L');
        $pdf->Cell(64, 10, utf8_decode($data->modePayment->label), 0, 0, 'L');
        $pdf->Cell(85, 10, utf8_decode('Code Transaction : '.$data->who_paid_back), 0, 0, 'L');

        // On définit une position Y fixe pour l'émetteur
        $y_position = 75; 
        $pdf->SetY($y_position);
        
        if($data->weighbridge->label =="Direction"){
            $pdf->Cell(35, 10, utf8_decode('Emise par :'), 0, 0, 'L');
        } else {
            $pdf->Cell(35, 10, utf8_decode('Chef de Guerite :'), 0, 0, 'L');
        }
        $pdf->Cell(60, 10, utf8_decode($data->user->name), 0, 0, 'L');

        // On descend pour la signature
        $pdf->text(06, 90, utf8_decode('Signature et cachet'));

        if ($data->deposit){
            $pdf->text(144,95,utf8_decode('Montant TTC : '.MoneyHelper::price($data->total_amount)));
            $pdf->text(144,100,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)));
        }else{
            $pdf->text(144,99,utf8_decode('Montant HT : '.MoneyHelper::price($data->typeWeighing->price)));
            $pdf->text(144,104,utf8_decode('TVA 19.25% : '.MoneyHelper::price($data->typeWeighing->tax_amount)));
            $pdf->text(144,109,utf8_decode('Montant TTC : '.MoneyHelper::price($data->typeWeighing->total_amount)));
            $pdf->text(144,114,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)));
            
            if ($data->isRefunded){
                if ($data->weighbridge->label =="Direction"){
                    $pdf->text(144,119,utf8_decode('Montant remboursé : '.MoneyHelper::price($data->remains)));
                }else{
                    $pdf->text(144,119,utf8_decode('Montant à rembourser : 0,00 FCFA'));
                }
            }else{
                $pdf->text(144,119,utf8_decode('Montant à rembourser : '.MoneyHelper::price($data->remains)));
            }
        }

        $pdf->Ln(50);
        $pdf->Line(2,125,205,125);
        $pdf->SetFont('Arial','',9);
        $pdf->text(05,130,utf8_decode('Douala Port Weighing Services SAS CAPITAL VARIABLE DE 50 000 000 XAF RCCM RC / DLA / 2019 / b / 5453 NUI M121914355936 L'));
        $pdf->text(05,135,utf8_decode('Siège Social : Bonapriso, Lieu dit Ancien dépôt Guinness - Douala B.P 12209 00237 693 957 991 contact@dpws.cm dpws.cm'));
        $pdf->text(05,140,utf8_decode('Compte Afriland First Bank réf : 10005 00002 06463841002 52 swift : cceicmcx iban : cm21 100005 0000206463841002 52'));

        if ($type == "preview")
          return $pdf->Output('','Facture du '.$data->created_at.'.pdf','I');
    }

    public static function invoiceBuilderWithCoupon($data,$type){

        $pdf = new InvoiceService('P','mm','A4');
        $pdf->SetMargins(05,02,1); // starting margin
        $pdf->AddPage();

        //debut coupon
        $pdf->SetFont('Arial','',8);
        $pdf->text(178 ,19,utf8_decode('www.dpws.cm'));
        $pdf->SetFont('Arial','B',7.6);
        $pdf->text(167 ,24,utf8_decode('COUPON DE REMBOURSEMENT'));
        $pdf->SetFont('Arial','',8);
        $pdf->text(167 ,32,utf8_decode('FACTURE N° '.$data->invoice_no));
        $pdf->text(167 ,37,utf8_decode('Date : '.$data->created_at->format('d/m/y H:i:s')));
        $pdf->text(167 ,42,utf8_decode('Pont bascule : '.$data->weighbridge->label),0,0,'R');


        $pdf->text(167,50,utf8_decode('Reçu de : '),0,0,'L');
        $pdf->text(167,55,utf8_decode($data->customer->label));
        $pdf->text(167,60,utf8_decode('N° Tracteur : '
            .optional($data->myTractor)->label));
        $pdf->text(167,65,utf8_decode('N° Conteneur : '.optional($data->myTrailer)->label));
        $pdf->text(167,70,utf8_decode('Code Transaction : '.$data->who_paid_back));
        $pdf->text(167,78,utf8_decode('Chef de Guerite :'));
        $pdf->text(167,83,utf8_decode($data->user->name));

        $pdf->text(167,98,utf8_decode('Montant HT : '.MoneyHelper::price($data->typeWeighing->price)));
        $pdf->text(167,103,utf8_decode('TVA 19.25% : '.MoneyHelper::price($data->typeWeighing->tax_amount)));
        $pdf->text(167,108,utf8_decode('Montant TTC : '.MoneyHelper::price($data->typeWeighing->total_amount)));
        $pdf->text(167,113,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)));
        $pdf->text(167,118,utf8_decode('A rembourser : '.MoneyHelper::price($data->remains)));
        $pdf->SetFont('Arial','',11);

        //fin coupon

        $pdf->Image(public_path('assets\images\logo\logo-dpws.png'),172,05,30);
        $pdf->Image(public_path( 'storage'.$data->path_qrcode),66,23,20);
        $pdf->Image(public_path( 'storage/'.$data->weighbridge->stamp->path),57,80,40);
        $pdf->Image(public_path('storage/'.optional($data->user->signature)->path),05,92,38);
        $pdf->text(96 ,10,utf8_decode('FACTURE ACQUITTEE N° '.$data->invoice_no));
        $pdf->Ln(10);
        $pdf->text(96 ,15,utf8_decode('Date : '.$data->created_at->format('d/m/y H:i:s')));
        $pdf->text(06 ,20,utf8_decode('www.dpws.cm'));
        $pdf->Ln(10);
        $pdf->text(96 ,20,utf8_decode('Pont bascule : '.$data->weighbridge->label),0,0,'R');

        // ligne a couper le coupon

        $pdf->Line(165, 10, 165, 2);
        $pdf->Line(165, 20, 165, 12);
        $pdf->Line(165, 30, 165, 22);
        $pdf->Line(165, 40, 165, 32);
        $pdf->Line(165, 50, 165, 42);
        $pdf->Line(165, 60, 165, 52);
        $pdf->Line(165, 70, 165, 62);
        $pdf->Line(165, 80, 165, 72);
        $pdf->Line(165, 90, 165, 82);
        $pdf->Line(165, 100, 165, 92);
        $pdf->Line(165, 110, 165, 102);
        $pdf->Line(165, 120, 165, 112);
        $pdf->Line(165, 130, 165, 122);
        $pdf->Line(165, 140, 165, 132);


        $pdf->SetFont('Arial','',10);
        $pdf->Ln(20);
        $pdf->Cell(20,10,utf8_decode('Reçu de : '),0,0,'L');
        $pdf->Cell(60,10,utf8_decode($data->customer->label),0,0,'L');
        $pdf->Ln(10);
        $pdf->Cell(99,10,utf8_decode('Droit de pesage attelage : N° Tracteur : '
            .optional($data->myTractor)->label),0,0,'L');
        $pdf->Cell(85,10,utf8_decode('N° Conteneur : '.optional($data->myTrailer)->label),0,0,'L');
        $pdf->Ln(10);
        // $pdf->Cell(99,10,utf8_decode('Code Transaction : '.$data->who_paid_back),0,0,'L');
        $pdf->Cell(99,10,utf8_decode(''),0,0,'L'); // Cell vide pour créer l'espace à gauche
        $pdf->Cell(85,10,utf8_decode('Code Transaction : '.$data->who_paid_back),0,0,'L');
        $pdf->Ln(10);
        $pdf->Cell(35,10,utf8_decode('Mode de paiement : '),0,0,'L');
        $pdf->Cell(80,10,utf8_decode($data->modePayment->label),0,0,'L');
        $pdf->Ln(10);

        $pdf->Cell(138,10,utf8_decode('Chef de Guerite :'),0,0,'L');

        $pdf->text(41,81,utf8_decode($data->user->name));

        $pdf->text(105,99,utf8_decode('Montant HT : '.MoneyHelper::price($data->typeWeighing->price)),0,0,'L');
        $pdf->text(105,104,utf8_decode('TVA 19.25% : '. MoneyHelper::price($data->typeWeighing->tax_amount)));
        $pdf->text(105,109,utf8_decode('Montant TTC : '.MoneyHelper::price($data->typeWeighing->total_amount)));
        $pdf->text(105,114,utf8_decode('Montant versé : '.MoneyHelper::price($data->amount_paid)));
        $pdf->text(06,90,utf8_decode('Signature et cachet'));

        $pdf->Ln(50);
        $pdf->Line(2,125,205,125);
        $pdf->SetFont('Arial','',7.2);
        $pdf->text(05,130,utf8_decode('Douala Port Weighing Services SAS CAPITAL VARIABLE DE 50 000 000 XAF RCCM RC / DLA / 2019 / b / 5453 NUI M121914355936 L'));
        $pdf->text(05,135,utf8_decode('Siège Social : Bonapriso, Lieu dit Ancien dépôt Guinness - Douala B.P 12209 00237 650 911 000/ 695 502 502 contact@dpws.cm dpws.cm'));
        $pdf->text(05,140,utf8_decode('Compte Afriland First Bank réf : 10005 00002 06463841002 52 swift : cceicmcx iban : cm21 100005 0000206463841002 52'));

        if ($type == "preview")
            return $pdf->Output('','Facture du '.$data->created_at.'.pdf','I');
    }











    public static function storeInvoice(float $subtotal,
                                        float $tax_amount,
                                        float $total_amount,
                                        int $mode_payment_id,
                                        int $bridge_id,
                                        float $amount_paid,
                                        float $remains,
                                        int $user_id,
                                        int $customer_id,
                                        int $price_id,
                                        bool $isRefunded,
                                        $trailer_id = null,
                                        $tractor_id = null,
                                        $who_paid_back = "",
                                        bool $direction= false,
                                        bool $deposit = false ): int
    {


            $data = new Invoice();
            DB::beginTransaction();

        try {


            $weighbridgeId = '';

            if ($direction)
                $weighbridgeId =  Weighbridge::where('label', 'Direction')->first();

            if ($remains == 0)
                $isRefunded = true;


            $lastId = Invoice::latest('id')->first();
            $data = Invoice::create([
                   'invoice_no' => is_null($lastId) ? str_pad(1,7,0,STR_PAD_LEFT) :str_pad($lastId->id + 1,7,0,STR_PAD_LEFT),
                    'subtotal' => $subtotal,
                    'tax_amount' => $tax_amount,
                    'total_amount' => $deposit ? $amount_paid : $total_amount,
                    'mode_payment_id'=> $mode_payment_id,
                    'weighbridge_id'=> $direction == true ? $weighbridgeId->id : $bridge_id,
                    'amount_paid'=> $amount_paid,
                    'remains'=> $remains,
                    'status_invoice' => 'validated',
                    'user_id'=> $user_id,
                    'isRefunded'=> $isRefunded,
                    'tractor_id'=> $tractor_id,
                    'trailer_id' => $trailer_id ,
                    'customer_id' => $customer_id,
                    'type_weighing_id' => $price_id == 0 ? null : $price_id,
                    'path_qrcode' => '',
                    'deposit' => $deposit,
                    'who_paid_back' => $who_paid_back,
                    'slug' => (string) Str::of(Str::uuid())->substr(1,17),
            ]);

            $path = 'http://billingdpws.bfclimited.com:8080/display/'.$data->id;
            $picture = QrCode::format('png')->style('square')->size(120)->generate($path);
            $output_file = '/Qrcode/'.$data->id.'/'. time() . '.png';

            Storage::disk('public')->put($output_file, $picture);
            tap($data)->update(['path_qrcode'=> $output_file]);
            DB::commit();

        }catch (\Illuminate\Database\QueryException $e){
            DB::rollBack();
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'Erreur lors de l\'enregistrement de la facture, veuillez actualiser le navigateur et recommencer.1');
        }
        catch (\Exception $e){
            DB::rollBack();
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'Erreur lors de l\'enregistrement de la facture, veuillez actualiser le navigateur et recommencer.2');
        }
        catch (\Error $e){
            DB::rollBack();
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'Erreur lors de l\'enregistrement de la facture, veuillez actualiser le navigateur et recommencer.3');
        }
        catch (\Throwable $e){
            DB::rollBack();
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'Erreur lors de l\'enregistrement de la facture, veuillez actualiser le navigateur et recommencer.4');
        }

        return $data->id;
    }

    public static function export($datas,$cashMoney,$mobileMoney,$totalAmount,$type){

        $pdf = new InvoiceService('P','mm','A4');
        $pdf->SetMargins(05,02,1); // starting margin
        $pdf->AddPage();
        $pdf->SetFont('Arial','',11);
        $pdf->text(05,23,utf8_decode('Date'),0,0,'L');
        $pdf->text(45,23,utf8_decode('shift'),0,0,'L');
        $pdf->text(85,23,utf8_decode('Nom du chef de guerite'),0,0,'L');
        $pdf->Ln(20);
        $pdf->Cell(80 ,20,utf8_decode('N° Facture'),1,0,'C');
        $pdf->Cell(23 ,20,utf8_decode('Tracteur'),1,0,'C');
        $pdf->Cell(40 ,20,utf8_decode('Mode de paiement'),1,0,'C');
        $pdf->Cell(40 ,20,'Montant TTC',1,1,'C'); /*end of line*/

        /*Heading Of the table end*/
        $pdf->SetFont('Arial','',10);
        foreach ($datas as $data) {
            $pdf->Cell(80 ,6, utf8_decode($data->invoice_no),1,0);
            $pdf->Cell(23 ,6,utf8_decode($data->myTractor->label),1,0,'R');
            $pdf->Cell(40 ,6, utf8_decode($data->modePayment->label),1,0,'R');
            $pdf->Cell(40 ,6, iconv('UTF-8','windows-1252',MoneyHelper::price($data->total_amount)),1,1,'R');
        };

        $pdf->Cell(118	,6,'',0,0);
        $pdf->Cell(25	,6,utf8_decode('Total Espèce'),0,0,'R');
        $pdf->Cell(40	,6,iconv('UTF-8','windows-1252',MoneyHelper::price($cashMoney)),1,1,'R');//end of line

        $pdf->Cell(118	,6,'',0,0);
        $pdf->Cell(25	,6,utf8_decode('Paiement mobile'),0,0,'R');
        $pdf->Cell(40	,6,iconv('UTF-8','windows-1252',MoneyHelper::price($mobileMoney)),1,1,'R');//end of line

        $pdf->Cell(118	,6,'',0,0);
        $pdf->Cell(25	,6,utf8_decode('Sous total'),0,0,'R');
        $pdf->Cell(40	,6,iconv('UTF-8','windows-1252',MoneyHelper::price($totalAmount)),1,1,'R');//end of line

        $pdf->Cell(118	,6,'',0,0);
        $pdf->Cell(25	,6,utf8_decode('Remboursement'),0,0,'R');
        $pdf->Cell(40	,6,iconv('UTF-8','windows-1252',0),1,1,'R');//end of line

        $pdf->Cell(118	,6,'',0,0);
        $pdf->Cell(25	,6,utf8_decode('Montant total'),0,0,'R');
        $pdf->Cell(40	,6,iconv('UTF-8','windows-1252',MoneyHelper::price($totalAmount)),1,1,'R');//end of line


            return $pdf->Output('I', storage_path('exports/export2.pdf'));
    }
}
