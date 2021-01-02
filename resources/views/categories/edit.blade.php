@extends('app')

@section('content')
    <h2 class="text-2xl">カテゴリ編集</h2>
    <form name="updateForm" method="post" action="{{ route('categories.update', ['id' => 1]) }}">
        @csrf
        <label>
            <input type="text" name="title" class="border my-5 p-1 w-80">
        </label>
    </form>
    <form name="deleteForm" method="post" action="{{ route('categories.delete', ['id' => 1]) }}">
        @csrf
    </form>
    <div class="flex justify-center">
        <a href="javascript:void(0);" onclick="document.updateForm.submit();">更新</a>
        <a href="javascript:void(0);" onclick="document.deleteForm.submit();">削除</a>
    </div>
@endsection
