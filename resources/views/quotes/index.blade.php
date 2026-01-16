@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📄 Devis</h2>

    <a href="{{ route('quotes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau devis
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($quotes as $quote)
                <tr>
                    <td class="fw-semibold">{{ $quote->num_devis }}</td>

                    <td>{{ $quote->client->nom }}</td>

                    <td>{{ \Carbon\Carbon::parse($quote->issue_date)->format('d/m/Y') }}</td>

                    <td class="fw-bold">
                        {{ number_format($quote->total, 0, ',', ' ') }} FCFA
                    </td>

                    <td>
                        @if($quote->status === 'accepted')
                            <span class="badge bg-success">Accepté</span>
                        @elseif($quote->status === 'sent')
                            <span class="badge bg-warning text-dark">Envoyé</span>
                        @elseif($quote->status === 'rejected')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-secondary">Brouillon</span>
                        @endif
                    </td>

                    <td class="text-end">
                        <a href="{{ route('quotes.show', $quote) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('quotes.downloadPdf', $quote) }}"
                           class="btn btn-sm btn-outline-success">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>

                        <a href="{{ route('quotes.edit', $quote) }}"
                           class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('quotes.destroy', $quote) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Supprimer ce devis ?')">
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
                    <td colspan="6" class="text-center text-muted py-4">
                        Aucun devis enregistré
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
