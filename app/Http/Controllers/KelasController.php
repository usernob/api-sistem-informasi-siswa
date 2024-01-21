<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all()->map(fn ($item) => $item->only("_id", "kelas", "jurusan", "suffix"));
        if ($kelas) {
            return $kelas->toArray();
        } else {
            return response()->json(['message' => 'data kosong'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        $newdata = $request->validated();

        // check if data exist
        $kelas = Kelas::where('kelas', $newdata['kelas'])->where('jurusan', $newdata['jurusan'])->where('suffix', $newdata['suffix'])->count();

        if ($kelas > 0) {
            return response()->json(['message' => 'kelas sudah ada'], 409);
        } else {
            return Kelas::create($request->validated());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return $kelas;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $dataRequest = $request->validated();
        $dataOld = $kelas->only(["kelas", "jurusan", "suffix"]);
        $newdata = array_merge($dataOld, $dataRequest);

        $kelasCount = Kelas::where('kelas', $newdata['kelas'])->where('jurusan', $newdata['jurusan'])->where('suffix', $newdata['suffix'])->count();

        if ($kelasCount > 0) {
            return response()->json(['message' => 'kelas dengan nama kelas, jurusan and suffix ini sudah ada'], 409);
        } else {
            $kelas->update($request->validated());
            return $kelas;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return $kelas;
    }
}
