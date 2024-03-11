<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sale extends Model
{

    public function getList() {
        // productsテーブルからデータを取得
        $sales = DB::table('sales')->get();

        return $sales;
    }

    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}