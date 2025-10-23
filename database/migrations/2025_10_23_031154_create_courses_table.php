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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('instructor_id');
            $table->text('course_title')->nullable();
            $table->string('course_slug')->nullable();
            $table->text('course_name')->nullable();
            $table->string('course_image')->nullable();
            $table->longText('course_description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('label')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->text('prerequisites')->nullable();
            $table->string('best_seller')->nullable();
            $table->string('featured')->nullable();
            $table->string('hightest_rated')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
