@extends('layouts.app')

@section('content')

<hr>
<div style="margin-top:10px;">
    <a href="{{ route('home') }}">🏠 Dashboard</a> |
    <a href="{{ route('quotes.index') }}">📄 Devis</a> |
    <a href="{{ route('invoices.index') }}">🧾 Factures</a>
</div>

<h2>✏️ Modifier Client</h2>

<form action="{{ route('clients.update', $client) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" required>
    </div>

    <div>
        <label>Email :</label><br>
        <input type="email" name="email" value="{{ old('email', $client->email) }}" required>
    </div>

    <div>
        <label>Téléphone :</label><br>
        <input type="text" name="phone" value="{{ old('phone', $client->phone) }}">
    </div>

    <div>
        <label>Entreprise :</label><br>
        <input type="text" name="entreprise" value="{{ old('entreprise', $client->entreprise) }}">
    </div>

    <div>
        <label>Adresse :</label><br>
        <input type="text" name="adresse" value="{{ old('adresse', $client->adresse) }}">
    </div>

    <br>
    <button type="submit">Mettre à jour</button>
</form>

@endsection
