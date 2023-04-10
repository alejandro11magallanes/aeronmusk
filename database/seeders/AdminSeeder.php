<?php

namespace Database\Seeders;

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
            'name'=>'Admin',
            'email'=>'alejandroguzman23221@gmail.com',
            'password'=>bcrypt('123'),
            'profile' => 'perfil.png'
        ]);

        $supervisor = User::create([
            'name'=>'Supervisor',
            'email'=>'alejandroguzman2322@gmail.com',
            'password'=>bcrypt('123')
        ]);
        
        $normal = User::create([
            'name'=>'miguel',
            'email'=>'miguelagl0927@gmail.com',
            'password'=>bcrypt('123')
        ]);

        $admin_role = Role::create(['name' => 'admin']);
        $supervisor_role = Role::create(['name' => 'supervisor']);
        $normal_role = Role::create(['name' => 'normal']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

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

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        
        $permission = Permission::create(['name' => 'Codes access']);
        
       // $permisonormal= 


       // $permisonormal = Permission::create(['name' => 'Post access']);
      //  $permisonormal = Permission::create(['name' => 'Post edit']);
       // $permisonormal = Permission::create(['name' => 'Post create']);
       // $permisonormal = Permission::create(['name' => 'Post delete']);


        $admin->assignRole($admin_role);
        $supervisor->assignRole($supervisor_role);
        $normal->assignRole($normal_role);

        $admin_role->givePermissionTo(Permission::all());
       // $normal_role->givePermissionTo(Permission::find(1));
        $normal_role->givePermissionTo('Post access');
    }
}
