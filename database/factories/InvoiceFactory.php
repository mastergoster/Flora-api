<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paid_amount' => $this->faker->randomFloat(2, 0, 1000),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'user_id' => User::factory(),
            'issued_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'invoice_number' => $this->faker->unique()->numerify('INV#####'),
            'is_editable' => $this->faker->boolean(),
            'stripe_id' => $this->faker->unique()->randomNumber(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Invoice $invoice) {
            InvoiceLine::factory()->count(3)->create(['invoice_id' => $invoice->id]);
        });
    }
}