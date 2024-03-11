<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Http\Requests\productsRequest;
use Illuminate\Support\Facades\DB;

class productsController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new products();
        $products = $model->getList();

        return view('list', ['products' => $products]);
    }
    public function showRegistForm() {
        return view('regist');
    }
    public function registSubmit(productsRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new products();
            $model->registproduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト
        return redirect(route('regist'));
    }
}