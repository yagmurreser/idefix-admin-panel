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

    input,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 7px;
        font-size: 15px;
    }

    input:focus,
    select:focus {
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

    .message {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 7px;
        background: #f1f1f1;
    }

    .error-box {
        background: #ffe5e5;
        color: #b00020;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 20px;
    }
</style>

<div class="form-card">

    <h1>Yeni Ürün Ekle</h1>

    @if (session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="form-group">
            <label for="product_title">Ürün Adı</label>

            <input
                type="text"
                id="product_title"
                name="product_title"
                value="{{ old('product_title') }}"
            >
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>

            <select id="category_id" name="category_id">
                <option value="">Kategori Seçiniz</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->category_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barcode">Barkod</label>

            <input
                type="text"
                id="barcode"
                name="barcode"
                value="{{ old('barcode') }}"
            >
        </div>

        <div class="form-group">
            <label for="status">Durum</label>

            <select id="status" name="status">
                <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                    Pasif
                </option>
            </select>
        </div>

        <button type="submit" class="save-button">
            Kaydet
        </button>

    </form>

    <a href="{{ route('admin.products.index') }}" class="back-button">
        ← Ürün Listesine Dön
    </a>

</div>

@endsection