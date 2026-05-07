<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;



// Page d'aperçu avec le bouton
Route::get('/fiche-preview', [PdfController::class, 'show'])->name('pdf.show');

// Action de génération et téléchargement
Route::get('/export-pdf-action', [PdfController::class, 'generate'])->name('generate.pdf');

Route::get('/', function () {
    return view('welcome');
});

