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
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('title');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->boolean('is_published')->default(0);
            $table->integer('cafe_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('street')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_events');
    }
}
