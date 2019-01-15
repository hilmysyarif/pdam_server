<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    // Relations
    public function beritas()
    {
        return $this->hasMany('App\Berita', 'category_id');
    }
}
