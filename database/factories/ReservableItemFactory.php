<?php

namespace Database\Factories;

use App\Models\ReservableItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservableItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReservableItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'type' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image_path' => $this->faker->numberBetween(1, 100),
            'configuration' => $this->faker->randomElements(['option1', 'option2', 'option3']),
        ];
    }
}