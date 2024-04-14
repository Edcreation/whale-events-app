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
        Schema::create('user_tickets', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('event_id');
            $table->uuid('user_id');
            $table->integer('ticket_id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('available')->unsigned()->default(0);
            $table->timestamps();
            
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tickets');
    }
};
