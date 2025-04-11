<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->text('fcm_token')->nullable();
            $table->boolean('is_login')->default(0)->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->unsignedBigInteger('role_id')->nullable()->default(2);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('admin123'), 'role_id' => 1]
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
