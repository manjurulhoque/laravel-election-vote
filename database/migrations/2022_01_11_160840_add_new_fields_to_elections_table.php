<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('elections', function (Blueprint $table) {
            $table->boolean('is_published')->default(false);
            $table->unsignedBigInteger('winner_id')->nullable();

            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elections', function (Blueprint $table) {
            $table->dropColumn('is_published');
            $table->dropColumn('winner_id');
        });
    }
}
