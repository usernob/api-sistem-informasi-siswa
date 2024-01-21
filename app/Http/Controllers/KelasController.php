<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKelasRequest;
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
            return response()->json(['message' => 'data empty'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        return Kelas::create($request->validated());
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
    public function update(StoreKelasRequest $request, Kelas $kelas)
    {
        $kelas->update($request->validated());
        return $kelas;
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
