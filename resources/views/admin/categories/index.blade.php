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
    .back-button {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
    }

    .add-button {
        background: #222;
        color: white;
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

    .status-active {
        font-weight: bold;
    }

    .status-passive {
        color: #777;
    }
</style>

<div class="page-header">
    <h1>Kategori Yönetimi</h1>

    <a href="{{ route('admin.categories.create') }}" class="add-button">
        + Yeni Kategori Ekle
    </a>
</div>

@if (session('success'))
    <div class="message">
        {{ session('success') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori Adı</th>
            <th>Açıklama</th>
            <th>Durum</th>
            <th>İşlemler</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>

                <td>{{ $category->category_title }}</td>

                <td>{{ $category->category_description }}</td>

                <td>
                    @if ($category->status)
                        <span class="status-active">Aktif</span>
                    @else
                        <span class="status-passive">Pasif</span>
                    @endif
                </td>

                <td>
                    <a
                        href="{{ route('admin.categories.edit', $category->id) }}"
                        class="edit-link"
                    >
                        Düzenle
                    </a>

                    <a
                        href="{{ route('admin.categories.delete', $category->id) }}"
                        class="delete-link"
                    >
                        Sil
                    </a>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5">
                    Kayıtlı kategori bulunamadı.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('admin.dashboard') }}" class="back-button">
    ← Admin Panele Dön
</a>

@endsection