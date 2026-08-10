<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Düzenle</title>
</head>
<body>

<h1>Ürün Düzenle</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form
    method="POST"
    action="{{ route('admin.products.update', $product->id) }}"
>
    @csrf
    @method('PUT')

    <label for="product_title">Ürün Adı</label>
    <br>

    <input
        type="text"
        id="product_title"
        name="product_title"
        value="{{ old('product_title', $product->product_title) }}"
    >

    <br><br>

    <label for="category_id">Kategori</label>
    <br>

    <select id="category_id" name="category_id">

        <option value="">
            Kategori Seçme
        </option>

        @foreach ($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
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
        value="{{ old('barcode', $product->barcode) }}"
    >

    <br><br>

    <label for="status">Durum</label>
    <br>

    <select id="status" name="status">

        <option
            value="1"
            {{ old('status', (string) $product->status) === '1' ? 'selected' : '' }}
        >
            Aktif
        </option>

        <option
            value="0"
            {{ old('status', (string) $product->status) === '0' ? 'selected' : '' }}
        >
            Pasif
        </option>

    </select>

    <br><br>

    <button type="submit">
        Güncelle
    </button>

</form>

<br>

<a href="{{ route('admin.products.index') }}">
    Ürün Listesine Dön
</a>

</body>
</html>