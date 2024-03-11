<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{

    public function getCompanies() {
        // productsテーブルからデータを取得
        $companies = DB::table('companies')->get();
        return $companies;
    }
    
    public function getList() {
        return $this->getCompanies();
    }
    
    public function getCreate() {
        return $this->getCompanies();
    }
    
    public function getEdit() {
        return $this->getCompanies();
    }
    
    public function getShow() {
        return $this->getCompanies();
    }
    
    public function registproduct($data) {
        // 登録処理
        DB::table('companies')->insert([
            'id' => $data->id,
            'company_name' => $data->company_name,
            'street_address' => $data->street_address,
            'representative_name' => $data->representative_name	,
            'maker' => $data->maker,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
        ]);
    }

    use HasFactory;

    public function products()
    {
    return $this->hasMany(Product::class);
    }

}

