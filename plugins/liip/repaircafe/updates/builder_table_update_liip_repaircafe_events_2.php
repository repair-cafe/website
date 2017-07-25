<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeEvents2 extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_events', function($table)
        {
            $table->integer('repaircafe_id');
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_events', function($table)
        {
            $table->dropColumn('repaircafe_id');
        });
    }
}
