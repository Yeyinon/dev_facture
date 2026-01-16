@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Facture {{ $invoice->num_facture }}</h2>
        <span class="text-muted">Client : {{ $invoice->client->nom }}</span>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('invoices.downloadPdf', $invoice) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf"></i> Télécharger PDF
        </a>

        <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
            Retour
        </a>
    </div>
</div>

{{-- INFOS FACTURE --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Date :</strong> {{ $invoice->issue_date }}</p>
                <p><strong>Échéance :</strong> {{ $invoice->due_date }}</p>
                <p>
                    <strong>Status :</strong>
                    @if($invoice->status === 'paid')
                        <span class="badge bg-success">Payée</span>
                    @elseif($invoice->status === 'sent')
                        <span class="badge bg-warning text-dark">Envoyée</span>
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

        <h5 class="fw-bold mb-3">Lignes de facturation</h5>

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
            @forelse($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ number_format($item->prix_unite, 0, ',', ' ') }} FCFA</td>
                    <td class="fw-bold">{{ number_format($item->total, 0, ',', ' ') }} FCFA</td>
                    <td class="text-center">
                        <form action="{{ route('invoice-items.destroy', $item) }}"
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

        <form action="{{ route('invoice-items.store') }}" method="POST" class="row g-3">
            @csrf
            <input type="hidden" name="facture_id" value="{{ $invoice->id }}">

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
                <p>Sous-total : <strong>{{ number_format($invoice->subtotal, 0, ',', ' ') }} FCFA</strong></p>
                <p>TVA (20%) : <strong>{{ number_format($invoice->tax, 0, ',', ' ') }} FCFA</strong></p>
                <hr>
                <h4>Total : {{ number_format($invoice->total, 0, ',', ' ') }} FCFA</h4>
            </div>
        </div>
    </div>
</div>

@endsection
