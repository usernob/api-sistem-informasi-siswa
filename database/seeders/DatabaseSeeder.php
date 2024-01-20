<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EmbedNilai;
use App\Models\EmbedSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use MongoDB\Laravel\Eloquent\Casts\ObjectId;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Kelas::factory(10)->create()->each(
            fn ($kelas) => $kelas->embedSiswa()->saveMany($this->createSiswa($kelas))
        );
    }

    protected function createSiswa($kelas)
    {
        return Siswa::factory(30)->create(['kelas_id' => $kelas->id])->each(
            fn ($siswa) => $siswa->nilai()->saveMany($this->createEmbedNilai())
        )->map(fn ($item, $key) => new EmbedSiswa(["siswa_id" => $item->id, "nama" => $item->nama]));
    }

    protected function createEmbedNilai()
    {
        return EmbedNilai::factory()
            ->count(3)
            ->state(new Sequence(
                ["mapel" => "Matematika"],
                ["mapel" => "Bahasa Inggris"],
                ["mapel" => "IPA"]
            ))->make()->each(
                function ($nilai) {
                    $nilai->nilai = round(
                        (
                            $this->getAmount(collect($nilai->nilai_latsoal_1, $nilai->nilai_latsoal_2, $nilai->nilai_latsoal_3, $nilai->nilai_latsoal_4)->avg(), 15) +
                            $this->getAmount(collect($nilai->nilai_uh_1, $nilai->nilai_uh_2)->avg(), 20) +
                            $this->getAmount($nilai->nilai_uts, 25) +
                            $this->getAmount($nilai->nilai_uas, 40)
                        ),
                        2
                    );
                }
            )->map(fn ($item, $key) => new EmbedNilai($item->toArray()));
    }

    private function getAmount(int $val, int $percent): float
    {
        return round($val * $percent / 100, 2);
    }
}
