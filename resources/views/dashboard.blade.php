@extends('layouts.app')

@section('content')

<h1 class="mb-4">📊 Dashboard</h1>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h5 class="mt-2">Clients</h5>
                <h2>{{ \App\Models\Client::count() }}</h2>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-outline-primary w-100">Voir</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-file-earmark-text fs-1 text-success"></i>
                <h5 class="mt-2">Devis</h5>
                <h2>{{ \App\Models\Quote::count() }}</h2>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('quotes.index') }}" class="btn btn-sm btn-outline-success w-100">Voir</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-receipt fs-1 text-warning"></i>
                <h5 class="mt-2">Factures</h5>
                <h2>{{ \App\Models\Invoice::count() }}</h2>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-outline-warning w-100">Voir</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-cash-coin fs-1 text-danger"></i>
                <h5 class="mt-2">Chiffre d’affaires</h5>
                <h4>{{ number_format(\App\Models\Invoice::sum('total'), 0, ',', ' ') }} FCFA</h4>
            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        🧾 Dernières factures
    </div>

    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Invoice::orderBy('issue_date', 'desc')->take(5)->get() as $invoice)
                <tr>
                    <td>{{ $invoice->num_facture }}</td>
                    <td>{{ $invoice->client->nom }}</td>
                    <td>{{ $invoice->issue_date }}</td>
                    <td>{{ number_format($invoice->total, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                        <a href="{{ route('invoices.downloadPdf', $invoice) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
