<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNilaiRequest;
use App\Models\EmbedNilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    private function getAmount(int $val, int $percent): float
    {
        return round($val * $percent / 100, 2);
    }
    /**
     * Store a newly created resource in storage.
     */

    private function getNilai($val): float
    {
        return round(
            (
                $this->getAmount(collect($val->nilai_latsoal_1, $val->nilai_latsoal_2, $val->nilai_latsoal_3, $val->nilai_latsoal_4)->avg(), 15) +
                $this->getAmount(collect($val->nilai_uh_1, $val->nilai_uh_2)->avg(), 20) +
                $this->getAmount($val->nilai_uts, 25) +
                $this->getAmount($val->nilai_uas, 40)
            ),
            2
        );
    }
    public function store(StoreNilaiRequest $request, Siswa $siswa)
    {
        $data = $request->validated();
        $data["nilai"] = $this->getNilai($request);

        $siswa->nilai()->save(new EmbedNilai($data));
        return $siswa;
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return $siswa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNilaiRequest $request, Siswa $siswa)
    {
        $data = $request->validated();
        $data["nilai"] = $this->getNilai($request);

        $mapel = $siswa->nilai()->where("mapel", $request->mapel);
        if ($mapel->count() > 0) {
            $mapel->first()->update($data);
            return $siswa;
        } else {
            return response()->json(["message" => "mapel tidak ditemukan"], 404);
        }
        return $siswa;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa, string $mapel)
    {
        $curMappel = $siswa->nilai()->where("mapel", $mapel);
        if ($curMappel->count() > 0) {
            $curMappel->first()->delete();
            return $siswa;
        } else {
            return response()->json(["message" => "mapel tidak ditemukan"], 404);
        }
    }
}
