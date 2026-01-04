@extends('layouts.app')

@section('content')

<hr>
<div style="margin-top:10px;">
    <a href="{{ route('home') }}">🏠 Dashboard</a> |
    <a href="{{ route('quotes.index') }}">📄 Devis</a> |
    <a href="{{ route('invoices.index') }}">🧾 Factures</a>
</div>


<h2>➕ Nouveau Client</h2>

<form action="{{ route('clients.store') }}" method="POST">
    @csrf

    <div>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="{{ old('nom') }}" required>
    </div>

    <div>
        <label>Email :</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label>Téléphone :</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}">
    </div>

    <div>
        <label>Entreprise :</label><br>
        <input type="text" name="entreprise" value="{{ old('entreprise') }}">
    </div>

    <div>
        <label>Adresse :</label><br>
        <input type="text" name="adresse" value="{{ old('adresse') }}">
    </div>

    <br>
    <button type="submit">Créer le client</button>
</form>

@endsection
