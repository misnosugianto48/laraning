<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $material = Material::with('course:id,name')->get();

        return $material;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        $data = $request->safe()->all();

        if ($request->hasFile('file_path')) {
            $path = Storage::putFile('materials', $request->file('file_path'));
        }

        Material::create([
            'course_id' => $data['course_id'],
            'title' => $data['title'],
            'file_path' => $path
        ]);

        return response()->json([
            'success' => true,
            'message' => 'upload successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function download($id)
    {
        $material = Material::find($id);

        if (!Storage::exists($material->file_path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        return Storage::download($material->file_path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }
}
