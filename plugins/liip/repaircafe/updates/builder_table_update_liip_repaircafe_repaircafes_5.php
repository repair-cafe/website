<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeRepaircafes5 extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
        });
    }
}
