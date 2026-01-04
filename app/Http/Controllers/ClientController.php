<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', ['clients' => Client::all()]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        Client::create($request->only(['nom', 'email', 'phone', 'entreprise', 'adresse']));
        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    public function edit(Client $client)
{
    return view('clients.edit', compact('client'));
}

public function update(Request $request, Client $client)
{
    $data = $request->validate([
        'nom' => 'required|max:25',
        'email' => 'required|email|max:30',
        'phone' => 'nullable|max:15',
        'entreprise' => 'nullable|max:25',
        'adresse' => 'nullable|max:255',
    ]);

    $client->update($data);

    return redirect()->route('clients.index')
        ->with('success', 'Client mis à jour avec succès !');
}

public function destroy(Client $client)
{
    $client->delete();

    return redirect()->route('clients.index')
        ->with('success', 'Client supprimé avec succès !');
}

}
