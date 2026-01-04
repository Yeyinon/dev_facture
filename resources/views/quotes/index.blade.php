@extends('layouts.app')

@section('content')
<h2>📄 Liste des Devis</h2>
<a href="{{ route('quotes.create') }}">➕ Nouveau Devis</a>
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

@foreach($quotes as $quote)
<tr>
<td>{{ $quote->num_devis }}</td>
<td>{{ $quote->client->nom }}</td>
<td>{{ $quote->issue_date }}</td>
<td>{{ $quote->total }}</td>
<td>{{ $quote->status }}</td>
<td>
    <a href="{{ route('quotes.show', $quote) }}">Voir</a> |
    <a href="{{ route('quotes.edit', $quote) }}">✏️ Editer</a> |
    <form action="{{ route('quotes.destroy', $quote) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Supprimer ce devis ?')">🗑️</button>
    </form>
</td>
</tr>
@endforeach
</table>

<hr>
<a href="{{ route('home') }}">🏠 Dashboard</a>
@endsection
