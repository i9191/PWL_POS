<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Transaction</title>
    </head>
    <body>
        <h1>Transactions</h1>
        <table border="1px">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['category'] }}</td>
                    <td>{{ $transaction['product'] }}</td>
                    <td>{{ $transaction['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>