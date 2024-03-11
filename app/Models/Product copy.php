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
    
    public function getList() {
        return $this->getProducts();
    }
    
    public function getCreate() {
        return $this->getProducts();
    }
    
    public function getEdit() {
        return $this->getProducts();
    }
    
    public function getShow() {
        return $this->getProducts();
    }

    public function registproduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'id' => $data->id,
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'maker' => $data->maker,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
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