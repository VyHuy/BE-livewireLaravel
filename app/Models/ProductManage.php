<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManage extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'img',
        'price',
        'user_id'
    ];
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
