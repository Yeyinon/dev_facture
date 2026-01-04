@extends('layouts.app')

@section('content')

<hr>
<div style="margin-top:10px;">
    <a href="{{ route('home') }}">🏠 Dashboard</a> |
    <a href="{{ route('quotes.index') }}">📄 Devis</a> |
    <a href="{{ route('invoices.index') }}">🧾 Factures</a>
</div>


<h3>Liste des clients</h3>

<table border="1" cellpadding="8">
<tr>
    <th>#</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Entreprise</th>
    <th>Actions</th>
</tr>

@foreach($clients as $client)
<tr>
    <td>{{ $client->id }}</td>
    <td>{{ $client->nom }}</td>
    <td>{{ $client->email }}</td>
    <td>{{ $client->phone }}</td>
    <td>{{ $client->entreprise }}</td>
    <td>
    <a href="{{ route('clients.edit', $client) }}">✏️ Editer</a> |
    <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Supprimer ce client ?')">🗑️ Supprimer</button>
    </form>
</td>

</tr>
@endforeach
</table>

@endsection
