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

    .category-info {
        text-align: left;
        background: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .category-info p {
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

    <h1>Kategori Sil</h1>

    <p class="warning">
        Bu kategoriyi silmek istediğinize emin misiniz?
    </p>

    <div class="category-info">
        <p>
            <strong>Kategori Adı:</strong>
            {{ $category->category_title }}
        </p>

        <p>
            <strong>Açıklama:</strong>
            {{ $category->category_description }}
        </p>

        <p>
            <strong>Durum:</strong>
            {{ $category->status ? 'Aktif' : 'Pasif' }}
        </p>
    </div>

    <div class="button-group">

        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-button">
                Sil
            </button>
        </form>

        <a href="{{ route('admin.categories.index') }}" class="cancel-button">
            Vazgeç
        </a>

    </div>

</div>

@endsection