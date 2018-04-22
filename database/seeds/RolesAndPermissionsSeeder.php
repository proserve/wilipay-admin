<?php
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view data']);
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'view dashboard']);

        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::create(['name' => 'Super Admin', 'email' => 'super-admin@wilipay.com', 'password' => '123456']);
        $user->assignRole('super admin');

    }
}