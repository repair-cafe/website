<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeContacts extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_contacts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('photo')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_contacts');
    }
}
