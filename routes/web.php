<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;



// Page d'aperçu avec le bouton
Route::get('/fiche-preview', [PdfController::class, 'show'])->name('pdf.show');

// Action de génération et téléchargement
Route::get('/export-pdf-action', [PdfController::class, 'generate'])->name('generate.pdf');

// Cette route affiche simplement la page de connexion
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Cette route recevra les données du formulaire (méthode POST)
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});

