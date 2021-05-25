<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory {

    /**
     * The name of the factory's corresponding model.
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     * @return array
     */
    public function definition() {
        $gender = $this->faker->randomElement( [ 'M', 'F' ] );

        return [
            'first_name' => $this->faker->firstName( $this->getGenderFullName( $gender ) ),
            'last_name' => $this->faker->lastName,
            'gender' => $gender,
            'eyes_color' => $this->faker->randomElement( [ 'blue', 'brown', 'green', 'black', 'gray', 'amber', ] ),
            'hair_color' => $this->faker->randomElement( [ 'white', 'silver', 'blonde', 'auburn', 'brunette', 'black', 'ginger', ] ),
            'height' => $this->faker->randomFloat( 2, 1.5, 2.2 ),
            'weight' => $this->faker->randomFloat( 2, 40, 120 ),
        ];
    }

    private function getGenderFullName( $gender ) {
        if ( $gender === 'F' ) {
            return 'female';
        }

        return 'male';
    }
}
