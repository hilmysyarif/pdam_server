<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'content',
        'judul',
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault([
            'name' => 'Berita',
        ]);
    }
}
