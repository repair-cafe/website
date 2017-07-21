<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeRepaircafes extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_repaircafes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('title');
        });
    }

    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_repaircafes');
    }
}
