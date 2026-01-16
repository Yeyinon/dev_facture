@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📄 Factures</h2>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouvelle facture
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
            @forelse($invoices as $invoice)
                <tr>
                    <td class="fw-semibold">{{ $invoice->num_facture }}</td>

                    <td>{{ $invoice->client->nom }}</td>

                    <td>{{ \Carbon\Carbon::parse($invoice->issue_date)->format('d/m/Y') }}</td>

                    <td class="fw-bold">
                        {{ number_format($invoice->total, 0, ',', ' ') }} FCFA
                    </td>

                    <td>
                        @if($invoice->status === 'paid')
                            <span class="badge bg-success">Payée</span>
                        @elseif($invoice->status === 'sent')
                            <span class="badge bg-warning text-dark">Envoyée</span>
                        @else
                            <span class="badge bg-secondary">Brouillon</span>
                        @endif
                    </td>

                    <td class="text-end">
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('invoices.downloadPdf', $invoice) }}"
                           class="btn btn-sm btn-outline-success">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>

                        <form action="{{ route('invoices.destroy', $invoice) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Supprimer cette facture ?')">
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
                        Aucune facture enregistrée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
