<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Comentarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'nombre' => 'Edgar Guzman',
            'descripcion' => 'El profesor X es un completo inútil. No sabe explicar los conceptos básicos y solo genera confusión en el aula. No entiendo cómo obtuvo su puesto.',
        ]);

        DB::table('comments')->insert([
            'nombre' => 'Pedro Sanchez',
            'descripcion' => 'La profesora Y es extremadamente aburrida. Su voz monótona y su falta de entusiasmo hacen que cada clase sea una tortura. No aprendo nada con ella.',
        ]);
        DB::table('comments')->insert([
            'nombre' => 'Heriberto Curla',
            'descripcion' => 'El profesor Z es un tirano. Se la pasa gritando y humillando a los estudiantes. No respeta nuestras opiniones y hace que el ambiente educativo sea completamente hostil.',
        ]);


       
    }
}
