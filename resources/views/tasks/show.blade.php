@extends('layouts.app')

@section('title', 'جزئیات وظیفه')

@section('content')
    <p><strong>شناسه:</strong> {{ $task->id }}</p>
    <p><strong>عنوان:</strong> {{ $task->title }}</p>
    <p><strong>توضیحات:</strong> {{ $task->description }}</p>
    <p><strong>وضعیت:</strong> {{ $task->is_completed ? 'انجام شده' : 'انجام نشده' }}</p>
    <br>
    
    <a href="{{ route('tasks.index') }}" class="btn btn-primary">بازگشت به لیست</a>
@endsection