<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Orden_compraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rut_proveedores=['768213305','775592303','965396802'];
        $random=$this->faker->randomElement($rut_proveedores);

        return [
            'total_oocc' => 0,
            'sucursal_id' => rand(1,4),
            'proveedor_rut' => $random,
        ];
    }
}
