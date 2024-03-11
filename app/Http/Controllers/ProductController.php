<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Productモデルを現在のファイルで使用できるようにするための宣言です。
use App\Models\Company; // Companyモデルを現在のファイルで使用できるようにするための宣言です。
use App\Http\Requests\productsRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function showList(){
        // インスタンス生成
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        return view('list', ['products' => $products,'companies' => $companies]);
        }
        public function showCreate(){
        // インスタンス生成
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        return view('create', ['products' => $products,'companies' => $companies]);
        }
        public function showShow($id) {
        // インスタンス生成
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        $productFind = Product::find($id);
        return view('show', compact('productFind'));
        }
        public function showEdit($id) {
        // インスタンス生成
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        $productFind = Product::find($id);
        return view('edit', compact('productFind'));
        }
        public function store(Request $request, Product $product)
        {
        $registProductModel = new Product();
        $registproducts = $registProductModel->registproduct($request,$product);
        return redirect()->route('list', compact('requestproducts'));
        }

    public function update(Request $request, Product $product)
    {
        // リクエストされた情報を確認して、必要な情報が全て揃っているかチェックします。
        $request->validate([
                'product_name' => 'required',
                'price' => 'required',
                'stock' => 'required',
        ]);
        //バリデーションによりフォームに未入力項目があればエラーメッセー発生させる（未入力です　など）
    
        // 商品の情報を更新します。
        $product->product_name = $request->product_name;
        //productモデルのproduct_nameをフォームから送られたproduct_nameの値に書き換える
        $product->price = $request->price;
        $product->stock = $request->stock;
    
        // 更新した商品を保存します。
        $product->save();
        // モデルインスタンスである$productに対して行われた変更をデータベースに保存するためのメソッド（機能）です。
    
        // 全ての処理が終わったら、商品一覧画面に戻ります。
        return redirect()->route('list')
        ->with('success', 'Product updated successfully');
        // ビュー画面にメッセージを代入した変数(success)を送ります
    }
    public function destroy($id)
    //(Product $product) 指定されたIDで商品をデータベースから自動的に検索し、その結果を $product に割り当てます。
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $product = Product::find($id);
        // レコードを削除
        $product->delete();
    
        // 全ての処理が終わったら、商品一覧画面に戻ります。
        return redirect('list');
        //URLの/productsを検索します
        //products　/がなくても検索できます
    }
}

