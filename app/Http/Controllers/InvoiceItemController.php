<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'description'=> 'required|string|max:255',
            'quantite'   => 'required|integer|min:1',
            'prix_unite' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::findOrFail($request->facture_id);

        $invoice->items()->create([
            'description' => $request->description,
            'quantite' => $request->quantite,
            'prix_unite' => $request->prix_unite,
            'total' => $request->quantite * $request->prix_unite,
        ]);

        $this->recalculateTotals($invoice);

        return back();
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoice = $invoiceItem->invoice;

        $invoiceItem->delete();
        $this->recalculateTotals($invoice);

        return back();
    }

    private function recalculateTotals(Invoice $invoice)
    {
        $subtotal = $invoice->items()->sum('total');
        $tax = $subtotal * 0.20; // TVA 20%
        $total = $subtotal + $tax;

        $invoice->update([
            'subtotal' => $subtotal,
            'tax'      => $tax,
            'total'    => $total,
        ]);
    }
}
