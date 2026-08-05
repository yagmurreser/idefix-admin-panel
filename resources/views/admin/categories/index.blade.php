<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Listesi</title>
</head>
<body>

<h1>Kategori Listesi</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('admin.categories.create') }}">
    Yeni Kategori Ekle
</a>

<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori Adı</th>
            <th>Açıklama</th>
            <th>Durum</th>
            <th>İşlemler</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_title }}</td>
                <td>{{ $category->category_description }}</td>
                <td>
                    @if ($category->status)
                        Aktif
                    @else
                        Pasif
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}">
                        Düzenle
                    </a>

                    |

                    <a href="{{ route('admin.categories.delete', $category->id) }}">
                        Sil
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Kayıtlı kategori bulunamadı.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>