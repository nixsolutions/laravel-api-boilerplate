<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('likes', function(Blueprint $table)
		{
			$table->foreign('skill_id', 'fk_likes_skills1')->references('id')->on('skills')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('liker_id', 'fk_likes_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('liked_id', 'fk_likes_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('likes', function(Blueprint $table)
		{
			$table->dropForeign('fk_likes_skills1');
			$table->dropForeign('fk_likes_users1');
			$table->dropForeign('fk_likes_users2');
		});
	}

}
