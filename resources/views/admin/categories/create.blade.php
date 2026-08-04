<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Ekle</title>
</head>
<body>

<h1>Kategori Ekle</h1>

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

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <label for="category_title">Category Title</label>
    <br>
    <input
        type="text"
        id="category_title"
        name="category_title"
        value="{{ old('category_title') }}"
    >

    <br><br>

    <label for="category_description">Category Description</label>
    <br>
    <textarea
        id="category_description"
        name="category_description"
    >{{ old('category_description') }}</textarea>

    <br><br>

    <label for="status">Status</label>
    <br>
    <select id="status" name="status">
        <option value="">Seçiniz</option>
        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
            Pasif
        </option>
    </select>

    <br><br>

    <button type="submit">
        Kaydet
    </button>
</form>

</body>
</html>