<?php

namespace App\Seeds;

use Illuminate\Database\Seeder;

/**
 * This is the comments table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'id' => 3,
                'name' => 'Alice',
                'email' => 'alice@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'id' => 4,
                'name' => 'Mark',
                'email' => 'mark@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'id' => 5,
                'name' => 'Lukas',
                'email' => 'lukas@mail.com',
                'password' => bcrypt('password'),
            ]
        ]);
    }
}
