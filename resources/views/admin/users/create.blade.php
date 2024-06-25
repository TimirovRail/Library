@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить пользователя</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Роль</label>
            <select name="role" class="form-control" required>
                <option value="admin">Администратор</option>
                <option value="librarian">Библиотекарь</option>
                <option value="client">Клиент</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
</div>
@endsection
