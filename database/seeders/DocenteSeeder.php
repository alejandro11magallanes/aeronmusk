<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Docente;
use App\Models\Encuesta; 
class DocenteSeeder extends Seeder
{
    public function run()
    {
        // Crear registros de ejemplo
        $docentes = [
            [
                'nivel_id' => 1,
                'user_id' => 2,
                'grado' => 'Docente A',
                'seccion' => 'Sección 1',
            ],
           
            // Agrega más registros de ejemplo si es necesario
        ];

        // Insertar los registros en la base de datos
        foreach ($docentes as $docente) {
            Docente::create($docente);
        }


    }
}

