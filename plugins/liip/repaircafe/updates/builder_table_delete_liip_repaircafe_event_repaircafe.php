<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteLiipRepaircafeEventRepaircafe extends Migration
{
    public function up()
    {
        Schema::dropIfExists('liip_repaircafe_event_repaircafe');
    }
    
    public function down()
    {
        Schema::create('liip_repaircafe_event_repaircafe', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('repaircafe_id');
            $table->integer('event_id');
            $table->primary(['repaircafe_id','event_id']);
        });
    }
}
