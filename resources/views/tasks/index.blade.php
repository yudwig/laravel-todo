@extends('app')

@section('content')
    <a href="{{ route('categories.showEdit', ['id' => 1]) }}">カテゴリ1</a>
    <hr class="border-t-1 border-gray-400 my-3">
    <table class="mb-10">
        <colgroup class="w-96"></colgroup>
        <tr>
            <td>
                <a href="{{ route('tasks.showEdit', ['id' => 1]) }}">タスク1</a>
            </td>
            <td>
                <form method="post" action="{{ route('tasks.update', ['id' => 1]) }}">
                    @csrf
                    <input type="hidden" name="completed" value="1">
                    <a href="javascript:void(0);" onclick="this.closest('form').submit();">完了</a>
                </form>
            </td>
        </tr>
        <tr>
            <td><a>タスク2</a></td>
            <td><a>完了</a></td>
        </tr>
        <tr>
            <td><a class="line-through">タスク3</a></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="{{ route('tasks.showCreate', ['id' => 1]) }}">追加</a></td>
        </tr>
    </table>
    <a href="{{ route('categories.showCreate') }}">追加</a>
@endsection
