<?php

use Illuminate\Database\Seeder;
use App\Seeds\TeamsTableSeeder;
use App\Seeds\TeamUsersTableSeeder;

class JsonApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamsTableSeeder::class);
        $this->call(TeamUsersTableSeeder::class);
    }
}
