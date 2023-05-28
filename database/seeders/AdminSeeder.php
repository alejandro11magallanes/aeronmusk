<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Edgar',
            'email' => 'alejandroguzman2322@gmail.com',
            'password' => bcrypt('123456789'),
            'profile' => 'edgar.jpg',
            'apaterno' => 'Segovia',
            'amaterno' => 'Guzman',
            'fechanacimiento' => '10/10/2000'
        ]);


        $docentes = User::create([
            'name' => 'Miguel',
            //'email'=>'20170189@uttcampus.edu.mx',
            'email' => 'alejandrofirst21@outlook.com',
            'password' => bcrypt('123456789'),
            'profile' => 'pineda.jpg',

            'apaterno' => 'Pineda',
            'amaterno' => 'Magallanes',
            'fechanacimiento' => '10/10/2003'
        ]);

        $alumnos = User::create([
            'name' => 'Diego',
            'email' => 'diego@gmail.com',
            'password' => bcrypt('123456789'),
            'profile' => 'diego.jpg',
            'apaterno' => 'Gomez',
            'amaterno' => 'Marin',
            'fechanacimiento' => '10/10/2000'
        ]);

        $alumnos2 = User::create([
            'name' => 'Miguel',
            'email' => 'Miguel@gmail.com',
            'password' => bcrypt('123456789'),
            'profile' => 'miguel.jpg',
            'apaterno' => 'Lopez',
            'amaterno' => 'Almanza',
            'fechanacimiento' => '10/10/2000'
        ]);

        $admin_role = Role::create(['name' => 'admin']);
        $alumnos_role = Role::create(['name' => 'alumnos']);
        $docentes_role = Role::create(['name' => 'docentes']);

        $permission = Permission::create(['name' => 'Alumnos access']);
        $permission = Permission::create(['name' => 'Alumnos edit']);
        $permission = Permission::create(['name' => 'Alumnos create']);
        $permission = Permission::create(['name' => 'Alumnos delete']);

        $permission = Permission::create(['name' => 'Educacion access']);
        $permission = Permission::create(['name' => 'Educacion edit']);
        $permission = Permission::create(['name' => 'Educacion create']);
        $permission = Permission::create(['name' => 'Educacion delete']);


        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);



        $permission = Permission::create(['name' => 'Marca access']);
        $permission = Permission::create(['name' => 'Marca edit']);
        $permission = Permission::create(['name' => 'Marca create']);
        $permission = Permission::create(['name' => 'Marca delete']);

        $permission = Permission::create(['name' => 'Nivel access']);
        $permission = Permission::create(['name' => 'Nivel edit']);
        $permission = Permission::create(['name' => 'Nivel create']);
        $permission = Permission::create(['name' => 'Nivel delete']);

        $permission = Permission::create(['name' => 'Docentes access']);
        $permission = Permission::create(['name' => 'Docentes edit']);
        $permission = Permission::create(['name' => 'Docentes create']);
        $permission = Permission::create(['name' => 'Docentes delete']);

        $permission = Permission::create(['name' => 'Encuestas access']);
        $permission = Permission::create(['name' => 'Encuestas edit']);

        $permission = Permission::create(['name' => 'Evaluaciones access']);
        $permission = Permission::create(['name' => 'Evaluaciones edit']);

        $permission = Permission::create(['name' => 'Comentarios access']);
        $permission = Permission::create(['name' => 'Comentarios edit']);


        $admin->assignRole($admin_role);
        $docentes->assignRole($docentes_role);
        $alumnos->assignRole($alumnos_role);
        $alumnos2->assignRole($alumnos_role);

        $admin_role->givePermissionTo('Docentes access', 'Docentes edit', 'Docentes create', 'Docentes delete', 'Nivel access', 'Nivel edit', 'Nivel create', 'Nivel delete', 'User access', 'User edit', 'User create', 'User delete', 'Role access', 'Role edit', 'Role create', 'Role delete', 'Alumnos access', 'Alumnos edit', 'Alumnos create', 'Alumnos delete', 'Educacion access', 'Educacion edit', 'Educacion create', 'Educacion delete', );

        $docentes_role->givePermissionTo('Evaluaciones access', 'Evaluaciones edit', 'Comentarios access', 'Comentarios edit');
        $alumnos_role->givePermissionTo('Encuestas access', 'Encuestas edit');

    }
}