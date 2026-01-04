<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Client;
use Illuminate\Http\Request;
use PDF;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with('client')->get();
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('quotes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'num_devis' => 'required|max:25',
            'client_id' => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        Quote::create($data);

        return redirect()->route('quotes.index')->with('success', 'Devis créé avec succès !');
    }

    public function edit(Quote $quote)
    {
        $clients = Client::all();
        return view('quotes.edit', compact('quote','clients'));
    }

    public function update(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'num_devis' => 'required|max:25',
            'client_id' => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        $quote->update($data);

        return redirect()->route('quotes.index')->with('success', 'Devis mis à jour !');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('quotes.index')->with('success', 'Devis supprimé !');
    }

    public function show(Quote $quote)
    {
        $quote->load('client', 'items');
        return view('quotes.show', compact('quote'));
    }

    public function downloadPdf(Quote $quote)
    {
        $quote->load('client', 'items');
        $pdf = PDF::loadView('quotes.pdf', compact('quote'));
        return $pdf->download($quote->num_devis . '.pdf');
    }
}
