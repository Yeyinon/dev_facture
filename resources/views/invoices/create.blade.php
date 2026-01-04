@extends('layouts.app')

@section('content')

<h2>➕ Nouvelle Facture</h2>

<form action="{{ route('invoices.store') }}" method="POST">
    @csrf

    <div>
        <label>Numéro de facture :</label><br>
        <input type="text" name="num_facture" value="{{ old('num_facture') }}" required>
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
        <label>Date de facturation :</label><br>
        <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required>
    </div>

    <div>
        <label>Date d'échéance :</label><br>
        <input type="date" name="due_date" value="{{ old('due_date') }}">
    </div>

    <div>
        <label>Status :</label><br>
        <select name="status">
            <option value="unpaid">Impayée</option>
            <option value="paid">Payée</option>
            <option value="overdue">En retard</option>
        </select>
    </div>

    <br>
    <button type="submit">Créer la facture</button>
</form>

<hr>
<div>
    <a href="{{ route('invoices.index') }}">🔙 Retour à la liste</a> |
    <a href="{{ route('home') }}">🏠 Dashboard</a>
</div>

@endsection
