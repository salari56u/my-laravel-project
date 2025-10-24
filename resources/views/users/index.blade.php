@extends('layouts.app')

@section('title', 'لیست کاربران')

@section('content')
    <a href="{{ route('users.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">ایجاد کاربر جدید</a>

    <table>
        <thead>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        <a href="{{ route('users.show', $user['id']) }}" class="btn btn-info">نمایش</a>
                        <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-secondary">ویرایش</a>
                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">هیچ کاربری یافت نشد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection