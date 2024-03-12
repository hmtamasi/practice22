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
  <table>
        <form action="/search" method="get">
            <input type="text" name="query" placeholder="キーワードを入力">
            <div class="mb-3">
            <label for="company_name" class="form-label">メーカー</label>
            <select class="form-select" id="company_name" name="company_name">
            @foreach ($companies as $company)
                <option value="{{ $company->company_name }}" {{ $company->company_name == $company->company_name ? 'selected' : '' }}>{{ $company->company_name }}</option>
            @endforeach
            </select>
            </div>
        <button type="submit" class="btn btn-primary">検索</button>
        </form>

     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <a href="{{ route('create') }}">本の登録へ</a>
        </tr>
    </thead>

    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->img_path }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
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