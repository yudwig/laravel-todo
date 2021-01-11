@extends('app')

@section('content')
    @foreach ($categories as $category)
        <a href="{{ route('categories.showEdit', ['id' => $category->id]) }}">{{ $category->title }}</a>
        <hr class="border-t-1 border-gray-400 my-3">
        <table class="mb-10">
            <colgroup class="w-96"></colgroup>
            @foreach ($category->task as $task)
                <tr>
                    <td>
                        <a href="{{ route('tasks.showEdit', ['id' => $task->id]) }}" @if ($task->completed) class="line-through" @endif>
                            {{ $task->title }}
                        </a>
                    </td>
                    <td>
                        @if (!$task->completed)
                            <form method="post" action="{{ route('tasks.update', ['id' => $task->id]) }}">
                                @csrf
                                <input type="hidden" name="completed" value="1">
                                <a href="javascript:void(0);" onclick="this.closest('form').submit();">完了</a>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td><a href="{{ route('tasks.showCreate', ['id' => $category->id]) }}">追加</a></td>
            </tr>
        </table>
    @endforeach
    <a href="{{ route('categories.showCreate') }}">追加</a>
@endsection

