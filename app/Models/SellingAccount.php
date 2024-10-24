<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SellingAccount extends Model
{
    use HasFactory;

    // Mutator untuk mengenkripsi data sebelum disimpan
    public function setEmailAccountAttribute($value)
    {
        $this->attributes['email_account'] = Crypt::encryptString($value);
    }
    
    public function setPasswordAccountAttribute($value)
    {
        $this->attributes['password_account'] = Crypt::encryptString($value);
    }

    // // Accessor untuk mendekripsi data saat diambil
    // public function getEmailAccountAttribute($value) {
    //     return $value ? Crypt::decryptString($value) : null;
    // }
    // public function getPasswordAccountAttribute($value) {
    //     return $value ? Crypt::decryptString($value) : null;
    // }

    public function skins()
    {
        return $this->belongsToMany(Skin::class, 'selling_account_skin');
    }
    

    protected $guarded = ["id"];
}
