<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hinhsanpham extends Model
{
    use HasFactory;
    protected $table = 'hinhsanphams';
    protected $primaryKey='id';
    protected $guarded = [];
    protected $fillable = [
        'imgs',
        'loaihinh',
        'create_at',
        'updated_at',
        'sanpham_id',
    ];
    public function imgs_sp(){
        return $this->belongsTo(Sanpham::class,'sanpham_id');
    }
}
