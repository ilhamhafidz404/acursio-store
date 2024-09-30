<?php

namespace App\Http\Controllers;

use App\Models\SellingAccount;
use Illuminate\Http\Request;

class SellingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellingAccounts = SellingAccount::latest()->get();

        return response()->json([
            "code" => "ACSO-001",
            "success" => false,
            "message" => "success",
            "data" => $sellingAccounts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lakukan validasi terlebih dahulu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:selling_accounts,slug',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rank' => 'required|string|max:255',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            // Buat akun baru
            $sellingAccount = SellingAccount::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath,
                'rank' => $request->rank,
                'total_heroes' => $request->totalHero,
                'total_skin' => $request->totalSkin,
                'discount' => $request->discount,
            ]);

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $sellingAccount,
                'message' => 'Berhasil Membuat Akun Jubel'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "code" => "ACSO-003",
                'success' => false,
                'message' => 'Gagal Membuat Akun Jubel',
                'error' => $e->getMessage(),
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
        //
    }
}
