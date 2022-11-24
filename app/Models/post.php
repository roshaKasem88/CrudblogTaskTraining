<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table='posts';
    protected $fillable=['title','Description','smallDesc','Image','cat_id'];
    protected $hidden=['id','token'];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
