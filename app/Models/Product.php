<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public function getProducts() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();
        return $products;
    }

    protected $table = 'products';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'img_path',
        'product_name',
        'price',
        'stock',
        'company_name',
        'comment'
    ];

    public function registproduct($products) {
        dd($products);
        // 登録処理
        DB::table('products')->insert([
            'img_path' => $products->img_path,
            'product_name' => $products->product_name,
            'price' => $products->price,
            'stock' => $products->stock,
            'company_name' => $products->company_name,
            'comment' => $products->comment
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