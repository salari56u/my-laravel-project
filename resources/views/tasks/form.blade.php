@extends('layouts.app')


@section('title', isset($task) ? 'ویرایش وظیفه' : 'ایجاد وظیفه جدید')

@section('content')
    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
        @csrf
        @if(isset($task))
            @method('PUT')
        @endif

        <div>
            <label for="title">عنوان:</label>

            <input type="text" id="title" name="title" value="{{ $task->title ?? '' }}" required>
        </div>
        <br>

        <div>
            <label for="description">توضیحات:</label>
            <textarea id="description" name="description" rows="4">{{ $task->description ?? '' }}</textarea>
        </div>
        <br>

        <div>
            <label for="is_completed">انجام شده:</label>
            <input type="checkbox" id="is_completed" name="is_completed" value="1"
                {{-- بررسی می‌کند که آیا تسک وجود دارد و 'is_completed' آن true است یا نه --}}
                {{ (isset($task) && $task->is_completed) ? 'checked' : '' }}>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">{{ isset($task) ? 'به‌روزرسانی' : 'ذخیره' }}</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">انصراف</a>
    </form>
@endsection