@extends('app')

@section('content')
    <h2 class="text-2xl">新規カテゴリ</h2>
    <form name="createForm" method="post" action="{{ route('categories.create') }}">
        @csrf
        <label>
            <input type="text" name="title" class="border my-5 p-2 w-80">
        </label>
    </form>
    <div>
        <a href="javascript:void(0);" onclick="document.createForm.submit();">作成</a>
    </div>
@endsection
