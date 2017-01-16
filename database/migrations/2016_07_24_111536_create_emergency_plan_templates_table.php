<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyPlanTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_plan_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id');
            $table->integer('organisation_id');
            $table->integer('facility_id');
            $table->string('slug');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('display_sequence')->default(100);
            $table->boolean('required');
            $table->text('template')->nullable();
            $table->integer('sortOrder');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emergency_plan_templates');
    }
}
