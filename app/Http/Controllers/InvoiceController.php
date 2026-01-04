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
        $clients = Client::all();
        return view('invoices.create', compact('clients'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'num_facture' => 'required|max:25',
        'client_id'   => 'required|exists:clients,id',
        'issue_date'  => 'required|date',
        'due_date'    => 'nullable|date',
        'status'      => 'required|in:unpaid,paid,overdue',
    ]);

    $invoice = Invoice::create($data);

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
        $invoice->load('client', 'items', 'quote');
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download($invoice->num_facture . '.pdf');
    }
}
