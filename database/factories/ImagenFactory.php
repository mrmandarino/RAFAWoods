<?php

namespace Database\Factories;

use App\Models\Imagen;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenFactory extends Factory
{
    protected $model = Imagen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $auxiliar="\hola";
        return [
            'url' => 'images'.$auxiliar[0].$this->faker->image('public/images',640,480,null,false), 
        ];
    }
}
