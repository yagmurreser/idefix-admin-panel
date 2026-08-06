<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Düzenle</title>
</head>
<body>

<h1>Kategori Düzenle</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
    @csrf
    @method('PUT')

    <label for="category_title">Kategori Adı</label>
    <br>
    <input
        type="text"
        id="category_title"
        name="category_title"
        value="{{ old('category_title', $category->category_title) }}"
    >

    <br><br>

    <label for="category_description">Kategori Açıklaması</label>
    <br>
    <textarea
        id="category_description"
        name="category_description"
    >{{ old('category_description', $category->category_description) }}</textarea>

    <br><br>

    <label for="status">Kategori Durumu</label>
    <br>
    <select id="status" name="status">
        <option
            value="1"
            {{ old('status', (string) $category->status) === '1' ? 'selected' : '' }}
        >
            Aktif
        </option>

        <option
            value="0"
            {{ old('status', (string) $category->status) === '0' ? 'selected' : '' }}
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

<a href="{{ route('admin.categories.index') }}">
    Kategori Listesine Dön
</a>

</body>
</html>