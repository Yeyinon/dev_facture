@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">➕ Nouvelle Facture</h2>
    <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

{{-- ALERT SUCCESS --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- FORMULAIRE --}}
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('invoices.store') }}" method="POST" class="row g-3">
            @csrf

            {{-- Choix du devis --}}
            <div class="col-md-6">
                <label for="quote_id" class="form-label">Devis (optionnel)</label>
                <select name="quote_id" id="quote_id" class="form-select">
                    <option value="">-- Choisir un devis --</option>
                    @foreach($quotes as $quote)
                        <option value="{{ $quote->id }}">
                            {{ $quote->num_devis }} - {{ $quote->client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Choix du client --}}
            <div class="col-md-6">
                <label for="client_id" class="form-label">Client</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    <option value="">-- Choisir un client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Date facture --}}
            <div class="col-md-6">
                <label for="issue_date" class="form-label">Date de la facture</label>
                <input type="date" name="issue_date" id="issue_date"
                       class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            {{-- Date échéance --}}
            <div class="col-md-6">
                <label for="due_date" class="form-label">Date d'échéance</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="draft">Brouillon</option>
                    <option value="sent">Envoyée</option>
                    <option value="paid">Payée</option>
                </select>
            </div>

            {{-- Bouton --}}
            <div class="col-12 d-grid mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Créer la facture
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
