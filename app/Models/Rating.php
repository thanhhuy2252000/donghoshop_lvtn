<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $primaryKey='id';
    protected $guarded = [];

    protected $fillable = [
        'rating',
        'chitietdh_id',
        'comment',
        'user_id',
        'trangthai',
        'create_at',
        'updated_at',
    ];
    public function rating_ct(){
        return $this->belongsTo(Chitiet_donhang::class,'chitietdh_id');
    }
    public function rating_us(){
        return $this->belongsTo(User::class,'user_id');
    }
}
