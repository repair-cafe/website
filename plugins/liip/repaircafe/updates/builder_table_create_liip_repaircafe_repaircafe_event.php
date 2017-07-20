<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeRepaircafeEvent extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_repaircafe_event', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('repaircafe_id');
            $table->integer('event_id');
            $table->primary(['repaircafe_id','event_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_repaircafe_event');
    }
}
