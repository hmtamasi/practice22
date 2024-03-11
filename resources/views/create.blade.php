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
            <select class="form-select" id="company_name" name="company_name">
            @foreach ($companies as $company)
                <option value="{{ $company->company_name }}" {{ $company->company_name == $company->company_name ? 'selected' : '' }}>{{ $company->company_name }}</option>
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
        <button type="submit" onClick="history.forward()">新規登録</button>
        <button type="submit" class="btn btn-success">
                {{ __('登録') }}
        </button>
        <button type="button" onClick="history.back()">戻る</button>
        </div>
    </form>

</div>
@endsection

