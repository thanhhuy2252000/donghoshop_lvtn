<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->default('');
            $table->string('email',255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('');
            $table->string('avt',255)->nullable();
            $table->string('sdt',255)->nullable();
            $table->tinyInteger('gioitinh')->default(0);
            $table->string('diachi',255)->nullable();
            $table->tinyInteger('loai')->default(0);
            $table->tinyInteger('trangthai')->default(1);
            $table->string('google_id',255)->nullable();
            $table->string('google_token',255)->nullable();
            $table->string('github_id',255)->nullable();
            $table->string('github_token',255)->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
