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
        Schema::create('hinhsanphams', function (Blueprint $table) {
            $table->id();
            $table->string('imgs',255)->default('');
            $table->integer('loaihinh')->default(0);
            $table->timestamps();
            $table->foreignIdFor(model:\App\Models\Sanpham::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hinhsanphams');
    }
};
