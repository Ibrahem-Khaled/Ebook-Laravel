<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_isbn', 20)->unique()->nullable();
            $table->string('book_title')->nullable(false)->unique();
            $table->string('book_pdf')->nullable();
            $table->integer('free_sample')->default(0)->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('book_number_pages')->nullable();
            $table->date('book_publication_date')->nullable();
            $table->text('book_description')->nullable();
            $table->string('book_image_url', 255)->nullable()->unique();
            $table->double('book_price')->nullable();
            $table->integer('book_discount')->nullable()->default(0);
            $table->bigInteger('sort_order')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
