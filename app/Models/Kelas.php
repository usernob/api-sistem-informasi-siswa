<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\EmbedsMany;
use MongoDB\Laravel\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kelas', 'jurusan', 'suffix'];

    public function embedSiswa(): EmbedsMany
    {
        return $this->embedsMany(EmbedSiswa::class);
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
