<?php

namespace Database\Factories;

use App\Models\BookingSlot;
use App\Models\User;
use App\Models\ReservableItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingSlotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingSlot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_at' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'user_id' => User::factory(),
            'reservable_item_id' => ReservableItem::factory(),
        ];
    }
}