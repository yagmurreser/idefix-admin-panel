<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Listesi</title>
</head>
<body>

<h1>Admin Kullanıcıları</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

<a href="{{ route('admin.users.create') }}">
    Yeni Kullanıcı Ekle
</a>

<hr>

<form method="POST" action="{{ route('admin.users.bulkDelete') }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Seçilenleri Sil
    </button>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Seç</th>
                <th>ID</th>
                <th>Username</th>
                <th>User Title</th>
                <th>İşlemler</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        <input
                            type="checkbox"
                            name="user_ids[]"
                            value="{{ $user->id }}"
                        >
                    </td>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->user_title }}</td>

                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}">
                            Düzenle
                        </a>

                        |

                        <a href="{{ route('admin.users.delete', $user->id) }}">
                            Sil
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        Kayıtlı kullanıcı bulunamadı.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</form>

</body>
</html>