@extends('layouts.app')

@section('content')

<h2>➕ Nouveau Devis</h2>

<form action="{{ route('quotes.store') }}" method="POST">
    @csrf

    <div>
        <label>Numéro du devis :</label><br>
        <input type="text" name="num_devis" value="{{ old('num_devis') }}" required>
    </div>

    <div>
        <label>Client :</label><br>
        <select name="client_id" required>
            <option value="">-- Choisir un client --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Date :</label><br>
        <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required>
    </div>

    <div>
        <label>Status :</label><br>
        <select name="status">
            <option value="draft">Brouillon</option>
            <option value="sent">Envoyé</option>
            <option value="accepted">Accepté</option>
            <option value="rejected">Rejeté</option>
        </select>
    </div>

    <br>
    <button type="submit">Créer le devis</button>
</form>

<hr>
<div>
    <a href="{{ route('quotes.index') }}">🔙 Retour à la liste</a> |
    <a href="{{ route('home') }}">🏠 Dashboard</a>
</div>

@endsection
