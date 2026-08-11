@extends('layouts.admin')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
    }

    .add-button,
    .delete-button,
    .back-button {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .add-button {
        background: #222;
        color: white;
    }

    .delete-button {
        background: #c62828;
        color: white;
        margin-bottom: 15px;
    }

    .back-button {
        background: #e5e5e5;
        color: #222;
        margin-top: 20px;
    }

    .message {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 7px;
        background: #f1f1f1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #f3f3f3;
    }

    .edit-link {
        color: #1976d2;
        text-decoration: none;
        margin-right: 12px;
    }

    .delete-link {
        color: #c62828;
        text-decoration: none;
    }
</style>

<div class="page-header">
    <h1>Admin Kullanıcı Yönetimi</h1>

    <a href="{{ route('admin.users.create') }}" class="add-button">
        + Yeni Kullanıcı Ekle
    </a>
</div>

@if (session('success'))
    <div class="message">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="message">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.users.bulkDelete') }}">
    @csrf

    <button type="submit" class="delete-button">
        Seçilenleri Sil
    </button>

    <table>
        <thead>
            <tr>
                <th>Seç</th>
                <th>ID</th>
                <th>Kullanıcı Adı</th>
                <th>Yetki</th>
                <th>İşlemler</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        <input
                            type="checkbox"
                            name="user_ids[]"
                            value="{{ $user->id }}"
                        >
                    </td>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->username }}</td>

                    <td>{{ $user->user_title }}</td>

                    <td>
                        <a
                            href="{{ route('admin.users.edit', $user->id) }}"
                            class="edit-link"
                        >
                            Düzenle
                        </a>

                        <a
                            href="{{ route('admin.users.delete', $user->id) }}"
                            class="delete-link"
                        >
                            Sil
                        </a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5">
                        Kayıtlı kullanıcı bulunamadı.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</form>

<a href="{{ route('admin.dashboard') }}" class="back-button">
    ← Admin Panele Dön
</a>

@endsection