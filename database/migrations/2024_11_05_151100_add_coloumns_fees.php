<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fess', function (Blueprint $table) {
            $table->string('monthly_discount')->after('tusion_fee');
            $table->string('fee_afterdiscount')->after('monthly_discount');
            $table->string('net_fee')->after('fee_afterdiscount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fess', function (Blueprint $table) {
            //
        });
    }
};
