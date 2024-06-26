<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('iduser');
            $table->string('hoten', 255);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('sdt', 10);
            $table->longText('diachi')->nullable();
            $table->string('cccd', 12);
            $table->date('ngaysinh');
            $table->string('google_id')->nullable();
            $table->Integer('idrole')->unsigned();
            $table->foreign('idrole')->references('idrole')->on('role')->onDelete('restrict');
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now())->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
