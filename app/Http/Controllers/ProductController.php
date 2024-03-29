<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Productモデルを現在のファイルで使用できるようにするための宣言です。
use App\Models\Company; // Companyモデルを現在のファイルで使用できるようにするための宣言です。
use App\Http\Requests\productsRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function showList(Request $request){
        // インスタンス生成
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        $productSearch = $request->input('search');
        $companySearch = $request->input('company_id');
    // Productモデルに基づいてクエリビルダを初期化
    $query = Product::query();
    // この行の後にクエリを逐次構築していきます。
    // そして、最終的にそのクエリを実行するためのメソッド（例：get(), first(), paginate() など）を呼び出すことで、データベースに対してクエリを実行します。
    // 商品名の検索キーワードがある場合、そのキーワードを含む商品をクエリに追加
    if(!empty($productSearch)){//$search　が空ではない場合、検索処理を実行します
        $query->where('product_name', 'LIKE', "%{$productSearch}%");}  
    if(!empty($companySearch)){//$search　が空ではない場合、検索処理を実行します
        $query->where('company_id', '=', $companySearch);}    
    $products = $query->get();
    return view('list', compact('products', 'companies', 'productSearch','companySearch'));
}
        
        public function showCreate(Product $products){
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
        public function store(Request $request)
        {
        $registProductModel = new Product();
        $registproducts = $registProductModel->registproduct($request);
        return redirect()->route('list', compact('registproducts'));
        }

        public function update(Request $request,Product $product,$id)
        {

        $updateProductModel = Product::find($id);
        $updateproducts = $updateProductModel->updateproduct($request,);
        return redirect()->route('list', compact('updateproducts'));
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

