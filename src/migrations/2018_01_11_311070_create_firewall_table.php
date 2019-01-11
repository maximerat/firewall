<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirewallTable extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firewall', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user')->unsigned()->default(null);
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('ip_address', 39)->index();

            $table->boolean('whitelisted')->default(false); /// default is blacklist

            $table->timestamps();
            
            $table->unique(array('user', 'ip_address'));

        });
        
        
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firewall');
    }
}
