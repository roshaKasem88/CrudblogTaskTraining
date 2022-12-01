<?php

namespace App\Models;
use App\Models\category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['title','Description','smallDes','image','cat_id'];
    public function category()
    {
        return $this->belongsTo(category::class,'cat_id');
    }
}
