<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;

Route::resource('clients', ClientController::class);
Route::resource('quotes', QuoteController::class);
Route::resource('invoices', InvoiceController::class);

Route::get('/home', function () {
    return view('home');
})->name('home');


/* LIGNES DE DEVIS */
Route::post('/quote-items', [QuoteItemController::class, 'store'])
    ->name('quote-items.store');

Route::delete('/quote-items/{quoteItem}', [QuoteItemController::class, 'destroy'])
    ->name('quote-items.destroy');

/* FACTURE DEPUIS DEVIS */
Route::post('/invoices/from-quote/{quote}', [InvoiceController::class, 'storeFromQuote'])
    ->name('invoices.fromQuote');

/* LIGNES DE FACTURE */
Route::post('/invoice-items', [InvoiceItemController::class, 'store'])
    ->name('invoice-items.store');

Route::delete('/invoice-items/{invoiceItem}', [InvoiceItemController::class, 'destroy'])
    ->name('invoice-items.destroy');

Route::get('/quotes/{quote}/pdf', [QuoteController::class, 'downloadPdf'])->name('quotes.pdf');
Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');

Route::get('/invoices/{invoice}/download-pdf', [InvoiceController::class, 'downloadPdf'])
    ->name('invoices.downloadPdf');


Route::get('/', function () {
    return view('home');
});
