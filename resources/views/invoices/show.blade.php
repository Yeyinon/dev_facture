@extends('layouts.app')

@section('content')

<h2>📄 Facture : {{ $invoice->num_facture }}</h2>
<p>Client : {{ $invoice->client->nom }}</p>
<p>Date : {{ $invoice->issue_date }}</p>
<p>Échéance : {{ $invoice->due_date }}</p>
<p>Status : {{ $invoice->status }}</p>

<!-- BOUTON PDF -->
<p>
    <a href="{{ route('invoices.downloadPdf', $invoice) }}" target="_blank">📄 Télécharger PDF</a>
</p>

<h3>Lignes :</h3>
<table border="1" cellpadding="5">
<tr>
<th>Description</th>
<th>Quantité</th>
<th>Prix Unité</th>
<th>Total</th>
<th>Actions</th>
</tr>
@foreach($invoice->items as $item)
<tr>
<td>{{ $item->description }}</td>
<td>{{ $item->quantite }}</td>
<td>{{ $item->prix_unite }}</td>
<td>{{ $item->total }}</td>
<td>
    <form action="{{ route('invoice-items.destroy', $item) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Supprimer cette ligne ?')">🗑️</button>
    </form>
</td>
</tr>
@endforeach
</table>

<h3>➕ Ajouter une ligne</h3>
<form action="{{ route('invoice-items.store') }}" method="POST">
    @csrf
    <input type="hidden" name="facture_id" value="{{ $invoice->id }}">

    <div>
        <label>Description :</label><br>
        <input type="text" name="description" required>
    </div>

    <div>
        <label>Quantité :</label><br>
        <input type="number" name="quantite" value="1" min="1" required>
    </div>

    <div>
        <label>Prix Unité :</label><br>
        <input type="number" name="prix_unite" value="0" step="0.01" required>
    </div>

    <button type="submit">Ajouter la ligne</button>
</form>

<hr>
<a href="{{ route('invoices.index') }}">🔙 Retour à la liste</a> |
<a href="{{ route('home') }}">🏠 Dashboard</a>

@endsection
