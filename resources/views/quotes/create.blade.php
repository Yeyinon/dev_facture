@extends('layouts.app')

@section('content')

<h2 class="mb-4">📄 Nouveau devis</h2>

<form method="POST" action="{{ route('quotes.store') }}">
    @csrf

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Numéro</label>
            <input type="text" name="num_devis" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-select" required>
                <option value="">-- Choisir --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Date</label>
            <input type="date" name="issue_date" class="form-control"
                   value="{{ date('Y-m-d') }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Statut</label>
        <select name="status" class="form-select">
            <option value="draft">Brouillon</option>
            <option value="sent">Envoyé</option>
            <option value="accepted">Accepté</option>
            <option value="rejected">Rejeté</option>
        </select>
    </div>

    <button class="btn btn-success">Créer le devis</button>
    <a href="{{ route('quotes.index') }}" class="btn btn-secondary">Annuler</a>

</form>

@endsection
