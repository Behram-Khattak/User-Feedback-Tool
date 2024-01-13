<?php

use App\Models\Feedback;
use App\Models\User;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                    ->constrained()
                    ->cascadeOnDelete();

            $table->foreignIdFor(Feedback::class, 'feedbacks_id')
                    ->constrained()
                    ->cascadeOnDelete();

            $table->unsignedBigInteger('parent_id')
                    ->nullable();

            $table->longText('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
