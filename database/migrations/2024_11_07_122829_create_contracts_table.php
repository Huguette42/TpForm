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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('contract_nature');
            $table->string('contract_name');
            $table->string('contract_adress');
            $table->string('contract_date');
            $table->string('contract_repartition');
            $table->integer('contract_min_sign');
            $table->string('contract_clause_duration');
            $table->string('contract_state');
            $table->string('contract_location');
            $table->string('contract_avocate_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
