<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'tree_id',
        'category_id',
        'checked',
        'deadline'
    ];

    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function tree() {

       return $this->belongsTo(Tree::class);
    }

    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
