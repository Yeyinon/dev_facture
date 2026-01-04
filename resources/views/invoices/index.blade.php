@extends('layouts.app')

@section('content')
<h2>📄 Liste des Factures</h2>
<a href="{{ route('invoices.create') }}">➕ Nouvelle Facture</a>
<hr>

<table border="1" cellpadding="8">
<tr>
<th>#</th>
<th>Client</th>
<th>Date</th>
<th>Total</th>
<th>Status</th>
<th>Actions</th>
</tr>

@foreach($invoices as $invoice)
<tr>
<td>{{ $invoice->num_facture }}</td>
<td>{{ $invoice->client->nom }}</td>
<td>{{ $invoice->issue_date }}</td>
<td>{{ $invoice->total }}</td>
<td>{{ $invoice->status }}</td>
<td>
    <a href="{{ route('invoices.show', $invoice) }}">Voir</a> |
    <a href="{{ route('invoices.downloadPdf', $invoice) }}" target="_blank">📄 PDF</a> |
    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Supprimer cette facture ?')">🗑️</button>
    </form>
</td>

</tr>
@endforeach
</table>

<hr>
<a href="{{ route('home') }}">🏠 Dashboard</a>
@endsection
