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
            $hashtag = request('hashtag');
            $isFullEmblem = request('isFullEmblem');

            $query = SellingAccount::query();

            $query->with('hashtags'); 

            if ($minPrice) {
                $query->where('price', '>=', $minPrice);
            }

            if ($maxPrice) {
                $query->where('price', '<=', $maxPrice);
            }

            if ($condition == "2") {
                $query->where('discount', '>', 0);
            }

            if ($hashtag) {
                $query->whereHas('hashtags', function ($query) use ($hashtag) {
                    $query->where('slug', $hashtag);
                });
            }
            
            if ($isFullEmblem) {
                $query->where("is_full_emblem", 1);
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
            'image1' => 'required|string',
            'image2' => 'nullable',
            'rank' => 'required|string|max:255',
            'accountEmail' => 'required|string',
            'accountPassword' => 'required|string',
        ]);

        try {
            // Buat akun baru
            $sellingAccount = SellingAccount::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'price' => $request->price,
                'description' => $request->description,
                'image1' => $request->image1,
                'image2' => $request->image2,
                'rank' => $request->rank,
                'total_heroes' => $request->totalHero,
                'total_skin' => $request->totalSkin,
                'discount' => $request->discount,
                'email_account' => $request->accountEmail,
                'password_account' => $request->accountPassword,
                "is_full_emblem" => $request->isFullEmblem,
            ]);

            $hashtags = collect($request->hashtags)->pluck('value');
            $sellingAccount->hashtags()->attach($hashtags);

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
        $sellingAccount = SellingAccount::with("hashtags")->whereId($id)->orWhere("slug", $id)->first();    

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

            // Get Selling account
            $sellingAccount = SellingAccount::whereSlug($slug)->first();
            
            // Update akun baru
            $sellingAccount->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'rank' => $request->rank,
                'total_heroes' => $request->totalHero,
                'total_skin' => $request->totalSkin,
                'discount' => $request->discount,
                "is_full_emblem" => $request->isFullEmblem,
            ]);

            // attach hashtags
            $hashtags = collect($request->hashtags)->pluck('value');
            $sellingAccount->hashtags()->detach();
            $sellingAccount->hashtags()->attach($hashtags);

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $sellingAccount,
                'message' => 'Berhasil Mengedit Akun Jubel'
            ], 200);

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
        try {
            $data = SellingAccount::find($id);
            
            if (!$data) {
                return response()->json([
                    "code" => "ACSO-002",
                    "success" => false,
                    "message" => "Akun Jubel tidak ditemukan"
                ], 404);
            }

            $data->delete();

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => $data,
                'message' => 'Berhasil Menghapus Akun Jubel'
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
