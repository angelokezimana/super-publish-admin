<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::updateOrCreate(['name' => 'admin']);
        $roleEditor = Role::updateOrCreate(['name' => 'editor']);

        User::updateOrCreate([
            'role_id' => $roleAdmin->id,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => '$2y$10$2FdIVd1fvX3Cag8Rd8qegudveBtC7YzT0FUfxCke/sqp5EF2ike86'
        ]);

        User::updateOrCreate([
            'role_id' => $roleEditor->id,
            'first_name' => 'editor',
            'last_name' => 'editor',
            'email' => 'editor@editor.com',
            'username' => 'editor',
            'password' => '$2y$10$2FdIVd1fvX3Cag8Rd8qegudveBtC7YzT0FUfxCke/sqp5EF2ike86'
        ]);
    }
}
