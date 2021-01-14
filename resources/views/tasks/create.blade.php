@extends('app')

@section('content')
    <h2 class="text-2xl">新規タスク</h2>
    <form name="createForm" method="post" action="{{ url()->current() }}">
        @csrf
        <label>
            <input type="text" name="title" class="border my-5 p-2 w-80">
        </label>
    </form>
    <a href="javascript:void(0);" onclick="document.createForm.submit();">作成</a>
@endsection
