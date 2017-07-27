<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeCafes extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_cafes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug');
            $table->string('street')->nullable();
            $table->boolean('is_published')->default(1);
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_cafes');
    }
}
