@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать пользователя</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control">
            <small class="form-text text-muted">Оставьте поле пустым, если не хотите изменять пароль.</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Роль</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
                <option value="librarian" {{ $user->role == 'librarian' ? 'selected' : '' }}>Библиотекарь</option>
                <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Клиент</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>
@endsection
