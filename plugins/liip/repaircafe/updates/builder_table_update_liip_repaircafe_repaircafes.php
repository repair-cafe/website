<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeRepaircafes extends Migration
{
    public function up()
    {
        Schema::rename('liip_repaircafe_repaircafe', 'liip_repaircafe_repaircafes');
    }
    
    public function down()
    {
        Schema::rename('liip_repaircafe_repaircafes', 'liip_repaircafe_repaircafe');
    }
}
