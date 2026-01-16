@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Devis {{ $quote->num_devis }}</h2>
        <span class="text-muted">Client : {{ $quote->client->nom }}</span>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('quotes.downloadPdf', $quote) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf"></i> Télécharger PDF
        </a>

        <a href="{{ route('quotes.index') }}" class="btn btn-outline-secondary">
            Retour
        </a>
    </div>
</div>

{{-- INFOS DEVIS --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Date :</strong> {{ $quote->issue_date }}</p>
                <p>
                    <strong>Status :</strong>
                    @if($quote->status === 'accepted')
                        <span class="badge bg-success">Accepté</span>
                    @elseif($quote->status === 'sent')
                        <span class="badge bg-warning text-dark">Envoyé</span>
                    @elseif($quote->status === 'rejected')
                        <span class="badge bg-danger">Rejeté</span>
                    @else
                        <span class="badge bg-secondary">Brouillon</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

{{-- TABLE LIGNES --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">

        <h5 class="fw-bold mb-3">Lignes du devis</h5>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Description</th>
                    <th width="120">Qté</th>
                    <th width="150">Prix Unité</th>
                    <th width="150">Total</th>
                    <th width="80"></th>
                </tr>
            </thead>

            <tbody>
            @forelse($quote->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ number_format($item->prix_unite, 0, ',', ' ') }} FCFA</td>
                    <td class="fw-bold">{{ number_format($item->total, 0, ',', ' ') }} FCFA</td>
                    <td class="text-center">
                        <form action="{{ route('quote-items.destroy', $item) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer cette ligne ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Aucune ligne ajoutée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

{{-- AJOUT LIGNE --}}
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-3">➕ Ajouter une ligne</h5>

        <form action="{{ route('quote-items.store') }}" method="POST" class="row g-3">
            @csrf
            <input type="hidden" name="devis_id" value="{{ $quote->id }}">

            <div class="col-md-5">
                <input type="text" name="description" class="form-control" placeholder="Description" required>
            </div>

            <div class="col-md-2">
                <input type="number" name="quantite" class="form-control" value="1" min="1" required>
            </div>

            <div class="col-md-3">
                <input type="number" name="prix_unite" class="form-control" step="0.01" required>
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

{{-- TOTAUX --}}
<div class="row justify-content-end mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <p>Sous-total : <strong>{{ number_format($quote->subtotal, 0, ',', ' ') }} FCFA</strong></p>
                <p>TVA (20%) : <strong>{{ number_format($quote->tax, 0, ',', ' ') }} FCFA</strong></p>
                <hr>
                <h4>Total : {{ number_format($quote->total, 0, ',', ' ') }} FCFA</h4>
            </div>
        </div>
    </div>
</div>

@endsection
