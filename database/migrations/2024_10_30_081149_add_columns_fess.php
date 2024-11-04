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
            $table->integer('feehead_id')->after('student_id');
            $table->decimal('common_fee', 8, 2)->after('tusion_fee');
            $table->decimal('extra_discount', 8, 2)->after('common_fee');
            $table->decimal('due', 8, 2)->after('extra_discount');
            $table->decimal('payment', 8, 2)->after('due');
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
