<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Encuesta; // Reemplaza "Encuesta" con el nombre de tu modelo de encuestas

use Illuminate\Support\Facades\DB;
class EncuestasSeeder extends Seeder
{
    public function run()
    {
        DB::table('encuestas')->insert([
            'titulo' => 'Encuesta de satisfacción del servicio',
        ]);
    }
}
