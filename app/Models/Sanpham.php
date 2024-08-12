<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanphams';
    protected $primaryKey='id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'size',
        'soluong',
        'gia',
        'giaKM',
        'km_tungay',
        'km_denngay',
        'img',
        'slug',
        'loai_day',
        'loai_mat',
        'loai_kinh',
        'mau_vo',
        'mau_day',
        'mau_mat',
        'nangluong',
        'trangthai',
        'mota',
        'create_at',
        'updated_at',
        'danhmuc_id',
        'thuonghieu_id',
    ];
    public function sp_chitiet(){
        return $this->hasMany(Chitiet_donhang::class,'sanpham_id');
    }
    public function sp_hinhsanpham(){
        return $this->hasMany(Hinhsanpham::class,'sanpham_id');
    }
    public function sp_thuonghieu(){
        return $this->belongsTo(Thuonghieu::class,'thuonghieu_id');
    }
    public function sp_danhmuc(){
        return $this->belongsTo(Danhmuc::class,'danhmuc_id');
    }
    
}
