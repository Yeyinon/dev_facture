@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">➕ Nouvelle Facture</h2>
    <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

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
                        <option value="{{ $quote->id }}" data-client="{{ $quote->client_id }}">
                            {{ $quote->num_devis }} - {{ $quote->client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Client --}}
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
                <input type="date" name="due_date" id="due_date" class="form-control" required>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="draft">Brouillon</option>
                    <option value="sent">Envoyée</option>
                    <option value="paid">Payée</option>
                </select>
            </div>

            <div class="col-12 d-grid mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Créer la facture
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script pour remplir automatiquement le client selon le devis --}}
<script>
    const quoteSelect = document.getElementById('quote_id');
    const clientSelect = document.getElementById('client_id');

    quoteSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const clientId = selectedOption.dataset.client;

        if(clientId) {
            clientSelect.value = clientId; // Remplir le client automatiquement
        } else {
            clientSelect.value = ''; // Réinitialiser si aucun devis
        }
    });
</script>

@endsection
