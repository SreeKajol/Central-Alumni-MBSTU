<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('student_id')->nullable();
            $table->year('batch_year')->nullable();
            $table->year('graduation_year')->nullable();
            $table->string('degree')->nullable();
            $table->string('major')->nullable();
            $table->string('profile_photo')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            
            // Career Information
            $table->string('current_company')->nullable();
            $table->string('current_position')->nullable();
            $table->string('industry')->nullable();
            
            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('website_url')->nullable();
            
            // Additional Information
            $table->text('bio')->nullable();
            $table->json('achievements')->nullable();
            $table->json('publications')->nullable();
            
            // Privacy & Status
            $table->boolean('is_profile_public')->default(true);
            $table->boolean('is_verified')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_profiles');
    }
};
