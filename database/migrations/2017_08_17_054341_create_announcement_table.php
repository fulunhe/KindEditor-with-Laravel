<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 		Schema::create('announcements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->comment('标题');
			$table->text('body')->nullable()->comment('内容');
			$table->integer('user_id')->comment('发布人');
			$table->string('coverPic')->nullable()->comment('封面');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('announcements');
    }
}
