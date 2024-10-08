<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_accounts', function (Blueprint $table) {
            $table->id();
            $table->string("invoice", 19)->unique(); 
            $table->string("user_email"); 
            $table->string("user_phone"); 
            $table->foreignId("selling_account_id")
                  ->constrained('selling_accounts') 
                  ->onDelete('cascade'); 
            $table->integer("pay");
            $table->enum("status", ["pending", "success", "failed"])->default("pending"); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_accounts');
    }
};
