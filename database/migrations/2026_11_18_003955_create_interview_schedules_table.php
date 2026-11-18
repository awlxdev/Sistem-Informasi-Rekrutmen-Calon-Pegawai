<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            $table->dateTime('scheduled_at');

            $table->string('timezone', 50)
                ->default('Asia/Jayapura');

            $table->string('method', 20); // online / offline

            $table->string('location')->nullable();
            $table->string('meeting_url')->nullable();

            $table->text('notes')->nullable();

            $table->string('status', 20)
                ->default('scheduled');
                // scheduled / rescheduled / cancelled / completed

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['application_id', 'status']);
            $table->index('scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
