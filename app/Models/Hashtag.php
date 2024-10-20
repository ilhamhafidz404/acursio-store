<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $guarded= ["id"];

    public function sellingAccounts()
    {
        return $this->belongsToMany(SellingAccount::class, 'hashtag_selling_account');
    }
}
