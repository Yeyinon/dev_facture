<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition()
    {
        return [
            'client_id' => null, // on remplira depuis le seeder
            'num_devis' => 'DEV-' . $this->faker->unique()->numberBetween(100, 999),
            'issue_date' => $this->faker->date(),
            'valid_until' => $this->faker->date(),
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
            'status' => 'draft',
        ];
    }
}
