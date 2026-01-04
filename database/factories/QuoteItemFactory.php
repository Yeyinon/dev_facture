<?php

namespace Database\Factories;

use App\Models\QuoteItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteItemFactory extends Factory
{
    protected $model = QuoteItem::class;

    public function definition()
    {
        return [
            'devis_id' => null, // on remplira depuis le seeder
            'description' => $this->faker->sentence(),
            'quantite' => $this->faker->numberBetween(1, 5),
            'prix_unite' => $this->faker->numberBetween(50, 500),
            'total' => 0,
        ];
    }
}
