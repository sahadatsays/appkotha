<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('version')->default('1.0.0');

            $table->text('description')->nullable();
            $table->text('changelog')->nullable();

            $table->boolean('is_main')->default(false); // Main downloadable file
            $table->boolean('is_active')->default(true);

            $table->integer('download_count')->default(0);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index(['product_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_files');
    }
};
