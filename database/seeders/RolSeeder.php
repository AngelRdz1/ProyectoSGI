<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'director']);
        $role2 = Role::create(['name'=>'docente']);

        Permission::create(['name'=>'administracion-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'reportes-read'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'reportes-write'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'adminUsuarios-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'adminUsuarios-write'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'adminBitacora-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'adminBitacora-write'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'docente-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'docente-write'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'estudiante-read'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'estudiante-write'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'grado-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'grado-write'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'materia-read'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'materia-write'])->syncRoles([$role1 ]);
        Permission::create(['name'=>'evluaciones-read'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'evaluaciones-write'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'comportamiento-read'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'comportamiento-write'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'boleta-read'])->syncRoles([$role1,$role2 ]);
        Permission::create(['name'=>'boleta-write'])->syncRoles([$role1,$role2 ]);

        $user1 = User::create([
            'name' => 'Manuel',
            'email' => 'manuel@gmail.com',
            'password' => bcrypt('1234')
        ]);
        //$user1->assignRole($role1);

        $user2 = User::create([
            'name' => 'Luis',
            'email' => 'luis@gmail.com',
            'password' => bcrypt('1234')
        ]);
        //$user2->assignRole($role2);
    }
}
