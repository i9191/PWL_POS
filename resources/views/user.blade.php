<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data User</title>
    </head>
    <body>
        <h1>Data User</h1>
        <a href="{{url('user/tambah')}}">+ Tambah User</a>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
                <th>Aksi</th>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->level_id }}</td>
                <td><a href="{{url('user/ubah/'.$d->user_id)}}">Ubah</a> | <a href="{{url('user/hapus/'.$d->user_id)}}">Hapus</a></td>
            </tr>
            @endforeach
        </table>
    </body>
</html>