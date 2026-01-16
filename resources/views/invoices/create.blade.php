@extends('layouts.app')

@section('content')

<h2>➕ Nouvelle facture</h2>

<form action="{{ route('invoices.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Client</label>
        <select name="client_id" class="form-select" required>
            <option value="">-- Choisir un client --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Basée sur un devis (optionnel)</label>
        <select name="devis_id" class="form-select">
            <option value="">-- Aucun --</option>
            @foreach($quotes as $quote)
                <option value="{{ $quote->id }}">{{ $quote->num_devis }} - {{ $quote->client->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Date</label>
            <input type="date" name="issue_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Échéance</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Statut</label>
        <select name="status" class="form-select">
            <option value="unpaid">Non payée</option>
            <option value="paid">Payée</option>
            <option value="overdue">En retard</option>
        </select>
    </div>

    <button class="btn btn-success">Créer la facture</button>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Annuler</a>
</form>

@endsection
