<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->string('slug', 180)->unique();
            $table->string('department', 100)->nullable();
            $table->string('employment_type', 50)->nullable();
            $table->string('location', 150)->nullable();

            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->longText('responsibilities')->nullable();

            $table->unsignedInteger('quota')->default(1);
            $table->date('published_at')->nullable();
            $table->date('closing_date')->nullable();

            $table->string('status', 20)->default('draft');
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['status', 'closing_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
