<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Nivel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveledus')->insert([
            'nombre' => 'Primaria',
            'descripcion' => 'La Educación Secundaria constituye el último nivel de la Educación Básica, en él los estudiantes consolidan el perfil de egreso para contribuir con el desarrollo de las competencias para la vida que desde la Educación Preescolar han trabajado.',
        ]);

        DB::table('niveledus')->insert([
            'nombre' => 'Secundaria',
            'descripcion' => 'La Educación Secundaria constituye el último nivel de la Educación Básica, en él los estudiantes consolidan el perfil de egreso para contribuir con el desarrollo de las competencias para la vida que desde la Educación Preescolar han trabajado.',
        ]);
        DB::table('niveledus')->insert([
            'nombre' => 'Bachillerato',
            'descripcion' => 'El bachillerato entonces se cataloga como el período de aprendizaje del alumno que le permite obtener el título de bachiller, el cual es un requisito para poder continuar sus estudios a nivel universitario en las instituciones superiores en cualquier lugar del mundo.',
        ]);
    }
}
