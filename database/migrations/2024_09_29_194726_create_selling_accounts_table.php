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
        Schema::create('selling_accounts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->integer("price");
            $table->string("image1");
            $table->string("image2")->nullable();
            $table->text("description");
            $table->enum("status", ["available", "sold out", "in order"])->default("available");
            $table->string("rank");
            $table->integer("total_heroes")->nullable();
            $table->integer("total_skin")->nullable();
            $table->integer("discount")->nullable();
            $table->text("email_account");
            $table->text("password_account");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_accounts');
    }
};
