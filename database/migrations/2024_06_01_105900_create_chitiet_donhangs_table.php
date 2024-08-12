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
        Schema::create('chitiet_donhangs', function (Blueprint $table) {
            $table->id();
            $table->integer('tong')->default(0);
            $table->integer('soluong')->default(0);
            $table->integer('giagoc')->default(0);
            $table->integer('giaban')->default(0);
            $table->timestamps();

            $table->foreignIdFor(model:\App\Models\Sanpham::class)->constrained();
            $table->foreignIdFor(model:\App\Models\Donhang::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitiet_donhangs');
    }
};
