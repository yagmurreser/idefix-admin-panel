<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Sil</title>
</head>
<body>

<h1>Ürün Silme Sayfası</h1>

<p>
    {{ $product->product_title }} adlı ürünü silmek istediğinize emin misiniz?
</p>

<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit">Sil</button>
</form>

</body>
</html>