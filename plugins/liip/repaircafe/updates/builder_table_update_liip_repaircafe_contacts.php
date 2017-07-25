<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeContacts extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_contacts', function($table)
        {
            $table->integer('repaircafe_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_contacts', function($table)
        {
            $table->dropColumn('repaircafe_id');
        });
    }
}
