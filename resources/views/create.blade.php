@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品新規登録</h1>

    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="product_name" class="form-label">商品名:</label>
                <input id="product_name" type="text" name="product_name" class="form-control" required placeholder="商品名を入力してください">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">メーカー</label>
                <select class="form-select" id="company_name" name="company_id" required>
                    <option value="">メーカー名</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('company_name'))
                    <p>{{ $errors->first('company_name') }}</p>
                @endif
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">価格:</label>
                <input id="price" type="text" name="price" class="form-control" required>
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数:</label>
                <input id="stock" type="text" name="stock" class="form-control" required>
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">コメント:</label>
                <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像:</label>
                <input id="img_path" type="file" name="img_path" class="form-control">
        </div>
        <div class="button">
            <button type="submit" class="btn btn-success">
                {{ __('登録') }}
            </button>
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </form>

    <!-- 
        ① 登録フォーム（formタグ）
            →action属性〜route()ヘルパー関数を使用して動的に生成されています。このヘルパー関数は、storeという名前のルートのURLを生成する
            →method="POST"属性〜フォームデータがHTTP POSTメソッドを使用して送信されることを指定します
            →buttonタグ〜フォームデータが指定されたURLにPOSTメソッドで送信される
                →submit（登録ボタン）
                →button　onClick="history.back()"（戻るボタン）
        ② 各項目の入力欄（inputタグ）（textareaタグ）〜
            →id属性〜HTML的な属性。inputタグが、打ち込んだ内容を保持する時に、どのフォームかの識別をする時に指定する。
            →name属性〜PHP的な属性。Requestファサードに格納される時の連想配列のキー名。
            →type属性〜text：一行テキストボックスを作成する（初期値）
                      file：ユーザーがファイルを選択し、フォーム投稿を使用してサーバーにアップロード
        ③ メーカーのセレクト（selectタグ）
            →それぞれのメニューの選択肢は、 <select> の中の <option> 要素で定義されます
            →value属性〜選択肢が選択されたときにサーバーに送信するデータの値を含む
            →@foreach〜Laravel Bladeテンプレート内でコレクションの各要素を反復処理し、それらを表示する方法
                →$companiesというコレクションをループして、各メーカーの情報を表示する
    -->

</div>
@endsection

