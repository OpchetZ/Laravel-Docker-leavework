<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangTypeVaca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leavebalances', function (Blueprint $table) {
            $table->float('vacation_leave',16,2)->nullable()->change();
            $table->float('vacation_carried',16,2)->nullable()->change();
            $table->float('max_carry',16,2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leavebalance', function (Blueprint $table) {
            //
        });
    }
}
