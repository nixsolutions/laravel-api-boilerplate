<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMembershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('membership', function(Blueprint $table)
		{
			$table->foreign('team_id', 'fk_membership_teams1')->references('id')->on('teams')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_membership_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('membership', function(Blueprint $table)
		{
			$table->dropForeign('fk_membership_teams1');
			$table->dropForeign('fk_membership_users1');
		});
	}

}
