<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeNews extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_news', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->integer('locale_id');
            $table->text('lead')->nullable();
            $table->text('content')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_news');
    }
}
