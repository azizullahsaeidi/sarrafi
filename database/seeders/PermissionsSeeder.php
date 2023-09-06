<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->delete();

        DB::table('permissions')->insert([

            // User Permission
            [
                'name' => 'User List',
                'module' => 'User',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create User',
                'module' => 'User',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit User',
                'module' => 'User',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete User',
                'module' => 'User',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            9 => [
                'name' => 'Role List',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Role',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Role',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Role',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Permission List',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grand Permission',
                'module' => 'User Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            // Setting Permission
            [
                'name' => 'General Information',
                'module' => 'Settings',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Backup',
                'module' => 'Settings',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rate',
                'module' => 'Settings',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Logs',
                'module' => 'Settings',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sidebar Permission
            
            [
                'name' => 'Setting',
                'module' => 'Sidebar',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Account Permissions
            [
                'name' => 'Account List',
                'module' => 'Account',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Account',
                'module' => 'Account',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Account',
                'module' => 'Account',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Account',
                'module' => 'Account',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Account Transaction Permissions
            [
                'name' => 'Transaction List',
                'module' => 'AccountTransaction',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Transaction',
                'module' => 'AccountTransaction',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Transaction',
                'module' => 'AccountTransaction',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Transaction',
                'module' => 'AccountTransaction',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            // Box Permissions
            [
                'name' => 'Box List',
                'module' => 'Box',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Box',
                'module' => 'Box',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daily Box',
                'module' => 'Box',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
