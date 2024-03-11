<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    public function getProducts() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();
        return $products;
    }


    public function registproduct($request,$product) {
        // 登録処理
        DB::table('products')->insert([
            'id' => $product->id,
            'img_path' => $product->img_path,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'stock' => $product->stock,
            'comment' => $product->comment
        ]);
    }

    // Productモデルがsalesテーブルとリレーション関係を結ぶ為のメソッドです
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Productモデルがcompanysテーブルとリレーション関係を結ぶ為のメソッドです
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}