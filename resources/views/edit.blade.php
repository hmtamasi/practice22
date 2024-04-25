@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>商品情報を変更する</h2></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update', $productFind->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <dt class="col-sm-3">商品情報ID</dt>
                            <dd class="col-sm-9">{{ $productFind->id }}</dd>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">商品名</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $productFind->product_name }}" required>
                            </div>
                                <label for="company_name" class="form-label">メーカー</label>
                                    <select class="form-select" id="company_name" name="company_id" required>
                                        <option value="">メーカー名</option>
                                            <option value="{{ $productFind->company->id }}" {{ $productFind->company->id == $productFind->company->id ? 'selected' : '' }}>{{ $productFind->company->company_name }}</option>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">価格</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $productFind->price }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">在庫数</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $productFind->stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">コメント</label>
                                    <textarea id="comment" name="comment" class="form-control" rows="3">{{ $productFind->comment }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="img_path" class="form-label">商品画像:</label>
                                    <input id="img_path" type="file" name="img_path" class="form-control">
                                    <img src="{{ asset($productFind->img_path) }}" alt="商品画像" class="product-image">
                            </div>
                            <button type="submit" class="btn btn-success">変更内容で更新する</button>
                            <button type="button" onClick="history.back()">戻る</button>
                        </form>

                        <!--  
                        ① 編集フォーム（formタグ）
                            →action属性〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、updateという名前のルートのURLを生成する
                            →method="POST"属性〜フォームデータがHTTP POSTメソッドを使用して送信されることを指定します
                            →buttonタグ〜フォームデータが指定されたURLにPOSTメソッドで送信される
                                →submit（更新ボタン）
                                →button　onClick="history.back()"（戻るボタン）
                        ② 各項目の入力欄（inputタグ）（textareaタグ）〜
                            →id属性〜HTML的な属性。inputタグが、打ち込んだ内容を保持する時に、どのフォームかの識別をする時に指定する。
                            →name属性〜PHP的な属性。Requestファサードに格納される時の連想配列のキー名。
                            →type属性〜text：一行テキストボックスを作成する（初期値）
                                      file：ユーザーがファイルを選択し、フォーム投稿を使用してサーバーにアップロード
                            →value属性〜データが入力された際に、サーバーに送信するデータの値を含む
                        ③ メーカーのセレクト（selectタグ）
                            →それぞれのメニューの選択肢は、 <select> の中の <option> 要素で定義されます
                            →value属性〜選択肢が選択されたときにサーバーに送信するデータの値を含む
                            →@foreach〜Laravel Bladeテンプレート内でコレクションの各要素を反復処理し、それらを表示する方法
                                →$companiesというコレクションをループして、各メーカーの情報を表示する
                        -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

