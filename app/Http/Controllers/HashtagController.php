<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $limit = request('limit', 9);
            $category = request('category');

            $hashtags = Hashtag::query()
                ->when($category, function ($query, $category) {
                    $query->whereHas('skinCategory', function ($q) use ($category) {
                        $q->where('slug', $category);
                    });
                })
                ->with("skinCategory")
                ->withCount('sellingAccounts')
                ->latest()
                ->paginate($limit);



            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success",
                "result" => $hashtags,
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
            
            $hashtag= Hashtag::create([
                "title" => Str::slug($request->title),
                "slug" => $request->slug,
                "description" => $request->description,
            ]);

            return response()->json([
                "code" => "ACSO-001",
                "success" => true,
                "message" => "success create hashtag",
                "result" => $hashtag,
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
            $data = Hashtag::find($id);
            
            if (!$data) {
                return response()->json([
                    "code" => "ACSO-002",
                    "success" => false,
                    "message" => "Hashtag tidak ditemukan"
                ], 404);
            }

            $data->delete();

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $data,
                'message' => 'Berhasil Menghapus Hashtag'
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