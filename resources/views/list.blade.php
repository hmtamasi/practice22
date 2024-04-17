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
  </table>
</div>    
@endsection