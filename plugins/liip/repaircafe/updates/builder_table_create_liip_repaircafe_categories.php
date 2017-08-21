<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeCategories extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_categories');
    }
}
