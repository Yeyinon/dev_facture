@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">✏️ Modifier Devis</h2>
    <a href="{{ route('quotes.index') }}" class="btn btn-outline-secondary">
        🔙 Retour à la liste
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('quotes.update', $quote) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Numéro du devis</label>
                    <input type="text" name="num_devis" class="form-control"
                           value="{{ old('num_devis', $quote->num_devis) }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Client</label>
                    <select name="client_id" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $quote->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date" name="issue_date" class="form-control"
                           value="{{ old('issue_date', $quote->issue_date) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="draft" {{ $quote->status == 'draft' ? 'selected' : '' }}>Brouillon</option>
                    <option value="sent" {{ $quote->status == 'sent' ? 'selected' : '' }}>Envoyé</option>
                    <option value="accepted" {{ $quote->status == 'accepted' ? 'selected' : '' }}>Accepté</option>
                    <option value="rejected" {{ $quote->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">🏠 Dashboard</a>
            </div>

        </form>

    </div>
</div>

@endsection
