<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['مدیر کل', 'خزانه دار'];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role,
            ],
            [
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}
