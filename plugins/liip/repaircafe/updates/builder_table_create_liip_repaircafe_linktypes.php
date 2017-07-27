<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeLinktypes extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_linktypes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('class_name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_linktypes');
    }
}
