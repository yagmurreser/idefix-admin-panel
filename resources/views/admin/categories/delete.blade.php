<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Sil</title>
</head>
<body>

<h1>Kategori Sil</h1>

<p>
    <strong>{{ $category->category_title }}</strong>
    kategorisini silmek istediğinize emin misiniz?
</p>

<form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Sil
    </button>
</form>

<br>

<a href="{{ route('admin.categories.index') }}">
    Vazgeç
</a>

</body>
</html>