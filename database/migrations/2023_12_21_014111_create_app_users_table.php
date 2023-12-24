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
        Schema::create('app_users', function (Blueprint $table) {
            DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
            $table->uuid('userid')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('email')->unique();
            $table->string('password');
            $table->string('rolecode');
            $table->string('fullname')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('companycode')->nullable();
            $table->string('address')->nullable();
            $table->uuid('departmentid')->nullable();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
};
