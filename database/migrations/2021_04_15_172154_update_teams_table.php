<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("teams", function (Blueprint $table) {
            $table->foreignId("user_id")
                ->nullable()
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("drive_id")
                ->nullable()
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
