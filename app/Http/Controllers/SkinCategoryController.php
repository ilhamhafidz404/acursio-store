<?php

namespace App\Http\Controllers;

use App\Models\SkinCategories;
use App\Models\SkinCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkinCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $limit = request('limit', 9);
            

            $categories= SkinCategory::latest()->paginate($limit);



            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success",
                "result" => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "An error occurred: " . $e->getMessage(),
                "result" => [],
            ], 500);
        }
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
    public function store(Request $request)
    {
        try {
            
            $skinCategory= SkinCategory::create([
                "title" => Str::slug($request->title),
                "slug" => $request->slug,
            ]);

            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success create skin category",
                "result" => $skinCategory,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "An error occurred: " . $e->getMessage(),
                "result" => [],
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = SkinCategory::find($id);
            
            if (!$data) {
                return response()->json([
                    "code" => "ACSO-002",
                    "success" => false,
                    "message" => "Kategori Skin tidak ditemukan"
                ], 404);
            }

            $data->delete();

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $data,
                'message' => 'Berhasil Menghapus Kategori Skin'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "An error occurred: " . $e->getMessage(),
                "result" => [],
            ], 500);
        }
    }
}
