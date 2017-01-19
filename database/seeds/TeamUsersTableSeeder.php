<?php

namespace App\Seeds;

use App\Models\Team;
use Illuminate\Database\Seeder;

/**
 * This is the comments table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class TeamUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::find(1);

        $team->members()->sync([1, 2, 3]);
    }
}
