<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Devis & Factures</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">📊 Facturation</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('clients.index') }}">
                    <i class="bi bi-people"></i> Clients
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('quotes.index') }}">
                    <i class="bi bi-file-earmark-text"></i> Devis
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('invoices.index') }}">
                    <i class="bi bi-receipt"></i> Factures
                </a>
            </li>
        </ul>

        <span class="text-light small">
            Mini ERP Freelance
        </span>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
