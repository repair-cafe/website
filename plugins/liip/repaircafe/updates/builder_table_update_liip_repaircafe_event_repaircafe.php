<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeEventRepaircafe extends Migration
{
    public function up()
    {
        Schema::rename('liip_repaircafe_repaircafe_event', 'liip_repaircafe_event_repaircafe');
    }
    
    public function down()
    {
        Schema::rename('liip_repaircafe_event_repaircafe', 'liip_repaircafe_repaircafe_event');
    }
}
