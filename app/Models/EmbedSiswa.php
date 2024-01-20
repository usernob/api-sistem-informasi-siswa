<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class EmbedSiswa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['siswa_id', 'nama'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
