<?php

namespace Database\Factories;

use App\Enums\RegistrationLocation;
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
            'featured' => fake()->boolean(),
            'description' => fake()->paragraphs(3, true),
            'short_description' => fake()->text(300),
            'address' => fake('de_CH')->address(),
            'lat' => fake('de_CH')->latitude(),
            'lng' => fake('de_CH')->longitude(),
            'registration_location' => fake()->randomElement(RegistrationLocation::class),
            'registration_required' => fake()->boolean(),
        ];
    }
}
