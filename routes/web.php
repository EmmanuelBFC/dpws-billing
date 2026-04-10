<?php



use App\Models\Weighbridge;
use App\Models\EmailAttachment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaybackController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\PowerWeightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//route pour afficher la facture sans coupon et la télécherger depuis l'exterieur
Route::get('display/{id?}',[InvoiceController::class,'pdf'])->name('show-pdf');

// route pour afficher la facture avec coupon de remboursement
Route::get('coupon/{id?}',[InvoiceController::class,'pdfWithCoupon'])->name('show-coupon');


Route::get('export',[InvoiceController::class,'exportCG'])->name('export-cg');


Route::middleware(['auth'])->group(function(){

    Route::get('home',[HomeController::class, 'index'])->name('home');

    Route::get('which-bridge', function (){
        $weighbridges = Weighbridge::all()->reject(function($bridge){

            return $bridge->label == "Direction";
        });

        return view('which-bridge', compact('weighbridges'));
    })->name('bridge');
    Route::get('report',[HomeController::class, 'report'])->name('report');
    Route::get('billing',[InvoiceController::class,'index']);

    // reporting
    Route::get('report-index',[AppController::class,'indexReport'])->name('reporting.index');
    Route::get('report-create',[HomeController::class,'reporting'])->name('reporting.create');
    Route::get('report-details/{id}',[AppController::class,'detailReport'])->name('reporting.show');

    // Téléchargement pièces jointes rapport
    Route::get('/download/{id}', function ($id) {
      $attachment = EmailAttachment::where('id',$id)->first();
      $headers = ['Content-Type: '.$attachment->mime_type];
    // dd($headers);
     // return Storage::download($url, $attachment->name,$headers);
    })->name('download');
    
    Route::get('invoices',[InvoiceController::class, 'myInvoice'])->name('invoices');
    Route::get('all-invoices',[InvoiceController::class, 'allInvoice'])->name('allInvoice');
    Route::get('refund',[InvoiceController::class, 'refund'])->name('refund');
    Route::get('export',[InvoiceController::class, 'export'])->name('export');
    Route::get('bill-pending',[AccountingController::class,'billPending'])->name('bill-pending');
    Route::get('bill/edit/{id}',[AccountingController::class,'edit'])->name('accounting.edit');
    Route::patch('bill/edit/{id}',[AccountingController::class,'update'])->name('accounting.update');
  //  Route::get('index',[\App\Http\Controllers\ManagingUserController::class, 'index'])->name('account.index');
    Route::get('customer-support', [\App\Http\Controllers\CustomerSupportController::class, 'create'])->name('customer-support');

    //route add stamp
    Route::resource('stamp',StampController::class);
    //route add signature
    Route::resource('signature',SignatureController::class);

    Route::resource('account',UserController::class);
    Route::get('payback/index',[PaybackController::class,'index'] )->name('payback.index');
    Route::get('payback/edit/{id}',[PaybackController::class,'edit'] )->name('payback.edit');
    Route::patch('payback/update/{invoice}',[PaybackController::class,'update'] )->name('payback.update');
    Route::patch('reset/{id}',[UserController::class,'resetPassword'])->name('reset.password');
    //journal d'erreur
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('log');

    Route::get('/checkpoint/index', [CheckpointController::class, 'index'])->name('checkpoint.index');
    Route::get('/checkpoint/edit/{invoice}', [CheckpointController::class, 'edit'])->name('checkpoint.detail');
    Route::get('/checkpoint/updateEntry/{invoice}', [CheckpointController::class, 'updateEntry'])->name('checkpoint.updateEntry');
    Route::get('/checkpoint/updateExit/{invoice}', [CheckpointController::class, 'updateExit'])->name('checkpoint.updateExit');
    Route::get('/prediction', [AppController::class, 'prediction'])->name('prediction.create');
    Route::get('/search/container', [HomeController::class, 'searchContainer'])->name('search.container');

    Route::get('/details/container/{prediction}/{param?}', [AppController::class, 'edit'])->name('container.detail');

    Route::get('/weighing-in/{prediction}/{param?}', [AppController::class, 'entry'])
           ->name('apure.entry');

    Route::get('/wieghing-out/{prediction}/{param?}', [AppController::class, 'exit'])
           ->name('apure.exit');
    Route::get('/all-predictiond',[AppController::class,'index'])->name('prediction.index');

    Route::get('/prediction/edit/{prediction}',[PredictionController::class,'edit'])->name('prediction.edit');
    Route::patch('/prediction/update/{prediction}',[PredictionController::class,'update'])->name('prediction.update');

});
Route::get('/db',[PowerWeightController::class,'index']);

