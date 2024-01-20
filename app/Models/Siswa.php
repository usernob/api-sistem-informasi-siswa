<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\EmbedsMany;
use MongoDB\Laravel\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $collection = "siswa";

    protected $fillable = [
        "nama",
        "alamat",
        "nomor_telepon",
        "jenis_kelamin",
    ];

    public function embedSiswa(): HasOne
    {
        return $this->hasOne(EmbedSiswa::class);
    }

    public function nilai(): EmbedsMany
    {
        return $this->embedsMany(EmbedNilai::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}
