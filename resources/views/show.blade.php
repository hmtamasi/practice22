@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報詳細</h1>

    <dl class="row mt-3" >
        <dt class="col-sm-3">商品情報ID</dt>
        <dd class="col-sm-9">{{ $productFind->id }}</dd>

        <dt class="col-sm-3">商品名</dt>
        <dd class="col-sm-9">{{ $productFind->product_name }}</dd>

        <dt class="col-sm-3">メーカー</dt>
        <dd class="col-sm-9">{{ $productFind->company->company_name }}</dd>

        <dt class="col-sm-3">価格</dt>
        <dd class="col-sm-9">{{ $productFind->price }}</dd>

        <dt class="col-sm-3">在庫数</dt>
        <dd class="col-sm-9">{{ $productFind->stock }}</dd>

        <dt class="col-sm-3">コメント</dt>
        <dd class="col-sm-9">{{ $productFind->comment }}</dd>

        <dt class="col-sm-3">商品画像</dt>
        <dd class="col-sm-9"><img src="{{ asset($productFind->img_path) }}" width="300"></dd>

        <a href="{{ route('edit', $productFind->id) }}" class="btn btn-primary">編集</a>
        <button type="button" onClick="history.back()">戻る</button>
    </dl>

</div>
@endsection

