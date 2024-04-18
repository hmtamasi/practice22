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
        $productModel = new Product();
        $products = $productModel->getProducts();
        $companyModel = new Company();
        $companies = $companyModel->getCompanies();
        $productSearch = $request->input('search');
        $companySearch = $request->input('company_id');
        $query = Product::query();
        if(!empty($productSearch)){//$search　が空ではない場合、検索処理を実行します
        $query->where('product_name', 'LIKE', "%{$productSearch}%");}  
        if(!empty($companySearch)){//$search　が空ではない場合、検索処理を実行します
        $query->where('company_id', '=', $companySearch);}    
        $products = $query->get();
        return view('list', compact('products', 'companies', 'productSearch','companySearch'));
        // ① (Request $request,Product $product,$id)
        // ② ProductテーブルとCompanyテーブルから全てのレコードを取得
        // ③ インスタンスと、モデルにあるgetProductsメソッドとgetCompaniesメソッドを紐付ける
        
        // ⑤ Productモデルに基づいてクエリビルダを初期化
        // ⑥ この行の後にクエリを逐次構築していきます。そして、最終的にそのクエリを実行するためのメソッド
        // →（例：get(), first(), paginate() など）を呼び出すことで、データベースに対してクエリを実行します。
        // →商品名の検索キーワードがある場合、そのキーワードを含む商品をクエリに追加
        // ⑦ 全ての処理が終わったら、商品一覧画面に戻ります。
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
        DB::beginTransaction();
        try {
            // 登録処理呼び出し
            $model = new Product();
            $dir = 'img';
            $img = $request->file('img_path');
            $path = $img->store($dir,'public');
            $model->registProduct($request, $path);
            DB::commit();
            } catch (\Exception $e) {
            DB::rollback();
            return back();
            }
        return redirect()->route('list');
        // ① データベーストランザクションの開始
        // ② Productモデルのインスタンスを作成
        // ③ 画像を保存するディレクトリ名を指定
        // ④リクエストから画像ファイルを取得　
        // ⑤ 画像を指定したディレクトリに保存し、パスを取得
        // ⑥ ProductモデルのregistProductメソッドを呼び出し、リクエストと画像パスを引数に渡す
        // ⑦ トランザクションをコミット（成功した場合）トランザクションをロールバック（エラーが発生した場合） 前のページに戻る
        // ⑧ 全ての処理が終わったら、商品一覧画面に戻ります。
        //$registProductModel = new Product();
        //$registproducts = $registProductModel->registproduct($request);
        //return redirect()->route('list', compact('registproducts'));
        // ① (Request $request)
        // ② Productテーブルから全てのレコードを取得
        // ③ インスタンスと、モデルにあるregistproductメソッドと紐付ける
        // ④ 全ての処理が終わったら、商品一覧画面に戻ります。
        }

    public function update(Request $request,Product $product,$id)
        {
        DB::beginTransaction();
        try {
            $model = Product::find($id); // 更新したい製品を検索
            if ($request->hasFile('img_path')) { // 画像が更新された場合
                $dir = 'img';
                $img = $request->file('img_path');
                $path = $img->store($dir, 'public');
                $model->img_path = $path; // 画像パスを更新
            }
            // その他のフィールドを更新
            $model->product_name = $request->input('product_name');
            $model->price = $request->input('price');
            $model->stock = $request->input('stock');
            $model->company_id = $request->input('company_id');
            $model->comment = $request->input('comment');
            // その他のフィールドをここに追加
            $model->save(); // モデルを保存
            DB::commit();
            } catch (\Exception $e) {
            DB::rollback();
            return back();
            }
        return redirect()->route('list');
        //DB::beginTransaction();
        //try {
            // 更新処理呼び出し
        //    $model = Product::find($id);
        //    $dir = 'img';
        //    $img = $request->file('img_path');
        //    $path = $img->update($dir,'public');
        //    $model->updateproduct($request, $path);
        //    DB::commit();
        //    } catch (\Exception $e) {
        //    DB::rollback();
        //    return back();
        //    }
        //return redirect()->route('list');
        //$updateProductModel = Product::find($id);
        //$updateproducts = $updateProductModel->updateproduct($request);
        //return redirect()->route('list', compact('updateproducts'));
        // ① (Request $request,Product $product,$id)
        // ② Productテーブルから指定のIDのレコード1件を取得
        // ③ インスタンスと、モデルにあるupdateproductメソッドと紐付ける
        // ④ 全ての処理が終わったら、商品一覧画面に戻ります。           
        }   

    public function destroy($id)
        {
        DB::beginTransaction();
        try {
            // 削除処理呼び出し
            $model = Product::find($id);
            $model->delete();
            DB::commit();
            } catch (\Exception $e) {
            DB::rollback();
            return back();
            }
        return redirect()->route('list');
        //$product = Product::find($id);
        //$product->delete();
        //return redirect('list');
        // ① ($id) 指定されたIDで商品をデータベースから自動的に検索し、その結果を $product に割り当てます。
        // ② Productテーブルから指定のIDのレコード1件を取得　
        // ③ レコードを削除
        // ④ 全ての処理が終わったら、商品一覧画面に戻ります。
        // ⑤ URLの/productsを検索します
        // ⑥ products　/がなくても検索できます
        }
    }

    