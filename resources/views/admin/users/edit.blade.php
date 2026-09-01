@extends('layouts.admin')

@section('content')

<style>
    .form-card {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-card h1 {
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 7px;
        font-size: 15px;
    }

    input:focus {
        outline: none;
        border-color: #222;
    }

    .save-button {
        background: #222;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 16px;
        background: #e5e5e5;
        color: #222;
        text-decoration: none;
        border-radius: 7px;
    }

    .error-box {
        background: #ffe5e5;
        color: #b00020;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .password-info {
        display: block;
        margin-top: 6px;
        color: #777;
        font-size: 13px;
    }
</style>

<div class="form-card">

    <h1>Kullanıcı Düzenle</h1>

    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Kullanıcı Adı</label>

            <input
                type="text"
                name="username"
                value="{{ old('username', $user->username) }}"
            >
        </div>

        <div class="form-group">
            <label>Kullanıcı Ünvanı</label>

            <input
                type="text"
                name="user_title"
                value="{{ old('user_title', $user->user_title) }}"
            >
        </div>

        <div class="form-group">
            <label>Yeni Şifre</label>

            <input
                type="password"
                name="password"
            >

            <span class="password-info">
                Şifreyi değiştirmek istemiyorsanız boş bırakın.
            </span>
        </div>

        <button type="submit" class="save-button">
            Güncelle
        </button>

    </form>

    <a href="{{ route('admin.users.index') }}" class="back-button">
        ← Kullanıcı Listesine Dön
    </a>

</div>

@endsection