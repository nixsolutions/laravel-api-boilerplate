<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('likes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('liker_id')->unsigned()->index('fk_likes_users1_idx');
			$table->integer('liked_id')->unsigned()->index('fk_likes_users2_idx');
			$table->integer('skill_id')->unsigned()->index('fk_likes_skills1_idx');
			$table->text('comment', 65535)->nullable();
			$table->primary(['id','liker_id','liked_id','skill_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('likes');
	}

}
