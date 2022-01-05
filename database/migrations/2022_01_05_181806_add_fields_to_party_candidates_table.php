<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPartyCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('party_candidates', function (Blueprint $table) {
            $table->string('candidate_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable();
            $table->string('village')->nullable();
            $table->string('post_office')->nullable();
            $table->string('upazilla')->nullable();
            $table->string('district')->nullable();
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
            $table->dropColumn('candidate_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('father_name');
            $table->dropColumn('mobile');
            $table->dropColumn('description');
            $table->dropColumn('village');
            $table->dropColumn('post_office');
            $table->dropColumn('upazilla');
            $table->dropColumn('district');
        });
    }
}
