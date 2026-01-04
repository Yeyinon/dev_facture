<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Http\Request;

class QuoteItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'devis_id'   => 'required|exists:devis,id',
            'description'=> 'required|string|max:255',
            'quantite'   => 'required|integer|min:1',
            'prix_unite' => 'required|numeric|min:0',
        ]);

        $quote = Quote::findOrFail($request->devis_id);

        $quote->items()->create([
            'description' => $request->description,
            'quantite' => $request->quantite,
            'prix_unite' => $request->prix_unite,
            'total' => $request->quantite * $request->prix_unite,
        ]);

        $this->recalculateTotals($quote);

        return back();
    }

    public function destroy(QuoteItem $quoteItem)
    {
        $quote = $quoteItem->quote;

        $quoteItem->delete();
        $this->recalculateTotals($quote);

        return back();
    }

    private function recalculateTotals(Quote $quote)
    {
        $subtotal = $quote->items()->sum('total');
        $tax = $subtotal * 0.20; // TVA 20%
        $total = $subtotal + $tax;

        $quote->update([
            'subtotal' => $subtotal,
            'tax'      => $tax,
            'total'    => $total,
        ]);
    }
}
