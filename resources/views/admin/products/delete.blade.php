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

    .product-info {
        text-align: left;
        background: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .product-info p {
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

    <h1>Ürün Sil</h1>

    <p class="warning">
        Bu ürünü silmek istediğinize emin misiniz?
    </p>

    <div class="product-info">

        <p>
            <strong>Ürün Adı:</strong>
            {{ $product->product_title }}
        </p>

        <p>
            <strong>Kategori:</strong>
            {{ $product->category?->category_title ?? 'Kategori yok' }}
        </p>

        <p>
            <strong>Barkod:</strong>
            {{ $product->barcode }}
        </p>

        <p>
            <strong>Durum:</strong>
            {{ $product->status ? 'Aktif' : 'Pasif' }}
        </p>

    </div>

    <div class="button-group">

        <form
            action="{{ route('admin.products.destroy', $product->id) }}"
            method="POST"
        >
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-button">
                Sil
            </button>
        </form>

        <a
            href="{{ route('admin.products.index') }}"
            class="cancel-button"
        >
            Vazgeç
        </a>

    </div>

</div>

@endsection