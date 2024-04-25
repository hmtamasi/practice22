<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public function getProducts() {
        $products = DB::table('products')->get();
        return $products;
    }
    // ① LaravelのEloquent ORMを使用してデータベースから製品データを取得するためのメソッドの例
    // ② productsテーブルからデータを取得
    // →DBファサードのtableメソッドを使用してproductsテーブルに対するクエリを開始し、getメソッドを使用してクエリの結果を取得

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'img_path',
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment'
    ];
    // $tableプロパティを使用してテーブル名を指定する
    // テーブルに関連付ける主キー
    // 登録・更新可能なカラムの指定


    public function registproduct($products, $path) {
        DB::table('products')->insert([
            'img_path' => $path,
            'product_name' => $products->product_name,
            'price' => $products->price,
            'stock' => $products->stock,
            'company_id' => $products->company_id,
            'comment' => $products->comment
        ]);
    // ① ($products, $path)〜$productsは製品情報を含む変数であり、$pathはファイルの保存先やアクセスするためのパスを指している
    // ② productsテーブルに新しいレコードを挿入するためのコードスニペット
    // →insert()メソッド〜配列のキーと値のペアを受け取り、キーがテーブルのカラムを、値がそれらのカラムに挿入される値を表す
    // →['name' => 'Product 1', 'price' => 100],
    //  ['name' => 'Product 2', 'price' => 200] ['キー' => '値', 'キー' => 値]
    // ③ 画像の場合は、値の部分を$pathとした
    // →'img_path' => $products->img_path,これだと画像表示はされなかった
    // →Laravelでは、画像やその他のファイルは通常、public ディレクトリ内に保存されます。
    //  これにより、ブラウザから直接アクセスできるようになります。
    //  しかし、storageディレクトリ内に画像を保存する場合は、php artisan storage:link コマンドを実行して、
    //  publicディレクトリにシンボリックリンクを作成する必要があります。
    //  これにより、storage ディレクトリ内のファイルにもブラウザからアクセスできるようになります。
    // →$path は画像ファイルへのパスを表します。このパスは、public ディレクトリからの相対パスである必要があります。
    }

    public function updateproduct($product, $path) {
        DB::table('products')->where('id', $product->id)->update([
            'img_path' => $path,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'stock' => $product->stock,
            'company_id' => $product->company_id,
            'comment' => $product->comment
        ]);
    // ① ($products, $path)〜$productsは製品情報を含む変数であり、$pathはファイルの保存先やアクセスするためのパスを指している
    // ② productsテーブルにある特定のレコード情報を更新する（$product->idで指定されたIDを持つ製品）
    // ③ 画像の場合は、値の部分を$pathとした
    // →'img_path' => $products->img_path,これだと画像表示はされなかった
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    // Productモデルがsalesテーブルとリレーション関係を結ぶ為のメソッドです（１対多）

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    // Productモデルがcompanysテーブルとリレーション関係を結ぶ為のメソッドです（多対１）

}