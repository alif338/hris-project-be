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
        Schema::create('app_payrolls', function (Blueprint $table) {
            DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
            $table->uuid('payrollid')->default(DB::raw('uuid_generate_v4()'));
            $table->date('payrolldate');
            $table->string('purposes')->nullable();
            $table->integer('amount')->default(0);
            $table->uuid('userid');
            $table->string('bank_account');
            $table->string('currency');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('app_payrolls');
    }
};
