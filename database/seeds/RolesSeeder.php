<?php

use Faker\Factory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ru_Ru');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $editor_role = Role::firstOrCreate(['name' => 'editor']);
        $writer_role = Role::firstOrCreate(['name' => 'writer']);
        $reader_role = Role::firstOrCreate(['name' => 'reader']);

        $create_users_permission = Permission::firstOrCreate(['name' => 'create users']);
        $update_users_permission = Permission::firstOrCreate(['name' => 'update users',]);
        $view_users_permission = Permission::firstOrCreate(['name' => 'view users']);
        $display_users_permission = Permission::firstOrCreate(['name' => 'display users']);
        $delete_users_permission = Permission::firstOrCreate(['name' => 'delete users']);

        $update_roles_permission = Permission::firstOrCreate(['name' => 'update roles']);
        $create_roles_permission = Permission::firstOrCreate(['name' => 'create roles']);
        $view_roles_permission = Permission::firstOrCreate(['name' => 'view roles']);
        $display_roles_permission = Permission::firstOrCreate(['name' => 'display roles']);
        $delete_roles_permission = Permission::firstOrCreate(['name' => 'delete roles']);

        $update_permissions_permission = Permission::firstOrCreate(['name' => 'update permissions']);
        $create_permissions_permission = Permission::firstOrCreate(['name' => 'create permissions']);
        $view_permissions_permission = Permission::firstOrCreate(['name' => 'view permissions']);
        $display_permissions_permission = Permission::firstOrCreate(['name' => 'display permissions']);
        $delete_permissions_permission = Permission::firstOrCreate(['name' => 'delete permissions']);

        $create_books_permission = Permission::firstOrCreate(['name' => 'create books']);
        $update_books_permission = Permission::firstOrCreate(['name' => 'update books',]);
        $view_books_permission = Permission::firstOrCreate(['name' => 'view books']);
        $display_books_permission = Permission::firstOrCreate(['name' => 'display books']);
        $delete_books_permission = Permission::firstOrCreate(['name' => 'delete books']);

        $create_catalogs_permission = Permission::firstOrCreate(['name' => 'create catalogs']);
        $update_catalogs_permission = Permission::firstOrCreate(['name' => 'update catalogs',]);
        $view_catalogs_permission = Permission::firstOrCreate(['name' => 'view catalogs']);
        $display_catalogs_permission = Permission::firstOrCreate(['name' => 'display catalogs']);
        $delete_catalogs_permission = Permission::firstOrCreate(['name' => 'delete catalogs']);

        $admin_role->syncPermissions(
            $create_roles_permission->name,
            $update_roles_permission->name,
            $view_roles_permission->name,
            $display_roles_permission->name,
            $delete_roles_permission->name,

            $create_permissions_permission->name,
            $update_permissions_permission->name,
            $view_permissions_permission->name,
            $display_permissions_permission->name,
            $delete_permissions_permission->name,

            $create_users_permission->name,
            $update_users_permission->name,
            $view_users_permission->name,
            $display_users_permission->name,
            $delete_users_permission->name,

            $create_books_permission->name,
            $update_books_permission->name,
            $view_books_permission->name,
            $display_books_permission->name,
            $delete_books_permission->name,

            $create_catalogs_permission->name,
            $update_catalogs_permission->name,
            $view_catalogs_permission->name,
            $display_catalogs_permission->name,
            $delete_catalogs_permission->name
        );

        $editor_role->syncPermissions(
            $update_roles_permission->name,
            $view_roles_permission->name,
            $display_roles_permission->name,

            $update_permissions_permission->name,
            $view_permissions_permission->name,
            $display_permissions_permission->name,

            $update_users_permission->name,
            $view_users_permission->name,
            $display_users_permission->name,

            $update_books_permission->name,
            $view_books_permission->name,
            $display_books_permission->name,

            $update_catalogs_permission->name,
            $view_catalogs_permission->name,
            $display_catalogs_permission->name
        );

        $writer_role->syncPermissions(
            $create_books_permission->name,
            $update_books_permission->name,
            $view_books_permission->name,
            $display_books_permission->name,
            $delete_books_permission->name,

            $create_catalogs_permission->name,
            $update_catalogs_permission->name,
            $view_catalogs_permission->name,
            $display_catalogs_permission->name,
            $delete_catalogs_permission->name
        );

        $reader_role->syncPermissions(
            $view_books_permission->name,
            $display_books_permission->name,

            $create_catalogs_permission->name,
            $update_catalogs_permission->name,
            $view_catalogs_permission->name,
            $delete_catalogs_permission->name
        );
    }
}
