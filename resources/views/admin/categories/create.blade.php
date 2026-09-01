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
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 7px;
        font-size: 15px;
        font-family: Arial, sans-serif;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    input:focus,
    textarea:focus,
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

    <h1>Yeni Kategori Ekle</h1>

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

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="category_title">Kategori Adı</label>

            <input
                type="text"
                id="category_title"
                name="category_title"
                value="{{ old('category_title') }}"
            >
        </div>

        <div class="form-group">
            <label for="category_description">Kategori Açıklaması</label>

            <textarea
                id="category_description"
                name="category_description"
            >{{ old('category_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Durum</label>

            <select id="status" name="status">
                <option value="">Seçiniz</option>

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

    <a href="{{ route('admin.categories.index') }}" class="back-button">
        ← Kategori Listesine Dön
    </a>

</div>

@endsection