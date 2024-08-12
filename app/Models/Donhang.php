<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $table = 'donhangs';
    protected $primaryKey='id';
    protected $guarded = [];
    protected $fillable = [
        'tongDH',
        'name',
        'email',
        'sdt',
        'diachi',
        'pt_thanhtoan',
        'trangthai',
        'create_at',
        'updated_at',
        'user_id',
    ];
    public function dh_chitiet(){
        return $this->hasMany(Chitiet_donhang::class,'donhang_id');
    }
    public function dh_users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
