<?php


namespace Database\Factories;


use App\Models\Rating;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     * @return array
     */
    public function definition() {
        return [
            'summary' => $this->faker->text(100),
            'artistic_value' => $this->faker->numberBetween(0,5),
            'storytelling' => $this->faker->numberBetween(0,5),
            'scenography' => $this->faker->numberBetween(0,5),
            'sound_effects' => $this->faker->numberBetween(0,5),
            'technical_implementation' => $this->faker->numberBetween(0,5),
        ];
    }
}
