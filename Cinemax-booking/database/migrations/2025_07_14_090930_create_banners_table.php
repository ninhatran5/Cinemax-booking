<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable(); // để tránh lỗi khi khởi tạo
            $table->string('position')->default('top');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Seed mặc định 5 banner rỗng
        DB::table('banners')->insert([
            ['id' => 1, 'title' => 'Banner 1', 'image' => null, 'position' => 'top', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'title' => 'Banner 2', 'image' => null, 'position' => 'top', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'title' => 'Banner 3', 'image' => null, 'position' => 'top', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'title' => 'Banner 4', 'image' => null, 'position' => 'top', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'title' => 'Banner 5', 'image' => null, 'position' => 'top', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
