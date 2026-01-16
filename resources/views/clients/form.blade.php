<div class="mb-3">
    <label class="form-label">Nom</label>
    <input type="text" name="nom" class="form-control"
           value="{{ old('nom', $client->nom ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control"
           value="{{ old('email', $client->email ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Téléphone</label>
    <input type="text" name="phone" class="form-control"
           value="{{ old('phone', $client->phone ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Entreprise</label>
    <input type="text" name="entreprise" class="form-control"
           value="{{ old('entreprise', $client->entreprise ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Adresse</label>
    <input type="text" name="adresse" class="form-control"
           value="{{ old('adresse', $client->adresse ?? '') }}">
</div>
