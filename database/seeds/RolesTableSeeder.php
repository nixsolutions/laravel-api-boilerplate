<?php

namespace App\Seeds;

use DB;
use Illuminate\Database\Seeder;

/**
 * This is the comments table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => '',
            ],
            [
                'id' => 2,
                'name' => 'user',
                'display_name' => 'User',
                'description' => '',
            ]
        ]);
    }
}
