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
        Schema::create('reply_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("reply_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("comment_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("reply_response");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_responses');
    }
};
