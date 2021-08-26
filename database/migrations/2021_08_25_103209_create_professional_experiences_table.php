<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('experience_title');
            $table->string('enterprise_name');
            $table->string('enterprise_city')->nullable();
            $table->string('enterprise_address')->nullable();
            $table->date('experience_start_date');
            $table->date('experience_end_date');
            $table->text('experience_description');
            $table->unsignedBigInteger('candidate_id');

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
        Schema::dropIfExists('professional_experiences');
    }
}
