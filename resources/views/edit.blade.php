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
                                <select class="form-select" id="company_name" name="company_id">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

