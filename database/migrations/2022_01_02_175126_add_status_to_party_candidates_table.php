<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPartyCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('party_candidates', function (Blueprint $table) {
            $table->enum('status', ['Requested', 'Accepted', 'Rejected'])->default('Accepted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('party_candidates', function (Blueprint $table) {
            //
        });
    }
}
