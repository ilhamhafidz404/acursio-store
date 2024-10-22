<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class _UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $image1Path = null;
            if ($request->hasFile('image1')) {
                $image1Path = $request->file('image1')->store('images', 'public');
            }
            
            $image2Path = "";
            if ($request->hasFile('image2')) {
                $image2Path = $request->file('image2')->store('images', 'public');
            }

            return response()->json([
                "code" => "ACSO-001",
                'success' => true,
                'data' => [
                    "image1" => $image1Path,
                    "image2" => $image2Path,
                ],
                'message' => 'Berhasil Upload Image'
            ], 201);
        } catch (Exception $e) {
            Log::error('Transaction update failed: ' . $e->getMessage());

            // Return error response
            return response()->json([
                "code" => "ACSO-003",
                "success" => false,
                "message" => "Gagal Upload Image",
                "result" => [],
            ], 500);
        }
    }
}
