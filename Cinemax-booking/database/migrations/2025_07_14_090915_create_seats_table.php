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
            $table->foreignId('seat_type_id')->nullable()->constrained()->onDelete('set null'); // GỘP LUÔN VÀO ĐÂY
            $table->string('seat_number');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            $table->dropForeign(['seat_type_id']);
            $table->dropColumn('seat_type_id');
        });
    }
};
