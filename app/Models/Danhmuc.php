<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;
    protected $table = 'danhmucs';
    protected $primaryKey='id';
    protected $guarded = [];
    protected $fillable = [
        'tenDM',
        'create_at',
        'updated_at',
    ];
    public function dm_sanpham(){
        return $this->hasMany(Sanpham::class,'danhmuc_id');
    }
}
