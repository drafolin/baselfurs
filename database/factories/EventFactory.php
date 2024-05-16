<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Le nom du modèle correspondant.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $end_date = fake()->dateTimeThisMonth(date('Y-m-t'));
        return [
            'name' => fake()->words(3, true),
            'identifier' => fake()->unique()->uuid(),
            'start_date' => fake()->dateTimeThisMonth($end_date),
            'end_date' => $end_date,
            'featured' => fake()->boolean()
        ];
    }
}
