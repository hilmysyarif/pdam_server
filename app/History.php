<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class History extends Model
{
    use SyncsWithFirebase;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bulan',
        'tahun',
        'jumlah_pemakaian',
        'foto_meteran',
        'total_bayar',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
