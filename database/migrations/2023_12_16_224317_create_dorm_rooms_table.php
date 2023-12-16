<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dorm_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('number_of_seats');
            $table->foreignId('dormitory_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creator_id')->nullable()->constrained('users')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('last_update_user_id')->nullable()->constrained('users')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
            $table->string('comment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dorm_rooms');
    }
};
