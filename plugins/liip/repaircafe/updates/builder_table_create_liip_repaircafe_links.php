<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeLinks extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_links', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('url');
            $table->integer('linktype_id');
            $table->integer('cafe_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_links');
    }
}
