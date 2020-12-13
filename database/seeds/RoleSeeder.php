<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
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
            'actif' => 1,
            'password' => '$2y$10$2FdIVd1fvX3Cag8Rd8qegudveBtC7YzT0FUfxCke/sqp5EF2ike86'
        ]);

        User::updateOrCreate([
            'role_id' => $roleEditor->id,
            'first_name' => 'editor',
            'last_name' => 'editor',
            'email' => 'editor@editor.com',
            'username' => 'editor',
            'actif' => 1,
            'password' => '$2y$10$2FdIVd1fvX3Cag8Rd8qegudveBtC7YzT0FUfxCke/sqp5EF2ike86'
        ]);

        $permissions = [
            //Utilisateurs
            "Voir Utilisateurs",
            "Modifier Utilisateurs",
            "Creer Utilisateurs",
            "Supprimer Utilisateurs",
            "Bloquer Utilisateurs",
            //Roles
            "Voir Roles",
            "Modifier Roles",
            "Creer Roles",
            "Supprimer Roles",
            //Categories
            "Voir Categories",
            "Modifier Categories",
            "Creer Categories",
            "Supprimer Categories",
            //Publications
            "Voir Publications",
            "Modifier Publications",
            "Creer Publications",
            "Supprimer Publications",
            //Pages
            "Voir Pages",
            "Modifier Pages",
            "Creer Pages",
            "Supprimer Pages",
            //Rapports
            "Voir Rapports",
            //Corbeille
            "Corbeille",
        ];

        foreach ($permissions as $perm_name) {
            Permission::updateOrCreate(['name' => $perm_name]);
        }

        $permissions = Permission::all();

        $roleAdmin->permissions()->sync($permissions->pluck('id')->toArray());
        $roleEditor->permissions()->sync($permissions->pluck('id')->toArray());
    }
}
