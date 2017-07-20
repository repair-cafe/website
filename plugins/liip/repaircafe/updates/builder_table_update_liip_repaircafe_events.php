<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeEvents extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_events', function($table)
        {
            $table->renameColumn('owner_id', 'user_id');
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_events', function($table)
        {
            $table->renameColumn('user_id', 'owner_id');
        });
    }
}
