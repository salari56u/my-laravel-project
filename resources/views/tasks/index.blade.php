@extends('layouts.app')

@section('title', 'لیست وظایف')

@section('content')
    <a href="{{ route('tasks.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">ایجاد وظیفه جدید</a>

    <table>
        <thead>
            <tr>
                <th>شناسه</th>
                {{-- ۲. ستون‌ها عوض شدند --}}
                <th>عنوان وظیفه</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->is_completed ? 'انجام شده' : 'انجام نشده' }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">نمایش</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary">ویرایش</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">هیچ وظیفه‌ای یافت نشد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection