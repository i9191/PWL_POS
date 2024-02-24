<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
    </head>
    <body>
        <h2>ID: {{$id}}</h2>
        <h2>NAME: {{strtoupper($name)}}</h2>
    </body>
</html>
