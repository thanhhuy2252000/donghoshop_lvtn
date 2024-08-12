<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thuonghieu extends Model
{
    use HasFactory;
    protected $table = 'thuonghieus';
    protected $primaryKey='id';
    protected $guarded = [];
    protected $fillable = [
        'tenTH',
        'create_at',
        'updated_at',
    ];
    public function sanphams(){
        return $this->hasMany(Sanpham::class,'thuonghieu_id');
    }
}
