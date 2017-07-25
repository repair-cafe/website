<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeRepaircafes3 extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->dateTime('start');
            $table->dateTime('end');
        });
    }
}
