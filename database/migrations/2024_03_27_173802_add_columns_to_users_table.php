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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_success')->nullable()->comment('1: success in first round, 0: fail in first round')->after('serial');
            $table->boolean('start_final_round')->nullable()->default(0)->comment('1: start final round, 0: not start final round')->after('is_success');
            $table->double('grade2', 8, 2)->nullable()->after('is_success');
            $table->integer('serial2')->nullable()->after('grade2');
            $table->integer('final_serial')->nullable()->after('serial2')->comment('final serial after success in second round');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_success');
            $table->dropColumn('start_final_round');
            $table->dropColumn('grade2');
            $table->dropColumn('serial2');
            $table->dropColumn('final_serial');
        });
    }
};
