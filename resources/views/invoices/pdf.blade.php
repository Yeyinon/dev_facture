<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $invoice->num_facture }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            margin-bottom: 30px;
        }
        .company {
            font-size: 14px;
            font-weight: bold;
        }
        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            text-align: right;
        }
        .meta {
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #f5f5f5;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            margin-top: 20px;
            width: 40%;
            float: right;
        }
        .totals td {
            border: none;
            padding: 5px;
        }
        .total-final {
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            font-size: 11px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <div style="float:left;">
        <div class="company">Shadow's Coding</div>
        <div>Galerie LAFAYETTE Rue 514</div>
        <div>(+1)00065421365</div>
    </div>

    <div style="float:right;">
        <div class="invoice-title">FACTURE</div>
        <div class="meta">N° {{ $invoice->num_facture }}</div>
        <div class="meta">Date : {{ $invoice->issue_date }}</div>
        <div class="meta">Échéance : {{ $invoice->due_date }}</div>
    </div>

    <div style="clear:both;"></div>
</div>

<hr>

<div>
    <strong>Facturé à :</strong><br>
    {{ $invoice->client->nom }}<br>
    {{ $invoice->client->entreprise ?? '' }}<br>
    {{ $invoice->client->email }}<br>
    {{ $invoice->client->phone }}
</div>

<table>
    <thead>
        <tr>
            <th>Description</th>
            <th width="80">Qté</th>
            <th width="120">Prix</th>
            <th width="120">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoice->items as $item)
        <tr>
            <td>{{ $item->description }}</td>
            <td>{{ $item->quantite }}</td>
            <td class="text-right">{{ number_format($item->prix_unite, 0, ',', ' ') }} FCFA</td>
            <td class="text-right">{{ number_format($item->total, 0, ',', ' ') }} FCFA</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <td>Sous-total :</td>
        <td class="text-right">{{ number_format($invoice->subtotal, 0, ',', ' ') }} FCFA</td>
    </tr>
    <tr>
        <td>TVA (20%) :</td>
        <td class="text-right">{{ number_format($invoice->tax, 0, ',', ' ') }} FCFA</td>
    </tr>
    <tr>
        <td class="total-final">TOTAL :</td>
        <td class="text-right total-final">
            {{ number_format($invoice->total, 0, ',', ' ') }} FCFA
        </td>
    </tr>
</table>

<div style="clear:both;"></div>

<div class="footer">
    Merci pour votre confiance.
</div>

</body>
</html>
