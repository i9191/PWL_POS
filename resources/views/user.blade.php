<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
    </head>
    <body>
        <h1>Data User</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
            </tr>
            @foreach ($data as $u)
                <tr>
                    <td>{{ $u->user_id }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->level_id }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
