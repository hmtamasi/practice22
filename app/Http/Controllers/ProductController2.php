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
        return view('list', ['products' => $products,'companies' => $companies]);
        }

        public function show(Request $request)
        {
            //フォームを機能させるために各情報を取得し、viewに返す
            $company = new Company();
            $companies = $company->getList();
            $search = $request->input('search');
            $companyId = $request->input('companyId');
            return view('searchproduct', [
                'companies' => $companies,
                'searchWord' => $search,
                'companyId' => $companyId
            ]);
        }    
        public function search(Request $request)
        {
            //入力される値nameの中身を定義する
            $search = $request->input('search'); //商品名の値
            $companyId = $request->input('companyId'); //カテゴリの値
    
            $query = Product::query();
            //商品名が入力された場合、m_productsテーブルから一致する商品を$queryに代入
            if (isset($search)) {
                $query->where('product_name', 'like', '%' . self::escapeLike($search) . '%');
            }
            //カテゴリが選択された場合、m_categoriesテーブルからcategory_idが一致する商品を$queryに代入
            if (isset($companyId)) {
                $query->where('company_id', $companyId);
            }
    
            //$queryをcategory_idの昇順に並び替えて$productsに代入
            $products = $query->orderBy('company_id', 'asc')->paginate(15);
    
            //campanyテーブルからgetList();関数でcategory_nameとidを取得する
            $company = new Company;
            $companies = $company->getList();
    
            return view('searchproduct', [
                'products' => $products,
                'companies' => $companies,
                'search' => $search,
                'companyId' => $companyId
            ]);
        }
        public static function escapeLike($str)
        {
            return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
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

