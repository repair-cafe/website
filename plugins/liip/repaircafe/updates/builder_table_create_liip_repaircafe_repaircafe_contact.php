<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeRepaircafeContact extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_repaircafe_contact', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('repaircafe_id');
            $table->integer('contact_id');
            $table->primary(['repaircafe_id','contact_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_repaircafe_contact');
    }
}
