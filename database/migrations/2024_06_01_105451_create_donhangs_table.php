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
        Schema::create('donhangs', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->default('');
            $table->string('email',255)->default('');
            $table->string('sdt',10)->default('');
            $table->string('diachi',255)->default('');
            $table->integer('tongDH')->default(0);
            $table->string('pt_thanhtoan',255)->default('');
            $table->string('trangthai')->default('Chưa xác nhận');
            $table->timestamps();

            $table->foreignIdFor(model:\App\Models\User::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhangs');
    }
};
