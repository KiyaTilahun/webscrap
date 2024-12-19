<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Milon\Barcode\DNS2D;
use Milon\Barcode\PDF417;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {

    $data=1234;
   
    $data = [
        'jbhjkb786y',
        'kfjgk2hf3j',
        '3fjn4g56k',
        'dkhgd8fjg9',
        '9r8gq8f7j',
        'fgkj45g7g',
        '8fjh3f7d2',
        'jhgfj76hj',
        'dhgf8g5h6',
        'g3r7h2kjh',
    ];
    // return view('pdfview');
    // dd($data);
    $pdf = PDF::loadView('pdfview', ['data' => $data],[
        'format' => 'A5-S'
      ]);
      $pdf->SetProtection(['copy'], '', 'pass');
    // $pdf = PDF::loadView('pdfview', ['data' => $data],[
    //     'format' => 'A4'
    //   ]);
    // dd($pdf);
    return $pdf->stream('document.pdf');
   
});
require __DIR__.'/auth.php';
