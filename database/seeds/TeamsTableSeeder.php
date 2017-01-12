<?php

namespace App\Seeds;

use Illuminate\Database\Seeder;

/**
 * This is the comments table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('teams')->insert([
            [
                'id' => 1,
                'name' => 'Team1'
            ],
            [
                'id' => 2,
                'name' => 'Team2'
            ]
        ]);
    }
}
