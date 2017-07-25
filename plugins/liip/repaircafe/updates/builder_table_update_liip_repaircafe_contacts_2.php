<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeContacts2 extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_contacts', function($table)
        {
            $table->renameColumn('repaircafe_id', 'repair_cafe_id');
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_contacts', function($table)
        {
            $table->renameColumn('repair_cafe_id', 'repaircafe_id');
        });
    }
}
