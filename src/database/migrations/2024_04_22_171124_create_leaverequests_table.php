<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaverequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaverequests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('employ_id')->nullable();
            $table->string('leave_type_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('total_leave',16,1)->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leaverequests');
    }
}
