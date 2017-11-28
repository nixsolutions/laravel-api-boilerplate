<?php

namespace App\Seeds;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use DB;

/**
 * This is the comments table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();

        $admin = User::find(1);
        $users = User::where('name', '!=', 'Admin')->get();

        $roleAdmin = Role::where('name', 'admin')->first();
        $roleUser = Role::where('name', 'user')->first();

        $admin->attachRole($roleAdmin);

        foreach ($users as $user) {
            $user->attachRole($roleUser);
        }
    }
}
