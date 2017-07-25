<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLiipRepaircafeRepaircafes4 extends Migration
{
    public function up()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_link')->nullable();
            $table->string('contact_link')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('liip_repaircafe_repaircafes', function($table)
        {
            $table->dropColumn('image');
            $table->dropColumn('logo');
            $table->dropColumn('website_link');
            $table->dropColumn('contact_link');
        });
    }
}
