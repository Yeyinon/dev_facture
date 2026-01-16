<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Client;
use App\Models\Quote;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->get();
        return view('invoices.index', compact('invoices'));
    }

   public function create()
{
    // Récupérer tous les devis existants
    $quotes = Quote::all();

    // Récupérer tous les clients
    $clients = Client::all();

    // Envoyer les deux variables à la vue
    return view('invoices.create', compact('quotes', 'clients'));
}


    public function store(Request $request)
{
    $data = $request->validate([
        'quote_id'   => 'nullable|exists:devis,id',
        'client_id'  => 'required|exists:clients,id',
        'issue_date' => 'required|date',
        'due_date'   => 'nullable|date',
        'status'     => 'required|in:draft,sent,paid',
    ]);

    $invoice = Invoice::create([
        'quote_id'   => $data['quote_id'] ?? null,
        'client_id'  => $data['client_id'],
        'issue_date' => $data['issue_date'],
        'due_date'   => $data['due_date'] ?? null,
        'subtotal'   => 0,
        'tax'        => 0,
        'total'      => 0,
        'status'     => $data['status'],
    ]);

    return redirect()->route('invoices.show', $invoice)
                     ->with('success', 'Facture créée avec succès !');
}



    /**
     * Créer une facture depuis un devis accepté
     */
    public function storeFromQuote(Quote $quote)
    {
        if ($quote->status != 'accepted') {
            return back()->with('error', 'Seuls les devis acceptés peuvent générer une facture.');
        }

        $invoice = Invoice::create([
            'client_id' => $quote->client_id,
            'devis_id' => $quote->id,
            'num_facture' => 'FAC-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT),
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(30)->toDateString(),
            'subtotal' => $quote->subtotal,
            'tax' => $quote->tax,
            'total' => $quote->total,
            'status' => 'unpaid',
        ]);

        foreach ($quote->items as $item) {
            $invoice->items()->create([
                'description' => $item->description,
                'quantite' => $item->quantite,
                'prix_unite' => $item->prix_unite,
                'total' => $item->total,
            ]);
        }

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Facture générée depuis le devis !');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('client', 'items', 'quote');
        return view('invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Facture supprimée !');
    }

    public function downloadPdf(Invoice $invoice)
{
    $invoice->load('client', 'items');

    $pdf = PDF::loadView('invoices.pdf', compact('invoice'))
              ->setPaper('a4');

    return $pdf->download('facture_' . $invoice->num_facture . '.pdf');
}
}
