<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data User</title>
    </head>
    <body>
        {{-- <h2>ID: {{$id}}</h2>
        <h2>NAME: {{strtoupper($name)}}</h2> --}}
        <h1>Data User</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->user_id}}</td>
                <td>{{$d->username}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->level_id}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>
