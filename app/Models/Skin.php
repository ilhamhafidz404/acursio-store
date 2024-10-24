<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory;

    protected $guarded= ["id"];

    public function sellingAccounts()
    {
        return $this->belongsToMany(SellingAccount::class, 'hashtag_selling_account');
    }
    
    public function skinCategory()
    {
        return $this->belongsTo(SkinCategory::class, 'skin_category_id');
    }
}
