<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_departments', function (Blueprint $table) {
            DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
            $table->uuid('departmentid')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->integer('companyid');
            $table->string('departmentname');
            $table->string('departmentdesc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_departments');
    }
};
