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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->string('headline')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('religion')->nullable();
            $table->string('smoking')->nullable();
            $table->string('drinking')->nullable();
            $table->string('children')->nullable();
            $table->string('zodiac')->nullable();
            $table->string('personality_type')->nullable();
            $table->string('love_language')->nullable();
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedSmallInteger('max_distance')->default(50);
            $table->unsignedTinyInteger('age_min')->default(18);
            $table->unsignedTinyInteger('age_max')->default(60);
            $table->string('show_me')->default('everyone');
            $table->string('profile_visibility')->default('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
