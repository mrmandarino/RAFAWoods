<?php

namespace Database\Factories;

use App\Models\User;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        
        
        return [
            'sucursal_id' => 1,
            'medio_de_pago' => rand(1, 4),
            'total_venta' => rand(150000, 350000),
            'con_factura' => rand(1,2),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
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
