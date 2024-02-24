<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title?></title>
    </head>
    <body>
        <h2>Product for <?=$title?>:</h2>
        <?php foreach ($items as $i=>$item) {
            ?><h3><?=$i+1?>. <?=$item?></h3><?php
        }?>
    </body>
</html>
