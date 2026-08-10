<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Listesi</title>
</head>
<body>

<h1>Ürün Listesi</h1>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Ürün Adı</th>
        <th>Kategori</th>
        <th>Barkod</th>
        <th>Durum</th>
        <th>Düzenle</th>
        <th>Sil</th>
    </tr>

    @foreach ($products as $product)

        <tr>

            <td>{{ $product->id }}</td>

            <td>{{ $product->product_title }}</td>

            <td>
                {{ $product->category?->category_title ?? 'Kategori yok' }}
            </td>

            <td>{{ $product->barcode }}</td>

            <td>
                {{ $product->status ? 'Aktif' : 'Pasif' }}
            </td>

            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}">
                    Düzenle
                </a>
            </td>

            <td>
                <a href="{{ route('admin.products.delete', $product->id) }}">
                    Sil
                </a>
            </td>

        </tr>

    @endforeach

</table>

</body>
</html>