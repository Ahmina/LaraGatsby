<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('ncs'); //numbres comments adding
            $table->integer('today_ncs');
            $table->integer('n_commit'); //numbres ac update/delete
            $table->integer('read_u_time'); //1 (unit) => 30seconde
            $table->string('token', 30);
            $table->string('ip', 45);
            $table->char('last_time_read', 10);
            $table->dateTime('last_ddc'); //last_day_doing_commit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_tokens');
    }
}
