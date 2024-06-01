<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->uuid('identifier')->default(Str::uuid())->unique();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('featured');
            $table->text('description');
            $table->text('short_description');
            $table->string('address');
            $table->string('color')->default('#2255cc');
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->string('origin_url')->nullable();
            $table->enum('registration_location', ['Local', 'Both', 'Remote']);
            $table->boolean('registration_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
