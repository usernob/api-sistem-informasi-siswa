<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class EmbedNilai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'mapel',
        'nilai_latsoal_1',
        'nilai_latsoal_2',
        'nilai_latsoal_3',
        'nilai_latsoal_4',
        'nilai_uh_1',
        'nilai_uh_2',
        'nilai_uts',
        'nilai_uas',
        'nilai'
    ];
}
