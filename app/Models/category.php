<?php

namespace App\Models;
use App\Models\post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=['id','name'];
    public function post()
    {
        return $this->hasMany(post::class,'id');
    }
}
