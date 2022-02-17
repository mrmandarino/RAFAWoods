<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $familias=['Plancha_construccion','Techumbre', 'Mueble', 'Tornillo','Clavo','Madera','Herramienta','Otro'];
        $random=$this->faker->randomElement($familias);

        return [
            'nombre' => $random . '_'. chr(rand(ord('a'), ord('z'))). rand(100,500) . chr(rand(ord('a'), ord('z'))),
            'descripcion' => $this->faker->sentence(), //'descripcion' => $this->faker->paragraph(),
            'nivel_demanda' => rand(1,3),
            'familia' => $random,
            'estado' => 1,
        ];
    }
}
