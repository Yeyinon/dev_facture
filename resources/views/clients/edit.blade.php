@extends('layouts.app')

@section('content')
<h2>✏️ Modifier client</h2>

<form method="POST" action="{{ route('clients.update', $client) }}">
    @csrf @method('PUT')
    @include('clients.form')
    <button class="btn btn-warning">Mettre à jour</button>
</form>
@endsection
