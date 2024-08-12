<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiet_donhang extends Model
{
    use HasFactory;
    protected $table = 'chitiet_donhangs';
    protected $primaryKey='id';
    protected $guarded = [];
    protected $fillable = [
        'tong',
        'giagoc',
        'giaban',
        'soluong',
        'create_at',
        'updated_at',
        'sanpham_id',
        'donghang_id',
    ];
    public function ct_donhang(){
        return $this->belongsTo(Donhang::class,'donhang_id');
    }
    public function ct_sanpham(){
        return $this->belongsTo(Sanpham::class,'sanpham_id');
    }
    public function ct_rating(){
        return $this->hasMany(Rating::class,'chitietdh_id');
    }
}
