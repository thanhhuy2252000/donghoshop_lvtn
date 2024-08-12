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
        Schema::create('sanphams', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->default('');
            $table->string('slug',255)->default('');
            $table->string('img',255)->default('');
            $table->integer('size')->default(0);
            $table->integer('gia')->default(0);
            $table->integer('giaKM')->default(0);
            $table->dateTime('km_tungay');
            $table->dateTime('km_denngay');
            $table->integer('soluong')->default(0);
            $table->string('loai_day',255)->default('');
            $table->string('loai_mat',255)->default('');
            $table->string('loai_kinh',255)->default('');
            $table->string('mau_day',255)->default('');
            $table->string('mau_mat',255)->default('');
            $table->string('mau_vo',255)->default('');
            $table->string('nangluong',255)->default('');
            $table->string('mota',1200)->default('');
            $table->tinyInteger('trangthai')->default('1');

            $table->timestamps();
            $table->foreignIdFor(model:\App\Models\Danhmuc::class)->constrained();
            $table->foreignIdFor(model:\App\Models\Thuonghieu::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanphams');
    }
};
