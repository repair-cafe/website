<?php namespace Liip\RepairCafe\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipRepaircafeCafeUser extends Migration
{
    public function up()
    {
        Schema::create('liip_repaircafe_cafe_user', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id');
            $table->integer('cafe_id');
            $table->primary(['user_id','cafe_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_repaircafe_cafe_user');
    }
}
