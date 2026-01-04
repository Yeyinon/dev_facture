<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Quote;
use App\Models\QuoteItem;

class DevisTestSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer un client
        $client = Client::factory()->create();

        // 2. Créer un devis lié au client
        $devis = Quote::factory()->create([
            'client_id' => $client->id
        ]);

        // 3. Créer deux lignes de devis
        QuoteItem::factory()->create([
            'devis_id' => $devis->id,
            'description' => 'Premier service',
            'quantite' => 1,
            'prix_unite' => 100,
            'total' => 100,
        ]);

        QuoteItem::factory()->create([
            'devis_id' => $devis->id,
            'description' => 'Deuxième service',
            'quantite' => 2,
            'prix_unite' => 50,
            'total' => 100,
        ]);

        // 4. Mise à jour des totaux
        $devis->update([
            'subtotal' => 200,
            'tax' => 40,
            'total' => 240,
        ]);
    }
}
