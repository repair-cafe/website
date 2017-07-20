<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeEvents extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('title');
            $table->integer('owner_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('is_published')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_events');
    }
}
