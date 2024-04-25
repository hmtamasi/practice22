@extends('layouts.app')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

<div class="links">
<h1 class="mb-4">商品一覧画面</h1>
  <table>
     <div class="search mt-5">
        <form action="{{ route('list') }}" method="GET" class="row g-3">
            <div class="col-sm-12 col-md-3">
                <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">メーカー</label>
                    <select class="form-select" id="company_name" name="company_id">
                        <option value="">メーカー名</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-sm-12 col-md-1">
                <button class="btn btn-outline-secondary" type="submit">検索</button>
            </div>
        </form>
     </div>
    <!-- 
        ① 検索フォーム（formタグ）
            →action属性〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、listという名前のルートのURLを生成する
            →method="GET"属性〜フォームデータがHTTP GETメソッドを使用して送信されることを指定する
            →buttonタグ〜フォームデータが指定されたURLにGETメソッドで送信される→submit（検索ボタン）
        ② 検索キーワードの入力欄（inputタグ）〜
            →id属性〜HTML的な属性。inputタグが、打ち込んだ内容を保持する時に、どのフォームかの識別をする時に指定する。
            →name属性〜PHP的な属性。Requestファサードに格納される時の連想配列のキー名。
            →type属性〜text：一行テキストボックスを作成する（初期値）
            →value属性〜データが入力された際に、サーバーに送信するデータの値を含む
            →placeholder属性〜空のときに、薄い灰色の時で文字を置く
        ③ メーカーのセレクト（selectタグ）
            →それぞれのメニューの選択肢は、 <select> の中の <option> 要素で定義されます
            →value属性〜選択肢が選択されたときにサーバーに送信するデータの値を含む
            →@foreach〜Laravel Bladeテンプレート内でコレクションの各要素を反復処理し、それらを表示する方法
                →$companiesというコレクションをループして、各メーカーの情報を表示する
    -->

     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <a href="{{ route('create') }}">新規登録</a>
        </tr>
    </thead>
    <!-- 
        ① thead〜見出しを入れるところを設ける（カラムのこと）
        ② 新規登録へ遷移〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、createという名前のルートのURLを生成する
    -->
    
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td classz="table-img">
                <img src="{{ asset('storage/'.$product->img_path) }}" width="30" >
            </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td><a href="{{ route('show',['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
            <td>
                <form action="{{ route('destroy', ['id'=>$product->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </td>        
        </tr>
    @endforeach
    </tbody>
    <!-- 
        ① tbody〜データを入れるところを設ける（値のこと）
        ② @foreach〜Laravel Bladeテンプレート内でコレクションの各要素を反復処理し、それらを表示する方法
            →productsというコレクションをループして、各企業の情報を表示する
        ③ $product〜ProductモデルのgetProductsメソッドにて、productsテーブルからデータを取得
            →ID、商品画像、商品名、価格、在庫数、メーカー名
        ④ assetヘルパ関数〜storageディレクトリに保存された画像を表示するには、assetヘルパ関数を使用
            →商品画像
        ⑤ $product->company〜Productモデルにて、companiesテーブルと紐付けたため使えるもの
            →メーカー名
        ⑥ 詳細へ遷移〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、showという名前のルートのURLを生成する
            →id〜showルートにidパラメータを渡しています
        ⑦ 削除フォーム（formタグ）
            →action属性〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、destroyという名前のルートのURLを生成する
            →method="POST"属性〜フォームデータがHTTP POSTメソッドを使用して送信されることを指定します
            →id〜destroyルートにidパラメータを渡しています
            →buttonタグ〜フォームデータが指定されたURLにPOSTメソッドで送信される→submit（削除ボタン）
    -->
  </table>
</div>    
@endsection