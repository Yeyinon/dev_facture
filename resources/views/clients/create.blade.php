@extends('layouts.app')

@section('content')
<h2>➕ Nouveau client</h2>

<form method="POST" action="{{ route('clients.store') }}">
    @csrf
    @include('clients.form')
    <button class="btn btn-primary">Créer</button>
</form>
@endsection
