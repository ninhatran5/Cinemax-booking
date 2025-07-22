<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('seat_type_id')->nullable()->constrained()->onDelete('set null');
            $table->string('row');
            $table->unsignedInteger('position_x');
            $table->unsignedInteger('position_y'); // Bổ sung nếu dùng để xác định hàng (A=1, B=2,...)
            $table->string('name'); // A1, B2,...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
