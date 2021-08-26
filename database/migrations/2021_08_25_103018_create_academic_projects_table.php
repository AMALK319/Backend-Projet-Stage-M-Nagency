<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_projects', function (Blueprint $table) {
            $table->id();

            $table->string('project_title');
            $table->text('project_description');
            $table->string('master_project')->nullable();
            $table->date('project_start_date');
            $table->date('project_end_date');


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
        Schema::dropIfExists('academic_projects');
    }
}

