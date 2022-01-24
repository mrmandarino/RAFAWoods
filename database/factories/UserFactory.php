<?php

namespace Database\Factories;

use App\Models\User;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        $rut=\Freshwork\ChileanBundle\Rut::set(rand(1000000, 25000000))->fix()->normalize();

        return [
            'rut' => $rut,
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'correo' => $this->faker->unique()->safeEmail(),
            //'password' => 'E!'.$this->faker->password(6,10),
            'password' =>  bcrypt('11111111'),
            'tipo_usuario' => $this->faker->randomElement([User::trabajador,User::cliente]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
