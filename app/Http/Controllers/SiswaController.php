<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\EmbedNilai;
use App\Models\EmbedSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all()->map(fn ($item) => $data = $item->only("_id", "nama", "alamat", "nomor_telepon", "jenis_kelamin"));
        if ($siswa) {
            return $siswa->toArray();
        } else {
            return response()->json(['message' => 'data empty'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $siswa = Siswa::create($request->validated());
        if ($request->has('kelas_id')) {
            if (!$this->addToKelas($request->kelas_id, $siswa->id, $request->validated()["nama"])) {
                return response()->json(['message' => 'id kelas tidak ditemukan'], 404);
            }
        }
        return $siswa;
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $data = $siswa->only("_id", "nama", "alamat", "nomor_telepon", "kelas_id", "jenis_kelamin");
        $data["nilai"] = $siswa->nilai->map(fn ($nilai) => $nilai->only(["mapel", "nilai"]));
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        // TODO: this method have some error
        $data = array_merge($siswa->only(["_id", "nama", "alamat", "nomor_telepon", "kelas_id", "jenis_kelamin"]), $request->validated());
        if ($request->has('kelas_id')) {
            if (!$this->addToKelas($request->kelas_id, $siswa->id, $data["nama"])) {
                return response()->json(['message' => 'id kelas tidak ditemukan'], 404);
            }

            if (!$this->deleteFromKelas($siswa)) {
                return response()->json(['message' => 'id kelas tidak ditemukan'], 404);
            }
        }

        $siswa->update($request->validated());
        return $siswa;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        if (!$this->deleteFromKelas($siswa)) {
            return response()->json(['message' => 'id kelas tidak ditemukan'], 404);
        }
        return $siswa;
    }

    private function deleteFromKelas(Siswa $siswa): bool
    {
        // TODO: this method have some error
        if ($siswa->kelas_id) {
            $kelas = Kelas::find($siswa->kelas_id);
            if ($kelas) {
                $siswa = $kelas->embedSiswa()->where('siswa_id', $siswa->id);
                if ($siswa->count() > 0) {
                    $siswa->first()->delete();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }

    private function addToKelas($kelas_id, $siswa_id, string $nama): bool
    {
        // TODO: this method have some error
        $kelas = Kelas::find($kelas_id);
        if ($kelas) {
            $kelas->embedSiswa()->save(new EmbedSiswa(["siswa_id" => $siswa_id, "nama" => $nama]));
        } else {
            return false;
        }
        return true;
    }
}
