@extends('layouts.app')

@section('title', isset($user) ? 'ویرایش کاربر' : 'ایجاد کاربر جدید')

@section('content')
    <form action="{{ isset($user) ? route('users.update', $user['id']) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif

        <div>
            <label for="name">نام:</label>
            <input type="text" id="name" name="name" value="{{ $user['name'] ?? '' }}" required>
        </div>
        <br>
        <div>
            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" value="{{ $user['email'] ?? '' }}" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'به‌روزرسانی' : 'ذخیره' }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">انصراف</a>
    </form>
@endsection