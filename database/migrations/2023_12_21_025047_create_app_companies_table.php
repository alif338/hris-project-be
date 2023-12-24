<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('app_companies', function (Blueprint $table) {
            $table->id('companyid');
            $table->string('companycode');  // md5() based
            $table->string('companyname');
            $table->string('about')->nullable();
            $table->string('address')->nullable();
            $table->string('companymail')->nullable();
            $table->string('contactnumber')->nullable();
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
        Schema::dropIfExists('app_companies');
    }
};
