<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{

    public function getCompanies() {
        $companies = DB::table('companies')->get();
        return $companies;
    }
    // ① LaravelのEloquent ORMを使用してデータベースから製品データを取得するためのメソッドの例
    // ② companiesテーブルからデータを取得
    // →DBファサードのtableメソッドを使用してcompaniesテーブルに対するクエリを開始し、getメソッドを使用してクエリの結果を取得


    use HasFactory;

    public function products()
    {
    return $this->hasMany(Product::class);
    }
    // Productモデルがsalesテーブルとリレーション関係を結ぶ為のメソッドです（１対多）
}

