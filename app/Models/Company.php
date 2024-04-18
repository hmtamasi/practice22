<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{

    public function getCompanies() {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();
        return $companies;
    }
    

    use HasFactory;

    public function products()
    {
    return $this->hasMany(Product::class);
    }

}

