<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle</title>
</head>
<body>

<h1>Ürün Ekle</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <label for="product_title">Ürün Adı</label>
    <br>

    <input
        type="text"
        id="product_title"
        name="product_title"
        value="{{ old('product_title') }}"
    >

    <br><br>

    <label for="category_id">Kategori</label>
    <br>

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

    <br><br>

    <label for="barcode">Barkod</label>
    <br>

    <input
        type="text"
        id="barcode"
        name="barcode"
        value="{{ old('barcode') }}"
    >

    <br><br>

    <label for="status">Durum</label>
    <br>

    <select id="status" name="status">
        <option value="1">Aktif</option>
        <option value="0">Pasif</option>
    </select>

    <br><br>

    <button type="submit">Kaydet</button>
</form>

</body>
</html>