<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeEventCategory extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_event_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('event_id');
            $table->integer('category_id');
            $table->primary(['event_id','category_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_event_category');
    }
}
