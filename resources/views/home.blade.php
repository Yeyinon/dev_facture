@extends('layouts.app')

@section('content')

<h2>🏠 Tableau de bord Mini Facturation</h2>
<p>Bienvenue ! Choisissez une section :</p>

<div style="display:flex; gap:20px; margin-top:20px;">

    <!-- Clients -->
    <div style="border:1px solid #333; padding:20px; width:200px; text-align:center;">
        <h3>Clients</h3>
        <a href="{{ route('clients.index') }}" style="display:block; margin:10px 0;">Voir la liste</a>
        <a href="{{ route('clients.create') }}" style="display:block; margin:10px 0;">➕ Nouveau client</a>
    </div>

    <!-- Devis -->
    <div style="border:1px solid #333; padding:20px; width:200px; text-align:center;">
        <h3>Devis</h3>
        <a href="{{ route('quotes.index') }}" style="display:block; margin:10px 0;">Voir la liste</a>
        <a href="{{ route('quotes.create') }}" style="display:block; margin:10px 0;">➕ Nouveau devis</a>
    </div>

    <!-- Factures -->
    <div style="border:1px solid #333; padding:20px; width:200px; text-align:center;">
        <h3>Factures</h3>
        <a href="{{ route('invoices.index') }}" style="display:block; margin:10px 0;">Voir la liste</a>
    </div>

</div>

@endsection
