<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'user_id',
        'active'
    ];
    public function user() {

        return $this->belongsTo(User::class);
 
     }
    
     public function resolutions(){

        return $this->hasMany(Resolution::class);
     }
}
