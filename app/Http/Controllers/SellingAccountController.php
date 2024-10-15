<?php

namespace App\Http\Controllers;

use App\Models\SellingAccount;
use Illuminate\Http\Request;

class SellingAccountController extends Controller
{
    
    public function index()
{
    try {
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');
        $condition = request('condition'); // 1 = semua, 2 = hanya yang diskon

        $query = SellingAccount::query();

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($condition == "2") {
            $query->where('discount', '>', 0);
        }

        $sellingAccounts = $query->latest()->paginate(9);

        if ($sellingAccounts->isEmpty()) {
            return response()->json([
                "code" => "ACSO-002",
                "success" => false,
                "message" => "No data found",
                "result" => [],
            ], 404);
        }

        return response()->json([
            "code" => "ACSO-001",
            "success" => true,
            "message" => "success",
            "result" => $sellingAccounts,
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



    public function store(Request $request)
    {

        // Lakukan validasi terlebih dahulu
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:selling_accounts,slug',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'rank' => 'required|string|max:255',
            'accountEmail' => 'required|string',
            'accountPassword' => 'required|string',
        ]);

        try {
            $image1Path = null;
            if ($request->hasFile('image1')) {
                $image1Path = $request->file('image1')->store('images', 'public');
            }
            
            $image2Path = "";
            if ($request->hasFile('image2')) {
                $image2Path = $request->file('image2')->store('images', 'public');
            }

            // Buat akun baru
            $sellingAccount = SellingAccount::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'price' => $request->price,
                'description' => $request->description,
                'image1' => $image1Path,
                'image2' => $image2Path,
                'rank' => $request->rank,
                'total_heroes' => $request->totalHero,
                'total_skin' => $request->totalSkin,
                'discount' => $request->discount,
                'email_account' => $request->accountEmail,
                'password_account' => $request->accountPassword,
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

    public function show(string $id)
    {
        $sellingAccount = SellingAccount::whereId($id)->orWhere("slug", $id)->first();    

        return response()->json([
            "code" => "ACSO-001",
            'success' => true,
            'result' => $sellingAccount,
            'message' => 'Berhasil Ambil Data Akun Jubel'
        ]);
    }

    public function update(Request $request, string $slug)
    {   
        try {
            // $imagePath = null;
            // if ($request->hasFile('image')) {
            //     $imagePath = $request->file('image')->store('images', 'public');
            // }

            // Buat akun baru
            $sellingAccount = SellingAccount::whereSlug($slug)->first()->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'rank' => $request->rank,
                'total_heroes' => $request->totalHero,
                'total_skin' => $request->totalSkin,
                'discount' => $request->discount,
            ]);

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $sellingAccount,
                'message' => 'Berhasil Mengedit Akun Jubel'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "code" => "ACSO-003",
                'success' => false,
                'message' => 'Gagal Mengedit Akun Jubel',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $data = SellingAccount::find($id);
        $data->delete();

        return response()->json([
            "code" => "ACSO-001",
            'success' => true,
            'data' => $data,
            'message' => 'Berhasil Menghapus Akun Jubel'
        ], 201);
    }
}
