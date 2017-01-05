<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membership', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('team_id')->unsigned()->index('fk_membership_teams1_idx');
			$table->integer('user_id')->unsigned()->index('fk_membership_users1_idx');
			$table->string('role');
			$table->unique(['id','team_id','user_id'], 'unique_team_id_user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('membership');
	}

}
