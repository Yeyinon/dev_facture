@extends('layouts.app')

@section('content')

<h2>✏️ Modifier Devis</h2>

<form action="{{ route('quotes.update', $quote) }}" method="POST">
    @csrf
    @method('PUT') <!-- Important pour update -->

    <div>
        <label>Numéro du devis :</label><br>
        <input type="text" name="num_devis" value="{{ old('num_devis', $quote->num_devis) }}" required>
    </div>

    <div>
        <label>Client :</label><br>
        <select name="client_id" required>
            <option value="">-- Choisir un client --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ old('client_id', $quote->client_id) == $client->id ? 'selected' : '' }}>
                    {{ $client->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Date :</label><br>
        <input type="date" name="issue_date" value="{{ old('issue_date', $quote->issue_date) }}" required>
    </div>

    <div>
        <label>Status :</label><br>
        <select name="status">
            <option value="draft" {{ $quote->status == 'draft' ? 'selected' : '' }}>Brouillon</option>
            <option value="sent" {{ $quote->status == 'sent' ? 'selected' : '' }}>Envoyé</option>
            <option value="accepted" {{ $quote->status == 'accepted' ? 'selected' : '' }}>Accepté</option>
            <option value="rejected" {{ $quote->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
        </select>
    </div>

    <br>
    <button type="submit">Mettre à jour le devis</button>
</form>

<hr>
<div>
    <a href="{{ route('quotes.index') }}">🔙 Retour à la liste</a> |
    <a href="{{ route('home') }}">🏠 Dashboard</a>
</div>

@endsection
