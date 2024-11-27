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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Ticket ID
            $table->string('title'); // Ticket title
            $table->text('description')->nullable(); // Ticket description
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'solved'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('low'); // Priority
            $table->enum('category', ['bug', 'feature_request', 'support'])->default('bug');
            $table->string('submitter')->default("dafault"); // Replace 1 with the desired default value
            $table->unsignedBigInteger('submitter_id')->default(1); // Replace 1 with the desired default value
            // $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade'); // Foreign key for categories
            // $table->foreignId('assigned_tech_id')->nullable()->constrained('users')->onDelete('set null'); // Foreign key for the technician
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
