<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('latin_name');
            $table->string('cyrillic_name');
            $table->boolean('is_family');
            $table->string('telephone', 20)->nullable();
            $table->string('eisu_id')->nullable()->unique();
            $table->text('comment')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('gender_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('academic_group_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('creator_id')->nullable()->constrained('users')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('last_update_user_id')->nullable()->constrained('users')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
