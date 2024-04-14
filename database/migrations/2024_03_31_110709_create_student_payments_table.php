<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_payment_type_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('student_id')->constrained()->cascadeOnUpdate();
            $table->integer('value')->default(0);
            $table->string('comment')->nullable();
            $table->unique(['student_payment_type_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
