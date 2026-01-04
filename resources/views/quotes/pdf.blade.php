<h2>Devis : {{ $quote->num_devis }}</h2>
<p>Client : {{ $quote->client->nom }}</p>
<p>Date : {{ $quote->issue_date }}</p>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
<th>Description</th><th>Qté</th><th>Prix</th><th>Total</th>
</tr>
@foreach($quote->items as $item)
<tr>
<td>{{ $item->description }}</td>
<td>{{ $item->quantite }}</td>
<td>{{ $item->prix_unite }}</td>
<td>{{ $item->total }}</td>
</tr>
@endforeach
<tr>
<td colspan="3">Total</td>
<td>{{ $quote->total }}</td>
</tr>
</table>
