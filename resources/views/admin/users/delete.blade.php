@extends('layouts.admin')

@section('content')

<style>
    .delete-card {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .delete-card h1 {
        margin-bottom: 15px;
    }

    .warning {
        margin-bottom: 25px;
        color: #555;
    }

    .user-info {
        text-align: left;
        background: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .user-info p {
        margin: 10px 0;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .delete-button {
        background: #c62828;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
    }

    .cancel-button {
        display: inline-block;
        background: #e5e5e5;
        color: #222;
        text-decoration: none;
        padding: 11px 20px;
        border-radius: 7px;
        font-size: 14px;
    }
</style>

<div class="delete-card">

    <h1>Kullanıcı Sil</h1>

    <p class="warning">
        Bu kullanıcıyı silmek istediğinize emin misiniz?
    </p>

    <div class="user-info">
        <p>
            <strong>Kullanıcı Adı:</strong>
            {{ $user->username }}
        </p>

        <p>
            <strong>Kullanıcı Ünvanı:</strong>
            {{ $user->user_title }}
        </p>
    </div>

    <div class="button-group">

        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-button">
                Sil
            </button>
        </form>

        <a href="{{ route('admin.users.index') }}" class="cancel-button">
            Vazgeç
        </a>

    </div>

</div>

@endsection