<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRolesSeeder extends Seeder
{
    public function run()
    {
        // Asignar roles a usuarios por ID
        $usersRoles = [
            1 => 'alumno',       // Usuario con ID 1 será alumno
            2 => 'instructor',   // Usuario con ID 2 será instructor
            3 => 'administrador' // Usuario con ID 3 será administrador
        ];

        foreach ($usersRoles as $userId => $role) {
            $user = User::find($userId);
            if ($user) {
                $user->assignRole($role);
            }
        }
    }
}

